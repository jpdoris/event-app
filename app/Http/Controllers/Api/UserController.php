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

    public function create(Request $request)
    {
        // validate
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'confirmed',
        ]);


        $user = new User();
        $user->username     = $request->input('input');
        $user->firstname    = $request->input('input');
        $user->lastname     = $request->input('input');
        $user->email        = $request->input('input');
        $user->password = $request->input('input');
        $user->save();
    }

    public function update(Request $request)
    {
        $id = $request->input('id');

        // validate
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
        ]);

        if ($request->input('password')) {
            $this->validate($request, [
                'password' => 'confirmed'
            ]);
        }

        $user = User::find($id);
        $user->username     = $request->input('username');
        $user->firstname    = $request->input('firstname');
        $user->lastname     = $request->input('lastname');
        $user->email        = $request->input('email');
        if ($request->input('password')) {
            $user->password = $request->input('input');
        }
        $user->save();
    }
}
