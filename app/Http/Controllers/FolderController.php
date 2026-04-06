<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;
use Illuminate\Support\Facades\Hash;

class FolderController extends Controller {
    public function store(Request $request) {
        $request->validate(['name' => 'required']);
        
        Folder::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'password' => $request->password ? Hash::make($request->password) : null,
        ]);

        return back()->with('success', 'Folder created successfully!');
    }

    public function show(Folder $folder) {
        // If folder has password and not yet verified in session
        if ($folder->password && !session("folder_auth_{$folder->id}")) {
            return view('folders.lock', compact('folder'));
        }
        return view('folders.show', compact('folder'));
    }
}
