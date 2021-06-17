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
        foreach ($shift->events() as $event) {
            self::recalculateEvent($event);
        }
        return $shift;
    }

    /**
     * Recalculate event's recurrence
     */
    private static function recalculateEvent(ShiftEvent $event): ShiftEvent
    {
        $event->start = self::calculateNextOccurrence($event->start, $event->recurrence);
        $event->end = self::calculateNextOccurrence($event->end, $event->recurrence);
        return $event;
    }

    /**
     * Calculate next occurrence
     */
    private static function calculateNextOccurrence(DateTime $moment, string $recurrenceType): DateTime
    {
        $now = Carbon::now();
        if ("none" === $recurrenceType) {
            return $moment;
        } else if ("weekly" === $recurrenceType) {
            return Carbon::instance($moment)->addWeeks($now->diffInWeeks($moment))->toDateTime();
        } else {
            throw new ServiceException("Unrecognized recurrence type: $recurrenceType");
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
}
