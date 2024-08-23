<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Follow;

class FollowController extends Controller
{
    public function follow(Request $request, $id)
    {
        $userToFollow = User::findOrFail($id);
        $user = Auth::user();

        if (!$user->isFollowing($userToFollow)) {
            Follow::create([
                'follower_id' => $user->id,
                'followed_id' => $userToFollow->id
            ]);
        }

        return Redirect::to('/users/{id}');
    }

    public function unfollow(Request $request, $id)
    {
        $userToUnfollow = User::findOrFail($id);
        $user = Auth::user();

        if ($user->isFollowing($userToUnfollow)) {
            Follow::where('follower_id', $user->id)
                ->where('followed_id', $userToUnfollow->id)
                ->delete();
        }

        return Redirect::to('/users/{id}');
    }
}
