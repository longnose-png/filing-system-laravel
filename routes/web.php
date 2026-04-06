<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('register');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard & Search
    Route::get('/dashboard', [FileController::class, 'dashboard'])->name('dashboard');
    Route::get('/search', [FileController::class, 'search'])->name('search');

    // Categories
    Route::get('/category/{type}', [FileController::class, 'category'])->name('category.show');

    // Folders
    Route::get('/folders', [FolderController::class, 'index'])->name('folders.index');
    Route::post('/folders', [FolderController::class, 'store'])->name('folders.store');
    Route::get('/folders/{folder}', [FolderController::class, 'show'])->name('folders.show');
    Route::post('/folders/verify/{folder}', [FolderController::class, 'verifyPassword'])->name('folders.verify');

    // Files
    Route::post('/upload', [FileController::class, 'upload'])->name('files.upload');
    Route::get('/recent', [FileController::class, 'recent'])->name('files.recent');

    // Logs
    Route::get('/logs', [FileController::class, 'logs'])->name('logs.index');
    
    // Account (Breeze handles these)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

require __DIR__.'/auth.php';