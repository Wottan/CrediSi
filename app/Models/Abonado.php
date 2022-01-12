<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abonado extends Model
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
        'last_name',
        'date_of_birth',
        'start_date',
        'sex',
        'province_id',
        'dni'
    ];


    public function province()
    {
        return $this->belongsTo(Provinces::class, 'province_id');
    }
}
