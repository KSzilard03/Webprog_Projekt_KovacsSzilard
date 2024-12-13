<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Handles the login process, authenticates the user, and redirects
    public function loginPost(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        $credentials = $request->only('email', 'password');

        // If the "Remember Me" checkbox is checked, pass it to the Auth::attempt method
        $remember = $request->has('remember');  // Checks if the remember checkbox is checked

        // Attempts to log in with the provided credentials
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->intended(route("home")); // Redirects to the intended page after login
        }

        // If authentication fails, redirects back to the login page with an error
        return redirect(route("login"))->with("error", "Invalid email or password");
    }

    // Handles the user registration process, including validation and saving the user
    public function registerPost(Request $request)
    {
        $request->validate([ // Validates the registration data
            "username" => "required",
            "email" => "required|email|unique:users,email",
            "password" => [
                "required",
                "string",
                "min:8",
                "regex:/[a-z]/", // Ensures password has lowercase letters
                "regex:/[A-Z]/", // Ensures password has uppercase letters
                "regex:/[0-9]/", // Ensures password has numbers
                "regex:/[@$!%*?&]/" // Ensures password has special characters
            ],
            "user_type" => "required|in:1,2", // Ensures valid user type
            "terms" => "accepted", // Ensures terms are accepted
        ]);

        // Creates and saves the new user
        $user = new User();
        $user->name = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Hashes the password
        $user->user_type = $request->user_type;

        // Redirects based on success or failure of user creation
        if ($user->save()) {
            return redirect(route("login"))->with("success", "User created successfully");
        }

        return redirect(route("register"))->with("error", "Failed to create account");
    }

    // Displays the profile view of the authenticated user
    public function showProfile()
    {
        return view('auth.profile.show');
    }

    // Displays the form to edit the authenticated user's profile
    public function editProfile()
    {
        return view('auth.profile.edit');
    }

    // Handles profile update, including optional profile picture and password change
    public function updateProfile(Request $request)
    {
        $request->validate([ // Validates profile update data
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(), // Ensures email is unique except for the current user
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validates profile picture
            'password' => 'nullable|string|min:8|confirmed', // Validates password if provided
        ]);

        $user = auth()->user(); // Gets the authenticated user
        $user->name = $request->username;
        $user->email = $request->email;

        // If a new profile picture is uploaded, deletes the old one and stores the new one
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture); // Deletes old profile picture
            }
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public'); // Stores the new profile picture
            $user->profile_picture = $path;
        }

        // If a password is provided, hashes and updates it
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Saves the updated user data
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'The profile was updated successfully.');
    }

    // Logs out the authenticated user and invalidates the session
    public function logout(Request $request)
    {
        Auth::logout(); // Logs out the user
        $request->session()->invalidate(); // Invalidates the session
        $request->session()->regenerateToken(); // Regenerates CSRF token

        return redirect()->route('home'); // Redirects to the home page after logout
    }

}
