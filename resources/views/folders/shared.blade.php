@extends('layouts.master')

@section('content')
<div class="mb-8">
    <h2 class="text-2xl font-bold text-[#26282A]">Shared Folders</h2>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @forelse($sharedFolders as $folder)
    <a href="{{ route('folders.show', $folder->id) }}" class="group block">
        <div class="bg-white rounded-[24px] p-6 text-center shadow-sm border border-transparent hover:border-cyan-100 hover:shadow-md transition-all duration-200 h-full flex flex-col justify-center">
            
            <div class="inline-flex bg-cyan-50 p-4 rounded-2xl mb-4 group-hover:scale-110 transition-transform duration-300 mx-auto">
                <i class="bi bi-people-fill text-4xl text-cyan-500"></i>
            </div>
            
            <h6 class="font-bold text-[#26282A] truncate mb-1" title="{{ $folder->name }}">{{ $folder->name }}</h6>
            <p class="text-xs text-slate-500">Owner: <span class="font-medium text-slate-700">{{ $folder->user->name }}</span></p>
            
        </div>
    </a>
    @empty
    <div class="col-span-full bg-white rounded-[32px] p-12 text-center shadow-sm border border-slate-100 border-dashed">
        <i class="bi bi-share text-5xl text-slate-300 mb-4 block"></i>
        <h3 class="text-xl font-bold text-[#26282A] mb-2">No shared folders</h3>
        <p class="text-slate-500">No folders have been shared with you yet.</p>
    </div>
    @endforelse
</div>
@endsection