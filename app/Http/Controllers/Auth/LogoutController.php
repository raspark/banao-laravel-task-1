<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
    public function logout()
    {
        // Log the user out
        Auth::logout();
        // Flush the session
        session()->flush();
        // Delete the 'email' cookie
        $cookie = Cookie::forget('email');
        // Redirect to the login page with the 'email' cookie deleted
        return redirect('/login-register')->withCookie($cookie);
    }
}
