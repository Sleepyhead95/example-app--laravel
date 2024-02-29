<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Http\Controllers\Controller;


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

    public function logout(Request $request)
    {
        // removes user authentication from the current session
        auth()->logout();

        // extra security measure: invalidating the session = all session data is removed
        // and the user is no longer authenticated for any subsequent requests
        $request->session()->invalidate();
        // generates new session token - while the data is cleared, the session still exists
        // so when we regenreate a token, we make sure that the same session
        // is not used again and that we always start fresh with a new token
        // this is a security measure to prevent session fixation attacks
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have logged out');
    }

    // show login page/form:
    public function login()
    {
        return view('users.login');
    }
}
