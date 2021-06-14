<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeOff extends Model
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
        'user_id',
        'start',
        'end',
        'type',
        'justification',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
