<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FriendRequest;
use App\Models\Friend;
use App\Models\User;
use Auth;

class FriendRequestController extends Controller
{
    public function sendRequest(Request $request)
    {
        $receiver = User::where('name', $request->name)->firstOrFail();
        FriendRequest::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiver->id,
        ]);
        return redirect()->back()->with('status', 'Friend request sent!');
    }

    public function acceptRequest($id)
    {
        $request = FriendRequest::findOrFail($id);
        Friend::create([
            'user_id' => $request->receiver_id,
            'friend_id' => $request->sender_id,
        ]);
        Friend::create([
            'user_id' => $request->sender_id,
            'friend_id' => $request->receiver_id,
        ]);
        $request->delete();
        return redirect()->back()->with('status', 'Friend request accepted!');
    }

    public function listRequests()
    {
        $requests = FriendRequest::where('receiver_id', Auth::id())->get();
        return view('friend_requests.index', compact('requests'));
    }

    public function listFriends()
{
    $friends = Auth::user()->friends;
    return view('friends.index', compact('friends'));
}

}

