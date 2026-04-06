<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Folder;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Storage;

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

    // 2. Category Filter (Documents, Images, Videos)
    public function category($type)
    {
        $files = File::where('user_id', auth()->id())->where('type', $type)->get();
        return view('files.category', compact('files', 'type'));
    }

    // 3. Upload File Logic
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|max:20480', // 20MB Max
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension = strtolower($file->getClientOriginalExtension());
        
        // Determine file type automatically
        $type = 'document';
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'jfif'])) $type = 'image';
        elseif (in_array($extension, ['mp4', 'mov', 'avi', 'mkv'])) $type = 'video';

        // Save to storage/app/public/uploads
        $path = $file->store('uploads', 'public');

        // Create Database Record
        File::create([
            'user_id' => auth()->id(),
            'folder_id' => $request->folder_id, // can be null
            'name' => $originalName,
            'path' => $path,
            'type' => $type,
            'size' => $file->getSize(),
        ]);

        // Log the Activity
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Uploaded File',
            'details' => 'Uploaded ' . $originalName
        ]);

        return back()->with('success', 'File uploaded successfully!');
    }

    // 4. Delete File Logic
    public function destroy(File $file)
    {
        // Delete physical file from XAMPP storage
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

    // 5. Search Logic
    public function search(Request $request)
    {
        $query = $request->input('query');
        $uid = auth()->id();
        
        $files = File::where('user_id', $uid)->where('name', 'LIKE', "%$query%")->get();
        $folders = Folder::where('user_id', $uid)->where('name', 'LIKE', "%$query%")->get();

        return view('search-results', compact('files', 'folders', 'query'));
    }

    // 6. Recent Files Page
    public function recent()
    {
        $files = File::where('user_id', auth()->id())->latest()->paginate(20);
        return view('files.recent', compact('files'));
    }

    // 7. Activity Logs Page
    public function logs()
    {
        $logs = ActivityLog::where('user_id', auth()->id())->latest()->get();
        return view('logs.index', compact('logs'));
    }
}