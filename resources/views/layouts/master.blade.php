<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileSys - @yield('title')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f4f7f6; font-family: 'Inter', sans-serif; }
        .sidebar { height: 100vh; background: #1a1d20; color: white; position: fixed; width: 250px; padding-top: 20px; z-index: 1000; transition: all 0.3s; }
        .sidebar a { color: #9ca3af; text-decoration: none; padding: 12px 25px; display: block; border-left: 4px solid transparent; font-size: 0.95rem; }
        .sidebar a:hover, .sidebar a.active { background: #2d3339; color: white; border-left: 4px solid #0d6efd; }
        .sidebar-heading { padding: 15px 25px 5px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; letter-spacing: 1px; font-weight: 700; }
        .main-content { margin-left: 250px; padding: 30px; min-height: 100vh; }
        .navbar-custom { background: white; border-bottom: 1px solid #e5e7eb; padding: 15px 30px; margin-left: 250px; }
        .search-input { border-radius: 10px; padding-left: 40px; background-color: #f9fafb; border: 1px solid #e5e7eb; width: 400px; }
        .search-container i { position: absolute; left: 15px; top: 10px; color: #9ca3af; }
        .card { border: none; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar shadow">
        <div class="px-4 mb-4 text-center">
            <h4 class="fw-bold text-white"><i class="bi bi-folder2-open text-primary me-2"></i>FileSys</h4>
        </div>
        
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill me-2"></i> Dashboard
        </a>
        
        <div class="sidebar-heading">Categories</div>
        <a href="{{ route('category.show', 'document') }}"><i class="bi bi-file-earmark-text me-2"></i> Documents</a>
        <a href="{{ route('category.show', 'image') }}"><i class="bi bi-image me-2"></i> Images</a>
        <a href="{{ route('category.show', 'video') }}"><i class="bi bi-play-btn me-2"></i> Videos</a>
        
        <div class="sidebar-heading">My Storage</div>
        <a href="{{ route('folders.index') }}"><i class="bi bi-folder2 me-2"></i> My Folders</a>
        <a href="{{ route('files.recent') }}"><i class="bi bi-clock-history me-2"></i> Recent Files</a>
        <a href="#"><i class="bi bi-people me-2"></i> Shared Folders</a>
        
        <div class="sidebar-heading">Account</div>
        <a href="{{ route('profile.edit') }}"><i class="bi bi-person-circle me-2"></i> My Account</a>
        <a href="{{ route('logs.index') }}"><i class="bi bi-list-check me-2"></i> Activity Logs</a>
        
        <div class="px-3 mt-5">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 btn-sm rounded-pill">
                    <i class="bi bi-power me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Top Navbar -->
    <nav class="navbar-custom d-flex align-items-center justify-content-between sticky-top">
        <form action="{{ route('search') }}" method="GET" class="search-container position-relative">
            <i class="bi bi-search"></i>
            <input type="text" name="query" class="form-control search-input" placeholder="Search files, folders...">
        </form>
        
        <div class="d-flex align-items-center">
            <span class="me-3 text-muted small">Welcome, <strong>{{ Auth::user()->name }}</strong></span>
            <div class="dropdown">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D6EFD&color=fff" 
                     class="rounded-circle shadow-sm" width="35" height="35" data-bs-toggle="dropdown" style="cursor:pointer">
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Success/Error Alerts -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger border-0 shadow-sm">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- HERE IS WHERE THE PAGE CONTENT LOADS -->
        @yield('content')
    </div>

    <!-- Modals (Global so you can use them on any page) -->
    @include('layouts.modals')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>