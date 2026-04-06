@extends('layouts.master')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">{{ $folder->name }}</li>
            </ol>
        </nav>
        <h2 class="fw-bold">{{ $folder->name }}</h2>
    </div>
    <!-- Update your button to include the onclick event -->
<button class="btn btn-primary rounded-pill px-4" 
        data-bs-toggle="modal" 
        data-bs-target="#uploadFileModal" 
        onclick="document.getElementById('modal_folder_id').value = '{{ $folder->id }}'">
    <i class="bi bi-upload me-1"></i> Upload to this folder
</button>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Type</th>
                    <th>Size</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($folder->files as $file)
                <tr>
                    <td><i class="bi bi-file-earmark"></i> {{ $file->name }}</td>
                    <td>{{ ucfirst($file->type) }}</td>
                    <td>{{ number_format($file->size / 1024, 2) }} KB</td>
                    <td>
                        <a href="{{ asset('storage/'.$file->path) }}" target="_blank" class="btn btn-sm btn-light border">View</a>
                        <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-light border text-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-4">This folder is empty.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection