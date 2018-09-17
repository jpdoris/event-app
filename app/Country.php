<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'capital',
        'citizenship',
        'country_code',
        'currency',
        'currency_code',
        'full_name',
        'name'
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
    public function getName()
    {
        return $this->name;
    }


    /**
     * Eloquent Relationships
     */


    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function venue()
    {
        return $this->hasMany('App\Venue');
    }
}
