<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType; // Needed for the 'type_id' dropdown in forms
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Needed for unique email validation on update
use Illuminate\Support\Facades\Hash; // Needed for password hashing

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        // Fetch all users with their associated user type
        $users = User::with('userType')->orderBy('name')->paginate(10); // Paginate for better performance

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Fetch all user types to populate the dropdown
        $userTypes = UserType::all();
        return view('users.create', compact('userTypes'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email', // Email must be unique
            'password' => 'required|string|min:8|confirmed', // 'confirmed' means there's a password_confirmation field
            'type_id' => 'required|exists:user_types,id', // Must be an existing user type
            'temporary_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'personal_contactphone_number' => 'nullable|string|max:20',
            'business_contactphone_number' => 'nullable|string|max:20',
            'altextra_phone_number' => 'nullable|string|max:20',
            'google_map_location' => 'nullable|url|max:255', // Assuming URL for simplicity
            'facebook_link' => 'nullable|url|max:255',
            'tiktok_link' => 'nullable|url|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'note' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // For image upload
        ]);

        $userData = $request->except(['_token', 'password_confirmation', 'photo']); // Exclude token, password_confirmation, and photo
        $userData['password'] = Hash::make($request->password); // Hash the password before saving

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/user_photos'); // Store in storage/app/public/user_photos
            $userData['photo'] = str_replace('public/', '', $path); // Store path relative to storage/app/public
        }

        User::create($userData);

        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        // The $user model is automatically injected by route model binding
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $userTypes = UserType::all();
        return view('users.edit', compact('user', 'userTypes'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Ignore current user's email
            ],
            // Password is optional on update, only validate if provided
            'password' => 'nullable|string|min:8|confirmed',
            'type_id' => 'required|exists:user_types,id',
            'temporary_address' => 'nullable|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'personal_contactphone_number' => 'nullable|string|max:20',
            'business_contactphone_number' => 'nullable|string|max:20',
            'altextra_phone_number' => 'nullable|string|max:20',
            'google_map_location' => 'nullable|url|max:255',
            'facebook_link' => 'nullable|url|max:255',
            'tiktok_link' => 'nullable|url|max:255',
            'instagram_link' => 'nullable|url|max:255',
            'note' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $userData = $request->except(['_token', '_method', 'password_confirmation', 'photo']);

        // Handle password update if provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        } else {
            unset($userData['password']); // Don't update password if not provided
        }

        // Handle photo upload (delete old one if new one is provided)
        if ($request->hasFile('photo')) {
            // Delete old photo if it exists
            if ($user->photo && \Storage::disk('public')->exists($user->photo)) {
                \Storage::disk('public')->delete($user->photo);
            }
            $path = $request->file('photo')->store('public/user_photos');
            $userData['photo'] = str_replace('public/', '', $path);
        } elseif ($request->input('clear_photo')) { // Add a hidden input or checkbox for clearing photo
             if ($user->photo && \Storage::disk('public')->exists($user->photo)) {
                \Storage::disk('public')->delete($user->photo);
            }
            $userData['photo'] = null;
        }


        $user->update($userData);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Delete associated photo if it exists
        if ($user->photo && \Storage::disk('public')->exists($user->photo)) {
            \Storage::disk('public')->delete($user->photo);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}