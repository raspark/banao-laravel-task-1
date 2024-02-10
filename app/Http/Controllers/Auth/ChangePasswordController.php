<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    // Change password
    public function changePassword(Request $request)
    {
        // Validate the new password
        $request->validate([
            'curpass' => 'required',
            'newpass' => 'required|string|min:5|confirmed',
        ]);

        $user = Auth::user();

        // Check if the current password is incorrect
        if (!Hash::check($request->curpass, $user->password)) {
            return back()->withErrors(['error' => 'The current password is incorrect.']);
        }

        // Update the password
        $user->password = Hash::make($request->newpass);
        $user->save();

        return back()->with('success', 'Password changed successfully!');
    }
}
