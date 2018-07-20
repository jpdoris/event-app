<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'postal_code'
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

    public function states()
    {
        return $this->hasOne('states');
    }

    public function countries()
    {
        return $this->hasOne('countries');
    }
}
