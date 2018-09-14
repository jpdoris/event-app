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


    public function getLocation()
    {
        $value =  $this->venue->city;

        if ($this->venue->state) {
            $value .= $this->venue->getState();
        }

        if ($this->venue->country) {
            $value .= $this->venue->getCountry();
        }

        return $value;
    }


    /**
     * Eloquent Relationships
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendee()
    {
        return $this->hasMany('App\Attendee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sessions()
    {
        return $this->belongsToMany('App\Session');
    }

}
