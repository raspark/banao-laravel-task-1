<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPasswordMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
use Mail;

class ForgetPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function forgot_password(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            // Custom error messages
            'email.exists' => 'The provided email is not registered.', // If the email does not exist
        ]);

        // Get the user associated with the email
        $user = User::where('email', $request->email)->first();

        // Generate a password reset token for the user
        $token = app('auth.password.broker')->createToken($user);

        // Delete any existing password reset tokens for the user
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        // Insert the new token into the password_resets table
        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => Hash::make($token), // Hash the token for security
            'created_at' => Carbon::now(),
        ]);

        // Generate the password reset URL that expires after 60 minutes
        $url = URL::temporarySignedRoute(
            'password.reset',
            now()->addMinutes(10),
            ['token' => $token, 'email' => $user->email]
        );

        // Send the password reset link to the user's email
        Mail::to($user->email)->send(new ForgetPasswordMail($user, $url));

        return response()->json('Password reset link sent to your email.');
    }
}
