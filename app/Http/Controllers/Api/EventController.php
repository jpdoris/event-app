<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use Illuminate\Http\Request;


class EventController extends Controller
{
    public function index()
    {
        return EventResource::collection(Event::paginate(10));
    }

    public function view(Request $request, $id = null)
    {
        $event = $request->id();
        if ($event) {
            $this_event = EventResource::collection(Event::find($event));
            return $this_event[0];
        }
        return EventResource::collection(Event::get($event));
    }
}
