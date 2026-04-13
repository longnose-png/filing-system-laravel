@extends('layouts.master')
@section('content')

<div class="mb-8">
    <h2 class="text-2xl font-bold text-[#26282A]">Search Results for: <span class="text-blue-600">"{{ $query }}"</span></h2>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Folders -->
    @foreach($folders as $folder)
    <a href="{{ route('folders.show', $folder->id) }}" class="group block">
        <div class="bg-white rounded-[24px] p-6 text-center shadow-sm border border-transparent hover:border-slate-200 hover:shadow-md transition-all duration-200">
            <div class="inline-flex bg-amber-50 p-4 rounded-2xl mb-4 group-hover:scale-110 transition-transform">
                <i class="bi bi-folder-fill text-3xl text-amber-400"></i>
            </div>
            <h6 class="font-bold text-[#26282A] truncate">{{ $folder->name }}</h6>
            <p class="text-xs text-slate-500 mt-1">Folder</p>
        </div>
    </a>
    @endforeach

    <!-- Files -->
    @foreach($files as $file)
    <div class="bg-white rounded-[24px] p-6 text-center shadow-sm border border-slate-100 flex flex-col justify-between">
        <div>
            <div class="inline-flex bg-blue-50 p-4 rounded-2xl mb-4">
                <i class="bi bi-file-earmark-text text-3xl text-blue-600"></i>
            </div>
            <h6 class="font-bold text-[#26282A] truncate mb-4">{{ $file->name }}</h6>
        </div>
        <a href="{{ asset('storage/'.$file->path) }}" target="_blank" class="w-full block py-2.5 bg-slate-50 hover:bg-slate-100 text-slate-700 text-sm font-medium rounded-xl transition-colors">
            View File
        </a>
    </div>
    @endforeach
</div>

@if($folders->isEmpty() && $files->isEmpty())
<div class="bg-white rounded-[32px] p-12 text-center shadow-sm">
    <i class="bi bi-search text-5xl text-slate-300 mb-4 block"></i>
    <h3 class="text-xl font-bold text-[#26282A] mb-2">No results found</h3>
    <p class="text-slate-500">We couldn't find anything matching "{{ $query }}".</p>
</div>
@endif

@endsection