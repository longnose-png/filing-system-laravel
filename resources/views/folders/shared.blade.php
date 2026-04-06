@extends('layouts.master')

@section('content')
<h2 class="fw-bold mb-4">Shared Folders</h2>

<div class="row g-4">
    @forelse($sharedFolders as $folder)
    <div class="col-md-3">
        <div class="card border-0 shadow-sm p-3 text-center h-100 bg-white shadow-hover">
            <!-- Link to enter the shared folder -->
            <a href="{{ route('folders.show', $folder->id) }}" class="text-decoration-none text-dark">
                <i class="bi bi-people-fill text-info" style="font-size: 3rem;"></i>
                <h6 class="mt-2 fw-bold">{{ $folder->name }}</h6>
                <p class="text-muted small mb-0">Owner: {{ $folder->user->name }}</p>
            </a>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5 bg-white rounded shadow-sm border border-dashed">
        <i class="bi bi-share fs-1 text-muted d-block mb-2"></i>
        <p class="text-muted">No folders have been shared with you yet.</p>
    </div>
    @endforelse
</div>
@endsection