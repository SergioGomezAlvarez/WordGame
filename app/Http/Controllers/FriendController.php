<?php
namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function addFriend(Request $request)
    {
        $request->validate([
            'friend_id' => 'required|exists:users,id'
        ]);

        $friend = new Friend();
        $friend->user_id = auth()->id();
        $friend->friend_id = $request->friend_id;
        $friend->status = 'pending';
        $friend->save();

        return back()->with('success', 'Friend request sent.');
    }

    public function acceptFriend(Request $request, Friend $friend)
    {
        $this->authorize('update', $friend);
        $friend->update(['status' => 'accepted']);

        return back()->with('success', 'Friend request accepted.');
    }

    public function declineFriend(Request $request, Friend $friend)
    {
        $this->authorize('update', $friend);
        $friend->update(['status' => 'declined']);

        return back()->with('success', 'Friend request declined.');
    }
}

