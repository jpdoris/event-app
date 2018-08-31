<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::paginate(10));
    }

    public function view(Request $request, $username = null)
    {
        $user = $request->user();
        if ($username) {
            $this_user = UserResource::collection(User::where('username', $username)->get());
            return $this_user[0];
        }
        return UserResource::collection(User::get($user));
    }
}
