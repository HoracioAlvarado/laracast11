<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        // validate
        $attributes = request()->validate([
            'name' => ['required', 'min:3'],
            'email'=> ['required', 'email', 'max:254'],
            'password' => ['required', Password::min(6), 'confirmed']
            ]);
        // create user
        $user = User::create($attributes);
        // log in
        Auth::login($user);
        // redirect
        return redirect('/jobs');
    }
}
