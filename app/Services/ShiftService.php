<?php

namespace App\Services;

use App\Exceptions\ServiceException;
use App\Models\Shift;
use App\Models\ShiftEvent;
use Carbon\Carbon;
use DateTime;

class ShiftService
{

    /**
     * All events, with their occurences applied
     * 
     * @return Shift[]
     */
    public function all(): iterable
    {
        $shifts = Shift::with(['events', 'user', 'labels'])->get();
        $shifts->each(function (Shift $shift) {
            self::recalculate($shift);
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
    private static function recalculate(Shift $shift): Shift
    {
        foreach ($shift->events as $event) {
            self::recalculateEvent($event, $shift->recurrence);
        }
        return $shift;
    }

    /**
     * Recalculate event's recurrence
     */
    private static function recalculateEvent(ShiftEvent $event, string $recurrence): ShiftEvent
    {
        $event->start = self::calculateNextOccurrence($event->start, $recurrence);
        $event->end = self::calculateNextOccurrence($event->end, $recurrence);
        return $event;
    }

    /**
     * Calculate next occurrence
     */
    private static function calculateNextOccurrence(String $moment, string $recurrence): string
    {
        $moment = Carbon::parse($moment);
        $now = Carbon::now();
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
    public function sync(string $id, array $array): Shift
    {
        $shift = Shift::findOrFail($id);
        $shift->labels()->sync($array);
        return $shift->load(['events', 'user', 'labels']);
    }

    /**
     *  All shifts actives (one or more ShiftEvents actives) with their relationships.
     */
    public function shiftsActive(): iterable
    {
        return Shift::with(['events', 'user', 'labels'])->whereHas('eventsActive')->get();
    }

    /**
     * All shifts of the date with their relationships.
     */
    public function shiftsToday()
    {
        return Shift::with(['events', 'user', 'labels'])->whereDate('start', now())->get();
    }


    /**
     * All shifts with their relationships by datetime.
     */
    public function byDateTime($date)
    {
        return  Shift::with(['events', 'user', 'labels'])->whereHas('events', function ($query) use ($date) {
            $query->whereDate('start', Carbon::parse($date)->toDateString())
                ->whereTime('start', '<=', Carbon::parse($date)->toTimeString())
                ->whereTime('end', '>=', Carbon::parse($date)->toTimeString());
        })->get();
    }
}
