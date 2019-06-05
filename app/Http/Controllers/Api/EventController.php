<?php

namespace App\Http\Controllers\Api;

use App\State;
use App\Country;
use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Resources\StateResource;
use App\Http\Resources\CountryResource;
use App\Http\Resources\EventResource;
use Carbon\Carbon;
use Illuminate\Http\Request;


class EventController extends Controller
{
    public function index()
    {
        return EventResource::collection(Event::paginate(10));
    }

    public function view(Request $request, $id = null)
    {
        if ($id) {
            $this_event = EventResource::collection(Event::where('id', $id)->get());
            return $this_event[0];
        }
        $event = Event::find($id);
        return EventResource::collection(Event::get($event));
    }

    public function create(Request $request)
    {
        // validate
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
        ]);


        $event = new Event();
        $event->title       = $request->input('title');
        $event->description = $request->input('description');
        $event->startdate   = $request->input('startdate');
        $event->enddate     = $request->input('enddate');
        $event->save();
    }

    public function update(Request $request)
    {
        $id = $request->input('id');

        // validate
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
        ]);

        $event = Event::find($id);
        $event->title       = $request->input('title');
        $event->description = $request->input('description');
        $event->startdate   = Carbon::parse($request->input('startdate'))->toDateTimeString();
        $event->enddate     = Carbon::parse($request->input('enddate'))->toDateTimeString();
        $event->save();
    }
}
