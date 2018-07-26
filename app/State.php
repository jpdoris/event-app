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


    /**
     * @param $country
     * @return Collection
     */
    public function filterStateByCountry($country)
    {
        return Country::where('country_code', $country)->get();
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }

}
