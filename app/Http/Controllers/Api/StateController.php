<?php

namespace App\Http\Controllers\Api;

use App\State;
use App\Http\Controllers\Controller;
use App\Http\Resources\StateResource;
use Illuminate\Http\Request;


class StateController extends Controller
{
    public function index()
    {
        return StateResource::collection(State::all());
    }
}
