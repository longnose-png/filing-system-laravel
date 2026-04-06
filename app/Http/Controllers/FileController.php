<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Folder;
use App\Models\ActivityLog;

class FileController extends Controller {
    public function dashboard() {
        $uid = auth()->id();
        return view('dashboard', [
            'docCount' => File::where('user_id', $uid)->where('type', 'document')->count(),
            'imgCount' => File::where('user_id', $uid)->where('type', 'image')->count(),
            'vidCount' => File::where('user_id', $uid)->where('type', 'video')->count(),
            'recentFiles' => File::where('user_id', $uid)->latest()->take(5)->get(),
            'myFolders' => Folder::where('user_id', $uid)->get(),
        ]);
    }

    public function upload(Request $request) {
        $request->validate(['file' => 'required|max:10240']); // 10MB limit
        $uploadedFile = $request->file('file');
        $ext = strtolower($uploadedFile->getClientOriginalExtension());
        
        // Determine type
        $type = 'document';
        if (in_array($ext, ['jpg', 'png', 'jpeg', 'gif'])) $type = 'image';
        if (in_array($ext, ['mp4', 'mov', 'avi'])) $type = 'video';

        $path = $uploadedFile->store('uploads', 'public');

        File::create([
            'user_id' => auth()->id(),
            'folder_id' => $request->folder_id, // optional
            'name' => $uploadedFile->getClientOriginalName(),
            'path' => $path,
            'type' => $type,
        ]);

        return back()->with('success', 'File uploaded!');
    }
}
