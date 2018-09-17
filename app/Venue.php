<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'postal_code',
        'description',
        'image_path'
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
     * @return string
     */
    public function getState()
    {
        return $this->state->iso_3166_2;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country->name;
    }


    /**
     * Eloquent Relationships
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function event()
    {
        return $this->hasMany('App\Event');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function state()
    {
        return $this->belongsTo('App\State');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
}
