<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'venue_id',
        'startdate',
        'enddate',
        'is_oneday',
        'is_allday'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];


    public function users()
    {
        return $this->hasOne('users');
    }

    public function venues()
    {
        return $this->hasOne('venues');
    }
}
