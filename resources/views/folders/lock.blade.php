@extends('layouts.master')

@section('title', 'Locked Folder')

@section('content')
<div class="flex items-center justify-center h-full min-h-[60vh]">
    <div class="w-full max-w-md bg-white rounded-[32px] p-8 text-center shadow-xl border border-slate-100">
        
        <div class="mx-auto w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mb-6">
            <i class="bi bi-shield-lock-fill text-4xl text-red-500"></i>
        </div>
        
        <h3 class="text-2xl font-bold text-[#26282A] mb-2">Locked Folder</h3>
        <p class="text-slate-500 text-sm mb-8">This folder is password-protected. Please enter the correct password to access the files inside.</p>
        
        <form action="{{ route('folders.verify', $folder->id) }}" method="POST">
            @csrf
            <div class="mb-6">
                <input type="password" name="password" 
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-4 text-center text-lg tracking-widest focus:ring-2 focus:ring-[#26282A] outline-none transition-all" 
                       placeholder="••••••••" required autofocus>
            </div>
            
            <button type="submit" class="w-full py-3.5 bg-[#26282A] text-white rounded-xl font-medium hover:bg-[#151617] transition-colors shadow-sm flex items-center justify-center gap-2 mb-4">
                <i class="bi bi-unlock-fill"></i> Unlock Folder
            </button>
        </form>

        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-sm text-slate-400 hover:text-[#26282A] transition-colors">
            <i class="bi bi-arrow-left"></i> Cancel and Go Back
        </a>
    </div>
</div>
@endsection