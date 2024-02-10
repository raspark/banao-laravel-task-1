<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8'
        ], [
            'name.regex' => 'The :attribute can only contain letters and spaces.',
            'email.unique' => 'The provided email is already registered.',
            'password.confirmed' => 'The passwords do not match.'
        ]);

        // Create the user and log them in
        try {
            // Generate a nickname for the user
            $nickname = $request->name;
            // Get the first word of the name
            $nameParts = explode(' ', $request->name);
            $firstName = strtolower($nameParts[0]);
            // Generate a nickname for the user by adding # and a random 4-digit number
            do {
                $nickname = $firstName . '#' . rand(1000, 9999);
            } while (User::where('nickname', $nickname)->exists()); // Check if the nickname already exists

            // Create the user
            $user = User::create([
                'name' => $request->name,
                'nickname' => $nickname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Log the user in
            Auth::login($user);

            // Return a success response
            return response()->json('register');

        } catch (\Exception $e) {
            // If there was an error, return an error response
            return response()->json('There was an error during the registration. Please try again.', 500);
        }
    }
}
