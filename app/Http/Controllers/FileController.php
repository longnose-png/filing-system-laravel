<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Folder;
use App\Models\ActivityLog;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function dashboard()
    {
        $uid = auth()->id();
        return view('dashboard', [
            'docCount' => File::where('user_id', $uid)->where('type', 'document')->count(),
            'imgCount' => File::where('user_id', $uid)->where('type', 'image')->count(),
            'vidCount' => File::where('user_id', $uid)->where('type', 'video')->count(),
            'recentFiles' => File::where('user_id', $uid)->latest()->take(10)->get(),
            'myFolders' => Folder::where('user_id', $uid)->get(),
        ]);
    }

    public function category($type)
    {
        $files = File::where('user_id', auth()->id())->where('type', $type)->get();
        return view('files.category', compact('files', 'type'));
    }

    public function upload(Request $request)
    {
        // 1. Validate (Handles both single 'file' and bulk 'files[]')
        $request->validate([
            'file' => 'nullable|max:20480',
            'files.*' => 'nullable|max:20480',
        ]);

        $uploadedCount = 0;

        // 2. Handle Bulk Upload (files[])
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $this->saveFile($file, $request->folder_id);
                $uploadedCount++;
            }
        } 
        // 3. Handle Single Upload (file)
        elseif ($request->hasFile('file')) {
            $this->saveFile($request->file('file'), $request->folder_id);
            $uploadedCount++;
        }

        if ($uploadedCount > 0) {
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => $uploadedCount > 1 ? 'Bulk Upload' : 'Uploaded File',
                'details' => "Uploaded $uploadedCount file(s)."
            ]);
            return back()->with('success', "$uploadedCount file(s) uploaded successfully!");
        }

        return back()->withErrors('No files selected.');
    }

    // Private helper to avoid repeating code
    private function saveFile($file, $folder_id)
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $type = 'document';
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'jfif'])) $type = 'image';
        elseif (in_array($extension, ['mp4', 'mov', 'avi', 'mkv'])) $type = 'video';

        $path = $file->store('uploads', 'public');

        File::create([
            'user_id' => auth()->id(),
            'folder_id' => $folder_id,
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'type' => $type,
            'size' => $file->getSize(),
        ]);
    }

    public function destroy(File $file)
    {
        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Deleted File',
            'details' => 'Deleted ' . $file->name
        ]);

        $file->delete();
        return back()->with('success', 'File removed from system.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $uid = auth()->id();
        $files = File::where('user_id', $uid)->where('name', 'LIKE', "%$query%")->get();
        $folders = Folder::where('user_id', $uid)->where('name', 'LIKE', "%$query%")->get();
        return view('search-results', compact('files', 'folders', 'query'));
    }

    public function recent()
    {
        $files = File::where('user_id', auth()->id())->latest()->paginate(20);
        return view('files.recent', compact('files'));
    }

   public function logs()
{
    $path = resource_path('views/activities.blade.php');
    

    $logs = \App\Models\ActivityLog::where('user_id', auth()->id())->latest()->paginate(10);
    return view('logs.activities', compact('logs'));
}

    public function loginLogs()
    {
        $logs = LoginHistory::where('user_id', auth()->id())->latest()->get();
        return view('logs.login', compact('logs'));
    }

    public function move(Request $request, File $file) 
    {
        $file->update(['folder_id' => $request->folder_id]);
        return back()->with('success', 'File moved!');
    }
}