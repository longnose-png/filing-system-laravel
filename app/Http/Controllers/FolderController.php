<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use App\Models\File;
use App\Models\ActivityLog; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller 
{
    /**
     * Display a listing of folders created by the user.
     * (Linked to "My Folders" in Sidebar)
     */
    public function index() 
    {
        $myFolders = Folder::where('user_id', Auth::id())->latest()->get();
        
        // We return a dedicated index view for "My Folders"
        return view('folders.index', compact('myFolders'));
    }

    /**
     * Create a new folder.
     */
    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|max:255',
            'password' => 'nullable|min:4'
        ]);
        
        $folder = Folder::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'password' => $request->password ? Hash::make($request->password) : null,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Created Folder',
            'details' => 'Folder Name: ' . $request->name
        ]);

        return back()->with('success', 'Folder created successfully!');
    }

    /**
     * Show a specific folder (with Privacy and Password checks).
     */
    public function show(Folder $folder) 
    {
        // 1. PRIVACY CHECK: Only Owner or Shared Users can enter
        $isOwner = $folder->user_id === Auth::id();
        $isShared = $folder->sharedWith->contains(Auth::id());

        if (!$isOwner && !$isShared) {
            abort(403, 'Access Denied. You do not have permission to view this folder.');
        }

        // 2. PASSWORD CHECK: Only for Folders with passwords
        if ($folder->password && !session()->has("folder_auth_{$folder->id}")) {
            return view('folders.lock', compact('folder'));
        }

        // 3. LOAD FILES: Get files belonging to this folder
        $folder->load('files');
        return view('folders.show', compact('folder'));
    }
    
    /**
     * Unlock a password-protected folder.
     */
    public function verifyPassword(Request $request, Folder $folder) 
    {
        $request->validate(['password' => 'required']);

        if (Hash::check($request->password, $folder->password)) {
            // Save "Unlocked" status in session for this folder ID
            session(["folder_auth_{$folder->id}" => true]);
            return redirect()->route('folders.show', $folder->id);
        }

        return back()->withErrors(['password' => 'Incorrect password!']);
    }

    /**
     * Share a folder with a friend.
     */
    public function share(Request $request, Folder $folder)
    {
        // Security: Only the owner can share the folder
        if ($folder->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate(['friend_id' => 'required|exists:users,id']);

        // Sync without detaching avoids duplicates in the pivot table
        $folder->sharedWith()->syncWithoutDetaching($request->friend_id);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Shared Folder',
            'details' => 'Shared ' . $folder->name . ' with a contact.'
        ]);

        return back()->with('success', 'Folder shared successfully!');
    }

    /**
     * Display folders that other users shared with the logged-in user.
     */
    public function shared()
    {
    // Fetch folders shared with the logged-in user 
    // We 'eager load' the owner (user) to show their name in the list
    $sharedFolders = auth()->user()->sharedFolders()->with('user')->get();

    return view('folders.shared', compact('sharedFolders'));
    }

    /**
     * Delete a folder and its contents.
     */
    public function destroy(Folder $folder)
    {
        if ($folder->user_id !== Auth::id()) {
            abort(403);
        }


        $folder->delete();

        return redirect()->route('dashboard')->with('success', 'Folder deleted.');
    }

    
}