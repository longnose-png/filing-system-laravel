<div class="w-64 bg-white rounded-[32px] p-6 flex flex-col h-[calc(100vh-48px)] m-6 shadow-sm shrink-0">
    <!-- Logo -->
    <div class="flex items-center gap-3 mb-10 px-2 mt-2">
        <div class="bg-[#26282A] text-white p-2.5 rounded-xl">
            <i class="bi bi-folder-fill text-xl"></i>
        </div>
        <span class="text-xl font-bold tracking-tight">FileSys OIM</span>
    </div>

    <!-- Links -->
    <div class="flex-1 overflow-y-auto no-scrollbar -mx-2 px-2">
        <div class="space-y-1 mb-8">
            <a href="{{ route('dashboard') }}" class="w-full flex items-center justify-between px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-[#26282A] text-white shadow-md' : 'text-slate-500 hover:bg-slate-100 hover:text-[#26282A]' }}">
                <div class="flex items-center gap-3">
                    <i class="bi bi-speedometer2 text-lg {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400' }}"></i>
                    <span class="font-medium text-sm">Dashboard</span>
                </div>
            </a>
        </div>

        <div class="mb-8">
            <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-4">File Categories</div>
            <div class="space-y-1">
                <a href="{{ route('category.show', 'document') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 text-slate-500 hover:bg-slate-100 hover:text-[#26282A]">
                    <i class="bi bi-file-earmark-text text-lg text-slate-400"></i>
                    <span class="font-medium text-sm">Documents</span>
                </a>
                <a href="{{ route('category.show', 'image') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 text-slate-500 hover:bg-slate-100 hover:text-[#26282A]">
                    <i class="bi bi-image text-lg text-slate-400"></i>
                    <span class="font-medium text-sm">Images</span>
                </a>
                <a href="{{ route('category.show', 'video') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 text-slate-500 hover:bg-slate-100 hover:text-[#26282A]">
                    <i class="bi bi-play-btn text-lg text-slate-400"></i>
                    <span class="font-medium text-sm">Videos</span>
                </a>
            </div>
        </div>

        <div class="mb-8">
            <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-4">My Storage</div>
            <div class="space-y-1">
                <a href="{{ route('folders.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 text-slate-500 hover:bg-slate-100 hover:text-[#26282A]">
                    <i class="bi bi-folder2 text-lg text-slate-400"></i>
                    <span class="font-medium text-sm">My Folders</span>
                </a>
                <a href="{{ route('files.recent') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 text-slate-500 hover:bg-slate-100 hover:text-[#26282A]">
                    <i class="bi bi-clock-history text-lg text-slate-400"></i>
                    <span class="font-medium text-sm">Recent Files</span>
                </a>
                <a href="{{ route('folders.shared') }}" class="w-full flex items-center justify-between px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->routeIs('folders.shared') ? 'bg-[#26282A] text-white shadow-md' : 'text-slate-500 hover:bg-slate-100 hover:text-[#26282A]' }}">
                    <div class="flex items-center gap-3">
                        <i class="bi bi-share text-lg {{ request()->routeIs('folders.shared') ? 'text-white' : 'text-slate-400' }}"></i>
                        <span class="font-medium text-sm">Shared Folders</span>
                    </div>
                </a>
            </div>
        </div>

        <div class="mb-8">
            <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-4">Settings & Security</div>
            <div class="space-y-1">
                <a href="{{ route('profile.edit') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 text-slate-500 hover:bg-slate-100 hover:text-[#26282A]">
                    <i class="bi bi-person-gear text-lg text-slate-400"></i>
                    <span class="font-medium text-sm">My Account</span>
                </a>
                <a href="{{ route('friends.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 text-slate-500 hover:bg-slate-100 hover:text-[#26282A]">
                    <i class="bi bi-person-plus text-lg text-slate-400"></i>
                    <span class="font-medium text-sm">My Contacts</span>
                </a>
                
            </div>
        </div>

        <!-- History Section (Inside the scrollable area) -->
        <div class="mb-8">
            <div class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3 px-4">History</div>
            <div class="space-y-1">
                <a href="{{ route('logs.login') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->routeIs('logs.login') ? 'bg-[#26282A] text-white shadow-md' : 'text-slate-500 hover:bg-slate-100 hover:text-[#26282A]' }}">
                    <i class="bi bi-shield-check text-lg {{ request()->routeIs('logs.login') ? 'text-white' : 'text-slate-400' }}"></i>
                    <span class="font-medium text-sm">My Logs</span>
                </a>
                <a href="{{ route('logs.index') }}" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl transition-all duration-200 {{ request()->routeIs('logs.index') ? 'bg-[#26282A] text-white shadow-md' : 'text-slate-500 hover:bg-slate-100 hover:text-[#26282A]' }}">
                <i class="bi bi-activity text-lg"></i>
                <span class="font-medium text-sm">Account Activities</span>
                </a>
            </div>
        </div>
    </div> <!-- This closes the flex-1 overflow-y-auto div -->

    <!-- User Profile (Keep this at the very bottom) -->
    <div class="mt-auto pt-6 flex flex-col items-center justify-center text-center border-t border-slate-100">
        <!-- ... existing profile code ... -->
    </div>
    

    <!-- User Profile -->
    <div class="mt-auto pt-6 flex flex-col items-center justify-center text-center border-t border-slate-100">
        <div class="relative mb-3">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=f1f5f9&color=26282A" class="w-12 h-12 rounded-full border-2 border-white shadow-sm">
            <div class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-green-400 border-2 border-white rounded-full"></div>
        </div>
        <div class="font-bold text-sm text-[#26282A]">{{ Auth::user()->name ?? 'System User' }}</div>
        
        <form method="POST" action="{{ route('logout') }}" class="w-full mt-3">
            @csrf
            <button type="submit" class="w-full text-xs font-bold text-slate-400 hover:text-red-500 transition-colors py-2">
                Logout
            </button>
        </form>
    </div>
</div>