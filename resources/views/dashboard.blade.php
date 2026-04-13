@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<!-- Header Section -->
<div class="flex items-left justify-between mb-8">
    <div>
       
    </div>
    <div class="flex gap-3">
        <button x-data @click="$dispatch('open-folder-modal')" class="px-5 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl text-sm font-medium hover:bg-slate-50 transition-colors shadow-sm flex items-center gap-2">
            <i class="bi bi-folder-plus text-lg"></i> New Folder
        </button>
        <button x-data @click="$dispatch('open-upload-modal')" class="px-5 py-2.5 bg-[#26282A] text-white rounded-xl text-sm font-medium hover:bg-[#151617] transition-colors shadow-sm flex items-center gap-2">
            <i class="bi bi-cloud-arrow-up text-lg"></i> Upload File
        </button>
    </div>
</div>

<!-- CATEGORY TABS (Documents, Images, Videos) -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-1 ">
    <a href="{{ route('category.show', 'document') }}" class="group block">
        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-transparent hover:border-blue-100 hover:shadow-md transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-blue-500"></div>
            <div class="flex items-center gap-4">
                <div class="bg-blue-50 p-4 rounded-2xl group-hover:scale-110 transition-transform">
                    <i class="bi bi-file-earmark-text text-2xl text-blue-600"></i>
                </div>
                <div>
                    <h5 class="text-lg font-bold text-[#26282A] mb-1">Documents</h5>
                    <p class="text-sm text-slate-500">{{ $docCount }} Files</p>
                </div>
            </div>
        </div>
    </a>

    <a href="{{ route('category.show', 'image') }}" class="group block">
        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-transparent hover:border-emerald-100 hover:shadow-md transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-emerald-500"></div>
            <div class="flex items-center gap-4">
                <div class="bg-emerald-50 p-4 rounded-2xl group-hover:scale-110 transition-transform">
                    <i class="bi bi-image text-2xl text-emerald-600"></i>
                </div>
                <div>
                    <h5 class="text-lg font-bold text-[#26282A] mb-1">Images</h5>
                    <p class="text-sm text-slate-500">{{ $imgCount }} Files</p>
                </div>
            </div>
        </div>
    </a>

    <a href="{{ route('category.show', 'video') }}" class="group block">
        <div class="bg-white rounded-[24px] p-6 shadow-sm border border-transparent hover:border-amber-100 hover:shadow-md transition-all duration-200 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-amber-400"></div>
            <div class="flex items-center gap-4">
                <div class="bg-amber-50 p-4 rounded-2xl group-hover:scale-110 transition-transform">
                    <i class="bi bi-play-btn text-2xl text-amber-500"></i>
                </div>
                <div>
                    <h5 class="text-lg font-bold text-[#26282A] mb-1">Videos</h5>
                    <p class="text-sm text-slate-500">{{ $vidCount }} Files</p>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
    
    <!-- RECENT FILES SECTION -->
    <div class="xl:col-span-2 bg-white rounded-[32px] p-8 shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-[#26282A]">Recent Files</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left whitespace-nowrap">
                <thead class="text-xs text-slate-400 uppercase bg-white border-b border-slate-100">
                    <tr>
                        <th class="py-4 font-medium">File Name</th>
                        <th class="py-4 font-medium">Type</th>
                        <th class="py-4 font-medium">Uploaded At</th>
                        <th class="py-4 font-medium text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentFiles as $file)
                    <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors">
                        <td class="py-4">
                            <div class="flex items-center gap-3">
                                <div class="bg-slate-100 p-2 rounded-lg text-slate-500">
                                    <i class="bi bi-file-earmark-fill text-lg"></i>
                                </div>
                                <span class="font-medium text-[#26282A]">{{ $file->name }}</span>
                            </div>
                        </td>
                        <td class="py-4">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                {{ ucfirst($file->type) }}
                            </span>
                        </td>
                        <td class="py-4 text-slate-600">{{ $file->created_at->diffForHumans() }}</td>
                        <td class="py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="text-slate-400 hover:text-blue-600 p-2 rounded-full hover:bg-blue-50 transition-colors">
                                    <i class="bi bi-eye text-lg"></i>
                                </a>
                                <button type="button" 
        x-data 
        @click="$dispatch('open-delete-modal', { id: {{ $file->id }}, name: '{{ addslashes($file->name) }}' })" 
        class="text-slate-400 hover:text-red-600 p-2 rounded-full hover:bg-red-50 transition-colors" 
        title="Delete">
    <i class="bi bi-trash text-lg"></i>
</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-12 text-slate-500">
                            <i class="bi bi-inbox text-4xl block mb-3 text-slate-300"></i>
                            No recent files found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- MY FOLDERS SECTION -->
    <div class="xl:col-span-1 bg-[#26282A] rounded-[32px] p-8 shadow-sm text-white">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold">My Folders</h2>
            <a href="{{ route('folders.index') }}" class="text-sm text-slate-400 hover:text-white transition-colors">View All</a>
        </div>

        <div class="space-y-3">
            @forelse($myFolders as $folder)
                <a href="{{ route('folders.show', $folder->id) }}" class="block">
                    <div class="bg-white/10 hover:bg-white/20 border border-white/5 rounded-2xl p-4 flex items-center gap-4 transition-all duration-200">
                        <div class="bg-amber-400/20 p-3 rounded-xl text-amber-400">
                            <i class="bi bi-folder-fill text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h6 class="font-bold text-sm mb-0.5">{{ $folder->name }}</h6>
                            @if($folder->password) 
                                <span class="text-xs text-slate-400 flex items-center gap-1"><i class="bi bi-lock-fill"></i> Password Protected</span>
                            @else
                                <span class="text-xs text-slate-400">Public Access</span>
                            @endif
                        </div>
                        <i class="bi bi-chevron-right text-slate-500"></i>
                    </div>
                </a>
            @empty
                <div class="text-center py-8 bg-white/5 rounded-2xl border border-white/10 border-dashed">
                    <p class="text-slate-400 text-sm mb-0">No folders yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection