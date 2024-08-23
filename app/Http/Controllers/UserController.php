<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function edit()
    {
        return Inertia::render('Profiles/Edit', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:200',
            'profile_image' => 'nullable|image|max:2048'
        ]);

        $user = Auth::user();
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image')->store('profiles', 'public');
            $user->profile_image = $profileImage;
        }

        $user->name = $request->input('name');
        $user->bio = $request->input('bio');
        $user->save();

        return Redirect::to('/users/{id}');
    }
    
    public function show($id)
    {
        $user = User::with(['user', 'post'])->findOrFail($id);
        // $isFollowing = auth()->check() ? auth()->user()->isFollowing($user) : false;

        return Inertia::render('User/Show', [
            'user' => $user
            //'isFollowing' => $isFollowing
        ]);
    }
}
