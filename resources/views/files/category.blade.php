@extends('layouts.master')
@section('content')

<div class="mb-8 flex items-center justify-between">
    <h2 class="text-2xl font-bold text-[#26282A]">{{ ucfirst($type) }}s</h2>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @forelse($files as $file)
    <div class="bg-white rounded-[24px] p-6 text-center shadow-sm border border-slate-100 flex flex-col justify-between group hover:border-slate-200 hover:shadow-md transition-all duration-200">
        
        <!-- Icon & File Name -->
        <div>
            <div class="inline-flex bg-blue-50 p-4 rounded-2xl mb-4 group-hover:scale-110 transition-transform duration-300">
                <i class="bi bi-file-earmark-{{ $type == 'image' ? 'image' : ($type == 'video' ? 'play' : 'text') }} text-3xl text-blue-600"></i>
            </div>
            <h6 class="font-bold text-[#26282A] truncate mb-6" title="{{ $file->name }}">{{ $file->name }}</h6>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex items-center gap-2 mt-auto">
            <!-- View Button -->
            <a href="{{ asset('storage/'.$file->path) }}" target="_blank" class="flex-1 py-2.5 bg-slate-50 hover:bg-slate-100 text-slate-700 text-sm font-medium rounded-xl transition-colors">
                View
            </a>
            
            <!-- Delete Button (Triggers the custom modal) -->
            <button type="button" 
                    x-data 
                    @click="$dispatch('open-delete-modal', { id: {{ $file->id }}, name: '{{ addslashes($file->name) }}' })" 
                    class="px-4 py-2.5 bg-red-50 text-red-600 hover:bg-red-100 text-sm font-medium rounded-xl transition-colors"
                    title="Delete">
                <i class="bi bi-trash"></i>
            </button>
        </div>
        
    </div>
    @empty
    
    <!-- Empty State -->
    <div class="col-span-full bg-white rounded-[32px] p-12 text-center shadow-sm">
        <i class="bi bi-file-earmark-x text-5xl text-slate-300 mb-4 block"></i>
        <h3 class="text-xl font-bold text-[#26282A] mb-2">No {{ $type }}s found</h3>
        <p class="text-slate-500">You haven't uploaded any {{ $type }}s yet.</p>
    </div>
    
    @endforelse
</div>

@endsection