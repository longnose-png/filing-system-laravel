@extends('layouts.master')

@section('title', 'Locked Folder')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card border-0 shadow-lg p-4 rounded-4 text-center">
            <div class="card-body">
                <div class="bg-danger bg-opacity-10 rounded-circle p-4 d-inline-block mb-4">
                    <i class="bi bi-shield-lock-fill text-danger fs-1"></i>
                </div>
                <h3 class="fw-bold">Locked Folder</h3>
                <p class="text-muted small mb-4">This folder is password-protected. Please enter the correct password to access the files inside.</p>
                
                <form action="{{ route('folders.verify', $folder->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <input type="password" name="password" 
                               class="form-control form-control-lg text-center" 
                               placeholder="••••••••" required autofocus>
                    </div>
                    <button type="submit" class="btn btn-danger btn-lg w-100 rounded-pill shadow-sm">
                        <i class="bi bi-unlock-fill me-2"></i> Unlock Folder
                    </button>
                </form>

                <a href="{{ route('dashboard') }}" class="btn btn-link mt-3 text-decoration-none text-muted">
                    <i class="bi bi-arrow-left me-1"></i> Cancel and Go Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection