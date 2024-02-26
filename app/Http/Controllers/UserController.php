<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    // show register/create form

    public function create()
    {
        return view('users.register');
    }

    // store new user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // hash password:
        // bcrypt() is a built-in PHP function that hashes passwords
        $formFields['password'] = bcrypt($formFields['password']);

        // create user:
        $user = User::create($formFields);

        // log user in:
        auth()->login($user);

        // redirect to home page after loggin in:
        return redirect('/')->with('message', 'User created and logged in');
    }
}
