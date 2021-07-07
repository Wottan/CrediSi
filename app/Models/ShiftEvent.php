<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ShiftEvent extends Model
{
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'shift_id',
        'start',
        'end',
        'color',
        'timed',
    ];

    protected $casts = [
        'timed' => 'boolean',
        'start' => 'datetime',
        'end' => 'datetime'
    ];


    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }
}
