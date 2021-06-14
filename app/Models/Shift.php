<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
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
        'user_id',
        'start',
        'type',
        'recurrence'
    ];

    protected $casts = [
        'start' => 'date'
    ];

    public function events()
    {
        return $this->hasMany(ShiftEvent::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
