@extends('layouts.master')
@section('content')
<h2 class="fw-bold mb-4">{{ ucfirst($type) }}s</h2>
<div class="row g-3">
    @forelse($files as $file)
    <div class="col-md-3">
        <div class="card shadow-sm border-0 text-center p-3">
            <i class="bi bi-file-earmark-{{ $type == 'image' ? 'image' : ($type == 'video' ? 'play' : 'text') }} fs-1 text-primary"></i>
            <h6 class="mt-2">{{ $file->name }}</h6>
            <a href="{{ asset('storage/'.$file->path) }}" target="_blank" class="btn btn-sm btn-outline-primary">View</a>
        </div>
    </div>
    @empty
    <p class="text-muted">No {{ $type }}s found.</p>
    @endforelse
</div>
@endsection