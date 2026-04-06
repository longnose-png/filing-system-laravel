<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FriendController extends Controller
{
    public function index()
    {
        // Get your current friends
        $friends = auth()->user()->friends;
        
        // Get all users except yourself and people already in your contacts
        $users = User::where('id', '!=', auth()->id())
                     ->whereNotIn('id', $friends->pluck('id'))
                     ->get();
        
        return view('friends.index', compact('friends', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate(['friend_id' => 'required|exists:users,id']);
        
        // Attach the friend to the user (Friendships table)
        auth()->user()->friends()->syncWithoutDetaching($request->friend_id);
        
        return back()->with('success', 'Contact added successfully!');
    }
}