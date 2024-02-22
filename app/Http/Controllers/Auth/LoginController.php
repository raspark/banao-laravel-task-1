<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ], [
            // Custom error messages
            'email.exists' => 'The provided email is not registered.', // If the email does not exist
        ]);

        $credentials = $request->only('email', 'password');
        // Check if the user wants to be remembered
        $remember = $request->has('rem');

        // Attempt to log the user in
        if (Auth::attempt($credentials, $remember)) {
            // Authentication passed successfully and the user is logged in
            return response()->json(['status' => 'success', 'message' => 'Signed in successfully.', 'redirect' => route('home')]);
        } else {
            // Authentication failed. Return an error response
            return response()->json('Incorrect credentials!! Please check email and password.', 401);
        }
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();

            // Check if the user already exists in the database
            $user = User::where('email', $socialiteUser->getEmail())->first();

            if ($user) {
                // If the user exists, check if they have a password
                if ($user->password) {
                    // If they have a password, they registered using email/password
                    // Redirect them to the login page with an error message
                    return redirect()->route('login-register')->withErrors([
                        'email' => 'The email address is already registered. Please login with your credentials.',
                    ]);
                } else {
                    // If they don't have a password, they registered using social login
                    // Check if the provider is the same as the one they're trying to log in with
                    if ($user->provider !== $provider) {
                        // If it's not, prevent the new social login and show an error message
                        return redirect()->route('login-register')->withErrors([
                            'email' => 'This email address is already associated with a ' . ucfirst($user->provider) . ' account.',
                        ]);
                    }

                    // If the provider is the same, log them in
                    Auth::login($user, true);

                    // Redirect the user to the home page
                    return redirect('/')->with('success', 'Signed in successfully.');
                }
            } else {
                // If the user doesn't exist, create a new user

                // Generate a nickname for the user
                $nickname = $socialiteUser->getNickname();
                do {
                    if (!$nickname || User::where('nickname', $nickname)->exists()) {
                        // Get the first word of the name
                        $nameParts = explode(' ', $socialiteUser->getName());
                        $firstName = strtolower($nameParts[0]);

                        // Generate a new nickname
                        $nickname = $firstName . '#' . rand(1000, 9999);
                    } else {
                        // If the nickname is not null and is unique, just add # and a random 4-digit number
                        $nickname .= '#' . rand(1000, 9999);
                    }
                } while (User::where('nickname', $nickname)->exists());

                // Create the user
                $user = User::create([
                    'name' => $socialiteUser->getName(),
                    'nickname' => $nickname,
                    'email' => $socialiteUser->getEmail(),
                    'provider' => $provider,
                    'provider_id' => $socialiteUser->getId(),
                    'provider_token' => $socialiteUser->token,
                    'avatar' => $socialiteUser->getAvatar(),
                    'email_verified_at' => now(),
                ]);

                // Log the user in
                Auth::login($user, true); // true means "remember me"

                // Redirect the user to the home page
                return redirect('/')->with('success', 'Signed in successfully.');
            }
        } catch (\Exception $e) {
            // If there's an error, redirect back with the error message
            return redirect()->route('login-register')->withErrors([
                'error' => 'There was an error with the social login. Please try again.',
            ]);
        }
    }
}
