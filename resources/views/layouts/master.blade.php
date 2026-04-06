<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileSys - @yield('title', 'Management System')</title>
    
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', sans-serif; }
        .sidebar { height: 100vh; background: #1a1d20; color: white; position: fixed; width: 260px; padding-top: 20px; z-index: 1000; }
        .sidebar a { color: #9ca3af; text-decoration: none; padding: 12px 25px; display: block; transition: 0.3s; border-left: 4px solid transparent; }
        .sidebar a:hover, .sidebar a.active { background: #2d3339; color: white; border-left: 4px solid #0d6efd; }
        .sidebar-heading { padding: 15px 25px 5px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700; letter-spacing: 1px; }
        .main-content { margin-left: 260px; padding: 30px; min-height: 100vh; }
        .top-nav { background: white; border-bottom: 1px solid #e5e7eb; padding: 12px 30px; margin-left: 260px; position: sticky; top: 0; z-index: 999; }
        .search-input { border-radius: 20px; padding-left: 40px; background: #f3f4f6; border: 1px solid #e5e7eb; width: 350px; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar shadow">
        <div class="px-4 mb-4">
            <h4 class="fw-bold text-white"><i class="bi bi-folder-fill text-primary me-2"></i>FileSys</h4>
        </div>
        
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        
        <div class="sidebar-heading">File Categories</div>
        <a href="{{ route('category.show', 'document') }}"><i class="bi bi-file-earmark-text me-2"></i> Documents</a>
        <a href="{{ route('category.show', 'image') }}"><i class="bi bi-image me-2"></i> Images</a>
        <a href="{{ route('category.show', 'video') }}"><i class="bi bi-play-btn me-2"></i> Videos</a>
        
        <div class="sidebar-heading">My Storage</div>
        <a href="{{ route('folders.index') }}"><i class="bi bi-folder2 me-2"></i> My Folders</a>
        <a href="{{ route('files.recent') }}"><i class="bi bi-clock-history me-2"></i> Recent Files</a>
        <a href="{{ route('folders.shared') }}" class="{{ request()->routeIs('folders.shared') ? 'active' : '' }}">
          <i class="bi bi-share me-2"></i> Shared Folders
        </a>
        
        <div class="sidebar-heading">Settings & Security</div>
        <a href="{{ route('profile.edit') }}"><i class="bi bi-person-gear me-2"></i> My Account</a>
        <a href="{{ route('friends.index') }}"><i class="bi bi-person-plus me-2"></i> My Contacts</a>
        <a href="{{ route('logs.index') }}"><i class="bi bi-journal-text me-2"></i> Activity Logs</a>
        
        <div class="px-3 mt-5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 rounded-pill btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Top Navigation -->
    <div class="top-nav d-flex align-items-center justify-content-between">
        <!-- Search Bar Logic -->
        <form action="{{ route('search') }}" method="GET" class="position-relative">
            <i class="bi bi-search position-absolute" style="left: 15px; top: 10px; color: #9ca3af;"></i>
            <input type="text" name="query" class="form-control search-input" placeholder="Search files or folders..." value="{{ request('query') }}">
        </form>

        <div class="d-flex align-items-center">
            <div class="text-end me-3 d-none d-md-block">
                <p class="mb-0 small fw-bold text-dark">{{ Auth::user()->name }}</p>
                <p class="mb-0 small text-muted" style="font-size: 11px;">System User</p>
            </div>
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0d6efd&color=fff" 
                 class="rounded-circle border" width="40" height="40">
        </div>
    </div>

    <!-- Page Content -->
    <div class="main-content">
        <!-- Status Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Include Modals (Folder & Upload) -->
    @include('layouts.modals')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>