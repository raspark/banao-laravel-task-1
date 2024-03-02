<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request)
    {
        if (!$request->hasValidSignature()) {
            // The URL does not have a valid signature or has expired.
            // Redirect back to the password reset request page with an error message.
            return redirect()->route('admin.password.reset')->withErrors(['email' => 'The password reset link is not valid or has expired.']);
        }

        // Proceed with the password reset request
        $viewData = [
            'token' => $request->token,
            'email' => $request->email,
        ];

        return view('auth.reset-password', $viewData);
    }
}
