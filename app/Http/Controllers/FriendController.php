<?php
namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index()
    {
        $friends = Friend::where('user_id', auth()->id())->orWhere('friend_id', auth()->id())->get();
        return view('friends.index', compact('friends'));
    }

    public function store(Request $request)
    {
        $friend = User::where('email', $request->friend_email)->orWhere('name', $request->friend_name)->first();
        if ($friend) {
            Friend::create([
                'user_id' => auth()->id(),
                'friend_id' => $friend->id,
                'status' => 'pending'
            ]);
        }

        return redirect()->route('friends.index');
    }

    public function update(Request $request, Friend $friend)
    {
        $friend->update(['status' => $request->status]);
        return redirect()->route('friends.index');
    }

    public function destroy(Friend $friend)
    {
        $friend->delete();
        return redirect()->route('friends.index');
    }
}

