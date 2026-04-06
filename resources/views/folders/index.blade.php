@extends('layouts.master')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">My Personal Folders</h2>
    <button class="btn btn-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#newFolderModal">
        <i class="bi bi-folder-plus me-1"></i> New Folder
    </button>
</div>

<div class="row g-4">
    @forelse($myFolders as $folder)
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center h-100 bg-white shadow-hover">
            <a href="{{ route('folders.show', $folder->id) }}" class="text-decoration-none text-dark d-block mb-2">
                <i class="bi bi-folder-fill text-warning fs-1"></i>
                <h6 class="mt-2 fw-bold">{{ $folder->name }}</h6>
                @if($folder->password) <span class="badge bg-light text-muted border fw-normal"><i class="bi bi-lock-fill"></i> Secure</span> @endif
            </a>
            
            <div class="mt-3 pt-2 border-top d-flex justify-content-center gap-2">
                <button class="btn btn-sm btn-outline-primary rounded-pill" 
                        data-bs-toggle="modal" data-bs-target="#shareFolderModal" 
                        onclick="openShareModal('{{ $folder->id }}', '{{ $folder->name }}')">
                    <i class="bi bi-share"></i> Share
                </button>
                
                <form action="{{ route('folders.destroy', $folder->id) }}" method="POST" onsubmit="return confirm('Delete folder?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger rounded-pill"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <p class="text-muted">No folders created yet.</p>
    </div>
    @endforelse
</div>
@endsection