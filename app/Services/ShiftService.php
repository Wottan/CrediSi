<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use App\Models\Shift;
use App\Models\ShiftEvent;
use Carbon\Carbon;
class ShiftService
{
    const WITH = ['events', 'user', 'labels'];

    /**
     * All events, with their occurences applied
     * 
     * @return Shift[]
     */
    public function all($reference = null): iterable
    {
        return self::recalculateAll(Shift::with(self::WITH)->get(), $reference);
    }

    /**
     * Creates a new shift, handles the relationships
     */
    public function create(array $array): Shift
    {
        $shift = Shift::create($array);
        $shift->events()->createMany($array['events'] ?: []);
        return Shift::with(self::WITH)->findOrFail($shift->id);
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
        return Shift::with(self::WITH)->findOrFail($shift->id);
    }

    /**
     * Shifts for specific user
     */
    public function forUser(string $id, $date): iterable
    {
        return self::recalculateAll(
            Shift::with(self::WITH)->where(["user_id" => $id])->get(), 
            $date
        );
    }

    /**
     * Specific shift
     */
    public function get(string $id, $date): Shift
    {
        $shift = Shift::with(self::WITH)->findOrFail($id);
        self::recalculate($shift, $date);
        return $shift;
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
     * Recalculate events on all shifts
     * 
     * @return Shift[]
     */
    public static function recalculateAll($shifts, $reference = null): iterable
    {
        $shifts->each(function (Shift $shift) use ($reference) {
            self::recalculate($shift, $reference);
        });
        return $shifts;
    }

    /**
     * Recalculate events recurrence
     */
    private static function recalculate(Shift $shift, $reference, $recurrence = null, $start = null): Shift
    {
        foreach ($shift->events as $event) {
            self::recalculateEvent($event, $reference, $recurrence ?: $shift->recurrence, $start ?: $shift->start);
        }
        return $shift;
    }

    /**
     * Recalculate event's recurrence
     */
    private static function recalculateEvent(ShiftEvent $event, $reference, $recurrence, $start): ShiftEvent
    {
        $event->start = self::calculateNextOccurrence($event->start, $reference, $recurrence, $start);
        $event->end = self::calculateNextOccurrence($event->end, $reference, $recurrence, $start);
        return $event;
    }

    /**
     * Calculate next occurrence
     */
    private static function calculateNextOccurrence(String $moment, $reference, $recurrence, $start): string
    {
        $moment = Carbon::parse($moment);
        $now = $reference ? Carbon::parse($reference) : Carbon::now();
        if ("none" === $recurrence) {
            return $moment;
        } else if ("weekly" === $recurrence) {
            $startOfCurrentWeek = $now->startOfWeek();
            $recalculated = $moment;
            while ($startOfCurrentWeek->gt($recalculated)) {
                $recalculated->addWeeks(1);
            }
            return $recalculated->toString();
        } else if ("biweekly" === $recurrence) {
            $startOfCurrentWeek = $now->startOfWeek(Carbon::MONDAY);
            $recalculated = $moment->clone();
            while ($startOfCurrentWeek->gt($recalculated)) {
                $recalculated->addWeeks(2);
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
        return $shift->load(self::WITH);
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
