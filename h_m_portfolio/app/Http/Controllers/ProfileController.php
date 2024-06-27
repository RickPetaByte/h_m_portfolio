<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    // Show the profile edit form.
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    //  Update the user's profile information.
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Retrieve authenticated user instance
        $user = $request->user();

        // Update user instance with validated data
        $user->fill($request->validated());

        // Handle profile picture update
        if ($request->hasFile('picture')) {
            // Delete old profile picture if it exists
            if ($user->picture) {
                $oldPicturePath = public_path('storage/img/profile-pictures/' . $user->picture);
                if (File::exists($oldPicturePath)) {
                    File::delete($oldPicturePath);
                }
            }

            // Store new profile picture and update user instance
            $path = $request->file('picture')->store('img/profile-pictures', 'public');
            $user->picture = basename($path);
        }

        // Reset email verification status if email is updated
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save updated user information
        $user->save();

        // Redirect back to profile edit page with success message
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    //  Delete the authenticated user's account.
    public function destroy(Request $request): RedirectResponse
    {
        // Validate user's current password for account deletion
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // Retrieve authenticated user instance
        $user = $request->user();

        // Log out the user
        Auth::logout();

        // Delete the user account
        $user->delete();

        // Invalidate session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the homepage after successful deletion
        return Redirect::to('/')->with('status', 'account-deleted');
    }
}