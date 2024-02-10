<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('frontend.pages.profile', ['user' => $user]);
    }

    // Update profile
    public function update(Request $request)
    {
        $user = Auth::user(); // Get the currently authenticated user

        // Validate the request
        $request->validate([
            'name' => 'nullable|max:255',
            'phone' => 'nullable|max:15',
            'gender' => 'nullable|in:male,female,other',
            'photo' => 'nullable|image|max:2048', // Allow only images up to 2MB
        ]);

        DB::beginTransaction();

        try {
            // Update the user
            $user->name = $request->input('name');
            $user->phone = $request->input('phone');
            $user->gender = $request->input('gender');

            // Handle the user photo upload
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('public/uploads/profile_photos');
                $user->photo = $path;
            }

            $user->save();

            DB::commit();

            // Return a response
            return redirect()->route('profile')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            // Log the exception or return a response with the error message
            return back()->withErrors(['error' => 'There was a problem updating your profile. Please try again.']);
        }
    }
}
