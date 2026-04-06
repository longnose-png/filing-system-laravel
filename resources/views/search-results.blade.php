@extends('layouts.master')
@section('content')
<h2 class="fw-bold mb-4">Search Results for: "{{ $query }}"</h2>

<div class="row g-3">
    @foreach($folders as $folder)
    <div class="col-md-3">
        <a href="{{ route('folders.show', $folder->id) }}" class="card p-3 text-center text-decoration-none shadow-sm">
            <i class="bi bi-folder-fill text-warning fs-1"></i>
            <h6 class="text-dark">{{ $folder->name }}</h6>
        </a>
    </div>
    @endforeach

    @foreach($files as $file)
    <div class="col-md-3">
        <div class="card p-3 text-center shadow-sm">
            <i class="bi bi-file-earmark-text text-primary fs-1"></i>
            <h6 class="text-dark">{{ $file->name }}</h6>
            <a href="{{ asset('storage/'.$file->path) }}" target="_blank" class="btn btn-sm btn-link">View</a>
        </div>
    </div>
    @endforeach
</div>
@endsection