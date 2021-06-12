<?php

namespace App\Services;

use App\Models\Shift;

class ShiftService {

    /**
     * All events, with their occurences applied
     */
    public function all(): array  {
        return Shift::with(['events','user'])->get()->toArray();
    }

    /**
     * Creates a new shift, handles the relationships
     */
    public function create(array $array): Shift {
        $shift = Shift::create($array);
        $shift->events()->createMany($array["events"] ?: []);
        return Shift::with(['events','user'])->findOrFail($shift->id);
    }

    /**
     * Updates a shift and related events
     */
    public function update(string $id, array $array): Shift {
        $shift = Shift::findOrFail($id);
        $shift->update($array);
        $shift->events()->delete();
        $shift->events()->createMany($array["events"] ?: []);
        return Shift::with(['events','user'])->findOrFail($shift->id);
    }

    /**
     * Deletes a shift and related events
     */
    public function delete(string $id) {
        $shift = Shift::findOrFail($id);
        $shift->events()->delete();
        $shift->delete();
    }
}