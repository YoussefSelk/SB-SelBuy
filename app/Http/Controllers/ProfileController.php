<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        if ($user->announcements) {
            $user->announcements()->delete();
        }
        $user->sentMessages()->delete();

        $user->receivedMessages()->delete();

        $user->roles()->detach();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function img(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,gif|max:2048', // Adjust the max file size as needed
        ]);

        // Check if the request has a file attached
        if ($request->hasFile('img')) {
            // Get the uploaded file
            $image = $request->file('img');

            // Generate a unique filename for the image
            $imageName = uniqid('profile_img_') . '.' . $image->getClientOriginalExtension();

            // Store the image in the public storage directory
            $image->storeAs('public/profile_pictures', $imageName);

            // Update the user's profile image path in the database
            $request->user()->update(['avatar' => $imageName]);

            // Redirect back with success message
            return redirect()->back()->with('status', 'Profile picture uploaded successfully.');
        }

        // If no file is attached or upload fails, redirect back with error message
        return redirect()->back()->with('error', 'Failed to upload profile picture.');
    }
    public function deleteProfilePicture(Request $request)
    {
        // Check if the user has a profile picture
        if ($request->user()->avatar) {
            // Delete profile picture from storage
            Storage::disk('public')->delete($request->user()->avatar);

            // Update user's img column to null
            $request->user()->avatar = null;
            $request->user()->save();

            return redirect()->back()->with('status', 'profile-picture-deleted');
        }

        return redirect()->back()->with('error', 'No profile picture found.');
    }
}
