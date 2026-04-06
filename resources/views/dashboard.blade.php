@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')

<!-- Header Section -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Dashboard</h2>
        <p class="text-muted">Quick access to your files and categories</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-dark shadow-sm px-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#newFolderModal">
            <i class="bi bi-folder-plus me-1"></i> New Folder
        </button>
        <button class="btn btn-primary shadow-sm px-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#uploadFileModal">
            <i class="bi bi-cloud-arrow-up me-1"></i> Upload File
        </button>
    </div>
</div>

<!-- CATEGORY TABS (Documents, Images, Videos) -->
<div class="row g-4 mb-5">
    <!-- Documents Tab -->
    <div class="col-md-4">
        <a href="{{ route('category.show', 'document') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 bg-white p-3 card-hover" style="border-left: 5px solid #0d6efd !important;">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="bi bi-file-earmark-text fs-2 text-primary"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Documents</h5>
                        <small class="text-muted">{{ $docCount }} Files</small>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Images Tab -->
    <div class="col-md-4">
        <a href="{{ route('category.show', 'image') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 bg-white p-3 card-hover" style="border-left: 5px solid #198754 !important;">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="bi bi-image fs-2 text-success"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Images</h5>
                        <small class="text-muted">{{ $imgCount }} Files</small>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Videos Tab -->
    <div class="col-md-4">
        <a href="{{ route('category.show', 'video') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 bg-white p-3 card-hover" style="border-left: 5px solid #ffc107 !important;">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                        <i class="bi bi-play-btn fs-2 text-warning"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold text-dark">Videos</h5>
                        <small class="text-muted">{{ $vidCount }} Files</small>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- MY FOLDERS SECTION -->
<div class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">My Folders</h5>
        <a href="{{ route('folders.index') }}" class="btn btn-sm btn-link text-decoration-none p-0">View All</a>
    </div>
    <div class="row g-3">
        @forelse($myFolders->take(4) as $folder)
        <div class="col-md-3">
            <a href="{{ route('folders.show', $folder->id) }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm text-center p-3 h-100 bg-white">
                    <i class="bi bi-folder-fill fs-1 text-warning mb-2"></i>
                    <h6 class="text-dark mb-1">{{ $folder->name }}</h6>
                    @if($folder->password)
                        <span class="badge bg-light text-muted fw-normal"><i class="bi bi-lock-fill me-1"></i>Secure</span>
                    @endif
                </div>
            </a>
        </div>
        @empty
        <div class="col-12 text-center py-4 bg-white rounded shadow-sm border border-dashed">
            <p class="text-muted mb-0">No folders yet. Click "New Folder" to organize your files.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- RECENT FILES SECTION -->
<div>
    <h5 class="fw-bold mb-3">Recent Files</h5>
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-muted fw-semibold">File Name</th>
                        <th class="py-3 text-muted fw-semibold">Type</th>
                        <th class="py-3 text-muted fw-semibold">Uploaded At</th>
                        <th class="pe-4 text-end py-3 text-muted fw-semibold">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentFiles as $file)
                    <tr>
                        <td class="ps-4">
                            <i class="bi bi-file-earmark-fill text-primary me-2"></i> {{ $file->name }}
                        </td>
                        <td><span class="badge rounded-pill bg-light text-dark border">{{ ucfirst($file->type) }}</span></td>
                        <td>{{ $file->created_at->format('M d, Y') }}</td>
                        <td class="pe-4 text-end">
                            <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="btn btn-sm btn-light border"><i class="bi bi-eye"></i></a>
                            <button class="btn btn-sm btn-light border text-danger"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            No recent files found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .card-hover { transition: all 0.2s ease-in-out; }
    .card-hover:hover { transform: scale(1.02); background-color: #fcfcfc !important; }
</style>

@endsection