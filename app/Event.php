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

    protected $dates = [
        'startdate',
        'enddate',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];


    public function getCity()
    {
        return $this->venue->city;
    }

    public function getStateID()
    {
        return $this->venue->state['id'];
    }

    public function getStateOptions()
    {

    }

    public function getStateName()
    {
        return $this->venue->getState();
    }

    public function getCountryID()
    {
        return $this->venue->country['id'];
    }

    public function getCountryName()
    {
        if ($this->getCountryID()) {
            return $this->venue->getCountry();
        }
        return null;
    }

    public function getLocation()
    {
        $value = $this->getCity();

        if ($this->getStateID()) {
            $value .= ", " . $this->getStateName();
        }
        elseif ($this->getCountryID()) {
            $value .= ", " . $this->getCountryName();
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

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
//     */
//    public function state()
//    {
//        return $this->hasManyThrough('App\Venue', 'App\State', 'id', 'id');
//    }

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
