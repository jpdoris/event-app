<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;

class State extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'iso_3166_2',
        'name',
        'country_code',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];


    /**
     * @param $country
     * @return Collection
     */
    public function filterStateByCountry($country)
    {
        return Country::where('country_code', $country)->get();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Eloquent Relationships
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendee()
    {
        return $this->belongsTo('App\Attendee');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function venue()
    {
        return $this->hasMany('App\Venue');
    }

}
