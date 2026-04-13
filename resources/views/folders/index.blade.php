@extends('layouts.master')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-2xl font-bold text-[#26282A]">My Personal Folders</h2>
    <button x-data @click="$dispatch('open-folder-modal')" class="px-5 py-2.5 bg-[#26282A] text-white rounded-xl text-sm font-medium hover:bg-[#151617] transition-colors shadow-sm flex items-center gap-2">
        <i class="bi bi-folder-plus text-lg"></i> New Folder
    </button>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @forelse($myFolders as $folder)
    <div class="bg-white rounded-[24px] p-6 text-center shadow-sm border border-slate-100 flex flex-col justify-between group hover:border-slate-200 hover:shadow-md transition-all duration-200">
        
        <a href="{{ route('folders.show', $folder->id) }}" class="block mb-6">
            <div class="inline-flex bg-amber-50 p-4 rounded-2xl mb-4 group-hover:scale-110 transition-transform duration-300 relative">
                <i class="bi bi-folder-fill text-4xl text-amber-400"></i>
                @if($folder->password)
                    <div class="absolute -bottom-1 -right-1 bg-white rounded-full p-1 shadow-sm">
                        <i class="bi bi-lock-fill text-slate-400 text-xs"></i>
                    </div>
                @endif
            </div>
            <h6 class="font-bold text-[#26282A] truncate" title="{{ $folder->name }}">{{ $folder->name }}</h6>
            @if($folder->password) 
                <span class="inline-block mt-2 px-2.5 py-0.5 bg-slate-100 text-slate-500 text-[10px] font-bold uppercase tracking-wider rounded-full">Secure</span>
            @endif
        </a>
        
        <div class="flex items-center gap-2 pt-4 border-t border-slate-100 mt-auto">
            <!-- Share Button -->
            <button type="button" 
                    onclick="openShareModal('{{ $folder->id }}', '{{ addslashes($folder->name) }}')"
                    class="flex-1 py-2 bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-medium rounded-xl transition-colors flex items-center justify-center gap-1.5">
                <i class="bi bi-share"></i> Share
            </button>
            
            <!-- Delete Button -->
            <button type="button" 
                    x-data 
                    @click="$dispatch('open-delete-modal', { id: {{ $folder->id }}, name: '{{ addslashes($folder->name) }}' })" 
                    class="px-3 py-2 bg-red-50 text-red-600 hover:bg-red-100 text-xs font-medium rounded-xl transition-colors"
                    title="Delete">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    </div>
    @empty
    <div class="col-span-full bg-white rounded-[32px] p-12 text-center shadow-sm border border-slate-100 border-dashed">
        <i class="bi bi-folder-x text-5xl text-slate-300 mb-4 block"></i>
        <h3 class="text-xl font-bold text-[#26282A] mb-2">No folders created yet</h3>
        <p class="text-slate-500">Click "New Folder" to start organizing your files.</p>
    </div>
    @endforelse
</div>
@endsection