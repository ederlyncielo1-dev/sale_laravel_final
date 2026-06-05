<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    /**
     * Display the student profile settings panel.
     */
    public function edit()
    {
        // Fetch the currently authenticated user
        $user = Auth::user();
        return view('pages.student.settings', compact('user'));
    }

    /**
     * Process the student profile configuration update.
     */
   

public function update(Request $request)
{
    $user = Auth::user();

    // 1. Validation Rules
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Max 2MB
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:500',
        'emergency_contact_name' => 'nullable|string|max:255',
        'emergency_contact_phone' => 'nullable|string|max:20',
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // 2. Direct Public Folder Upload Mechanics
    if ($request->hasFile('profile_picture')) {
        
        // Clean up: delete old file from the public folder if it exists
        if ($user->profile_picture && File::exists(public_path($user->profile_picture))) {
            File::delete(public_path($user->profile_picture));
        }

        $file = $request->file('profile_picture');
        
        // Create a totally unique file name using user ID and time to prevent overwrite conflicts
        $fileName = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        
        // Move the file directly into public/uploads/avatars/
        $file->move(public_path('uploads/avatars'), $fileName);

        // Save a clean, direct string path in the database column
        $user->profile_picture = 'uploads/avatars/' . $fileName;
    }

    // 3. Save everything else
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->phone = $request->input('phone');
    $user->address = $request->input('address');
    $user->emergency_contact_name = $request->input('emergency_contact_name');
    $user->emergency_contact_phone = $request->input('emergency_contact_phone');

    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    $user->save();

    return redirect()->back()->with('success', 'Your profile settings and avatar have been updated.');
}
}