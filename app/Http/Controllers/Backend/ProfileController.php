<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('backend.pages.profile', ['user' => $user]);
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
            if ($request->filled('name')) {
                $user->name = $request->input('name');
            }
            if ($request->filled('tagline')) {
                $user->tagline = $request->input('tagline');
            }
            if ($request->filled('about')) {
                $user->about = $request->input('about');
            }
            if ($request->filled('phone')) {
                $user->phone = $request->input('phone');
            }
            if ($request->filled('dob')) {
                $user->dob = $request->input('dob');
            }
            if ($request->filled('gender')) {
                $user->gender = $request->input('gender');
            }


            // Handle the user photo upload
            if ($request->hasFile('photo')) {
                // Delete the old photo if it exists
                if ($user->photo) {
                    Storage::delete($user->photo);
                }

                $path = $request->file('photo')->store('uploads/profile_photos', 'public');
                $user->photo = $path;
            }

            $user->save();

            DB::commit();

            // Return a response
            return redirect()->route('profile')->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            DB::rollback();

            // Log the exception
            Log::error($e);

            // Return a response with the error message
            return back()->withErrors(['error' => 'There was a problem updating your profile. Error: ' . $e->getMessage()]);
        }
    }
}
