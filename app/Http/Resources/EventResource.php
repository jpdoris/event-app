<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'startdate' => Carbon::parse($this->startdate)->format('Y-m-d'),
            'enddate' => Carbon::parse($this->enddate)->format('Y-m-d'),
            'startdate_formatted' => Carbon::parse($this->startdate)->format('F jS, Y'),
            'enddate_formatted' => Carbon::parse($this->enddate)->format('F jS, Y'),
            'city' => $this->getCity(),
            'stateID' => $this->getStateID(),
            'state' => $this->getStateName(),
            'countryID' => $this->getCountryID(),
            'countryName' => $this->getCountryName(),
            'location' => $this->getLocation(),
            'description' => $this->description,
            'venue_image' => $this->venue->image_path,
        ];
    }
}
