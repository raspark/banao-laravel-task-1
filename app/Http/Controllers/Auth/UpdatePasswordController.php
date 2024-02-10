<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    public function updatePassword(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        // Get the user associated with the email
        $user = User::where('email', $request->email)->first();

        // Check the token
        $tokenData = DB::table('password_reset_tokens')->where('email', $request->email)->first();
        if (!$tokenData || !Hash::check($request->token, $tokenData->token)) {
            // Return a JSON response with an error message
            return response()->json(['token' => 'The password reset token is invalid.'], 422);
        }

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the token
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Return a JSON response indicating success
        return response()->json(['success' => 'Your password has been updated. You can now log in.']);
    }
}
