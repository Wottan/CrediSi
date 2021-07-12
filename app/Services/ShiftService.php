<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use App\Models\Shift;
use App\Models\ShiftEvent;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ShiftService
{

    /**
     * All events, with their occurences applied
     * 
     * @return Shift[]
     */
    public function all($reference = null): iterable
    {
        $shifts = Shift::with(['events', 'user', 'labels'])->get();
        $shifts->each(function (Shift $shift) use ($reference) {
            self::recalculate($shift, $reference);
        });
        return $shifts;
    }

    /**
     * Creates a new shift, handles the relationships
     */
    public function create(array $array): Shift
    {
        $shift = Shift::create($array);
        $shift->events()->createMany($array['events'] ?: []);
        return Shift::with(['events', 'user'])->findOrFail($shift->id);
    }

    /**
     * Updates a shift and related events
     */
    public function update(string $id, array $array): Shift
    {
        $shift = Shift::findOrFail($id);
        $shift->update($array);
        $shift->events()->delete();
        $shift->events()->createMany($array["events"] ?: []);
        return Shift::with(['events', 'user'])->findOrFail($shift->id);
    }

    /**
     * Deletes a shift and related events
     */
    public function delete(string $id)
    {
        $shift = Shift::findOrFail($id);
        $shift->events()->delete();
        $shift->delete();
    }

    /**
     * Recalculate events recurrence
     */
    private static function recalculate(Shift $shift, $reference): Shift
    {
        foreach ($shift->events as $event) {
            self::recalculateEvent($event, $shift->recurrence, $reference);
        }
        return $shift;
    }

    /**
     * Recalculate event's recurrence
     */
    private static function recalculateEvent(ShiftEvent $event, string $recurrence, $reference): ShiftEvent
    {
        $event->start = self::calculateNextOccurrence($event->start, $recurrence, $reference);
        $event->end = self::calculateNextOccurrence($event->end, $recurrence, $reference);
        return $event;
    }

    /**
     * Calculate next occurrence
     */
    private static function calculateNextOccurrence(String $moment, string $recurrence, $reference): string
    {
        $moment = Carbon::parse($moment);
        $now = $reference ? Carbon::parse($reference) : Carbon::now();
        if ("none" === $recurrence) {
            return $moment;
        } else if ("weekly" === $recurrence) {
            $startOfCurrentWeek = $now->startOfWeek();
            $recalculated = $moment;
            while ($startOfCurrentWeek->gt($recalculated)) {
                $recalculated = $recalculated->addWeeks(1);
            }
            return $recalculated->toString();
        } else {
            throw new ServiceException("Unrecognized recurrence type: $recurrence");
        }
    }

    /**
     *  Sync the intermediate tables with a list of IDs or collection of models.
     */
    public function syncLabels(string $id, array $array): Shift
    {
        $shift = Shift::findOrFail($id);
        $shift->labels()->sync($array);
        return $shift->load(['events', 'user', 'labels']);
    }

    /**
     * All shifts of the date with their relationships.
     */
    public function today()
    {
        $shiftsRecalculated = collect($this->all());
        $shiftsToday = collect();
        $shiftsRecalculated->each(function (Shift $shift) use ($shiftsToday) {
            $shift->events->each(function (ShiftEvent $shiftEvent) use ($shift, $shiftsToday) {
                if (
                    Carbon::parse($shiftEvent->start)->toDateString() == Carbon::parse(now())->toDateString()
                ) {
                    $shiftsToday->push($shift);
                    return false;
                }
            });
        });
        return $shiftsToday;
    }

    /**
     * All shifts actives with their relationships by datetime.
     * 
     */
    public function active($date): iterable
    {
        $shiftsRecalculated = collect($this->all($date));
        $shiftsActive = $shiftsRecalculated->filter(function ($value) use ($date) {
            return $value->events->contains(function ($value) use ($date) {
                return $value->start->toDateString() == Carbon::parse($date)->toDateString() &&
                    $value->start->lessThanOrEqualTo(Carbon::parse($date)) &&
                    $value->end->greaterThanOrEqualTo(Carbon::parse($date));
            });
        });
        return $shiftsActive->values();
    }
}
