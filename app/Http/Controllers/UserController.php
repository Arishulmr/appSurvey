<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showRegistrationForm() {
        return view('register');
    }
    public function register(Request $request){
        $incomingFields = $request->validate([
            'name'=>['required','string', Rule::unique('users', 'name')],
            'email'=>['required','email', Rule::unique('users', 'email')],
            'password'=>['required','string','min:5','max:10']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        auth()->login($user);

        return redirect('/dashboard');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }
    // UserController.php
    public function login(Request $request)
    {
        // Validate the login form inputs
        $request->validate([
            'loginName' => 'required|string',
            'loginPassword' => 'required|string'
        ]);

        // Attempt to log in using the 'name' field instead of 'username'
        if (Auth::attempt(['name' => $request->loginName, 'password' => $request->loginPassword])) {
            // Login successful
            return redirect()->intended('dashboard');
        }

        // Login failed, redirect back with an error message
        return back()->with('error', 'Invalid username or password.');
    }

}