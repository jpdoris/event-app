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
            'startdate' => Carbon::parse($this->startdate)->format('F jS, Y'),
            'enddate' => Carbon::parse($this->enddate)->format('F jS, Y'),
            'location' => $this->getLocation(),
            'description' => $this->description,
        ];
    }
}
