<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        // Validate the login request here if needed
        // e.g., $request->validate([...]);

        // Attempt to log in the user
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirect to posts page after successful login
            return redirect()->intended('/posts'); // Redirect to the posts route
        }

        // If login fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
