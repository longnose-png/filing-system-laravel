<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileSys OIM - @yield('title', 'Management System')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Alpine.js (Required for Modals) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Hide scrollbar for clean UI */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#b5c0c8] font-sans text-[#26282A] overflow-hidden">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        @include('layouts.navigation')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden py-6 pr-6 gap-6">
            
            <!-- Top Navigation -->
            <div class="h-20 bg-white rounded-[32px] px-6 flex items-center justify-between shadow-sm shrink-0">
                <form action="{{ route('search') }}" method="GET" class="flex-1 max-w-xl relative">
                    <i class="bi bi-search text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <input type="text" name="query" value="{{ request('query') }}" placeholder="Search files or folders..." class="w-full bg-slate-50 border-none rounded-full py-3 pl-12 pr-4 text-sm focus:ring-2 focus:ring-[#26282A] outline-none transition-all">
                </form>
                
                <div class="flex items-center gap-6 ml-6">
                    <div class="text-sm font-medium text-slate-500 hidden md:block">
                        {{ now()->format('l, jS F') }}
                    </div>
                    
                    
                </div>
            </div>

            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto no-scrollbar flex flex-col gap-6 pt-1 pb-6">
                
                <!-- Status Messages -->
                @if(session('success'))
                    <div class="bg-green-50 text-green-700 p-4 rounded-2xl flex items-center gap-3 shadow-sm">
                        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 text-red-700 p-4 rounded-2xl shadow-sm">
                        <ul class="mb-0 list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Modals -->
    @include('layouts.modals')

</body>
</html>