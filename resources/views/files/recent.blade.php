@extends('layouts.master')

@section('title', 'Recent Files')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-[#26282A]">Recent Files</h2>
        <p class="text-slate-500 text-sm">Review the files you have uploaded across all folders.</p>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-[32px] shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50">
                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">File Name</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Size</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Date Uploaded</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-400 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($files as $file)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-slate-100 rounded-lg group-hover:bg-white transition-colors">
                                        @if($file->type == 'image')
                                            <i class="bi bi-image text-blue-500"></i>
                                        @elseif($file->type == 'video')
                                            <i class="bi bi-play-btn text-purple-500"></i>
                                        @else
                                            <i class="bi bi-file-earmark-text text-emerald-500"></i>
                                        @endif
                                    </div>
                                    <span class="font-medium text-sm text-[#26282A]">{{ $file->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">
                                <span class="px-3 py-1 bg-slate-100 rounded-full text-xs font-medium uppercase">
                                    {{ $file->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ number_format($file->size / 1024, 2) }} KB
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $file->created_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="p-2 text-slate-400 hover:text-[#26282A] hover:bg-white rounded-xl transition-all">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <form action="{{ route('files.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <!-- Delete Button (Triggers the custom modal) -->
                                <button type="button" 
                                   x-data 
                                   @click="$dispatch('open-delete-modal', { id: {{ $file->id }}, name: '{{ addslashes($file->name) }}' })" 
                                   class="px-4 py-2.5 bg-red-50 text-red-600 hover:bg-red-100 text-sm font-medium rounded-xl transition-colors"
                                   title="Delete">
                                   <i class="bi bi-trash"></i>
                                </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="bi bi-clock-history text-4xl text-slate-200 mb-4"></i>
                                    <p class="text-slate-400 font-medium">No recent files found.</p>
                                    <p class="text-slate-300 text-xs">Files you upload will appear here.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="mt-6">
        {{ $files->links() }}
    </div>
</div>
@endsection