<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FriendController;
use Illuminate\Support\Facades\Route;

// Redirect to Register if not logged in
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('register');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard & Sidebar Links
    Route::get('/dashboard', [FileController::class, 'dashboard'])->name('dashboard');
    Route::get('/search', [FileController::class, 'search'])->name('search');
    Route::get('/category/{type}', [FileController::class, 'category'])->name('category.show');
    Route::get('/recent-files', [FileController::class, 'recent'])->name('files.recent');
    Route::get('/activity-logs', [FileController::class, 'logs'])->name('logs.index');

    // FOLDERS (Cleaned up and added the missing Delete route)
    Route::get('/my-folders', [FolderController::class, 'index'])->name('folders.index');
    Route::post('/folders', [FolderController::class, 'store'])->name('folders.store');
    Route::get('/folders/{folder}', [FolderController::class, 'show'])->name('folders.show');
    
    // THIS WAS THE MISSING LINE:
    Route::delete('/folders/{folder}', [FolderController::class, 'destroy'])->name('folders.destroy');
    
    Route::post('/folders/verify/{folder}', [FolderController::class, 'verifyPassword'])->name('folders.verify');
    Route::post('/folders/{folder}/share', [FolderController::class, 'share'])->name('folders.share');
    Route::get('/shared-folders', [FolderController::class, 'shared'])->name('folders.shared');

    // File Upload/Delete
    Route::post('/upload', [FileController::class, 'upload'])->name('files.upload');
    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');

    // Account (Breeze default routes)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Friends
    Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
    Route::post('/friends', [FriendController::class, 'store'])->name('friends.store');
});

require __DIR__.'/auth.php';