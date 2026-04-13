<!-- New Folder Modal -->
<div x-data="{ open: false }" @open-folder-modal.window="open = true">
    <div x-show="open" style="display: none;" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div @click.away="open = false" class="bg-white rounded-[32px] w-full max-w-md shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-[#26282A]">New Folder</h3>
                <button @click="open = false" type="button" class="text-slate-400 hover:text-[#26282A] p-2 rounded-full hover:bg-slate-100">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <form action="{{ route('folders.store') }}" method="POST">
                @csrf
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Folder Name</label>
                        <input type="text" name="name" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#26282A] outline-none" placeholder="e.g. My Documents" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1.5">Password (Optional)</label>
                        <input type="password" name="password" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#26282A] outline-none" placeholder="Leave blank for public">
                    </div>
                </div>
                <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                    <button type="button" @click="open = false" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-[#26282A]">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium bg-[#26282A] text-white rounded-xl hover:bg-[#151617]">Create Folder</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload File Modal -->
<div x-data="{ open: false }" @open-upload-modal.window="open = true">
    <div x-show="open" style="display: none;" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div @click.away="open = false" class="bg-white rounded-[32px] w-full max-w-md shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-[#26282A]">Upload File</h3>
                <button @click="open = false" type="button" class="text-slate-400 hover:text-[#26282A] p-2 rounded-full hover:bg-slate-100">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="folder_id" id="modal_folder_id" value="">
                
                <div class="p-6">
                    <div class="border-2 border-dashed border-slate-200 rounded-2xl p-8 text-center bg-slate-50 hover:bg-slate-100 transition-colors relative">
                        <div class="bg-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                            <i class="bi bi-cloud-arrow-up text-xl text-slate-400"></i>
                        </div>
                        <p class="text-sm font-medium text-[#26282A] mb-1">Click to upload or drag and drop</p>
                        <p class="text-xs text-slate-500">Max file size: 10MB</p>
                        <input type="file" name="file" id="fileInput" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                    </div>
                </div>
                <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                    <button type="button" @click="open = false" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-[#26282A]">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium bg-[#26282A] text-white rounded-xl hover:bg-[#151617]">Start Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Share Folder Modal -->
<div x-data="{ open: false }" @open-share-modal.window="open = true">
    <div x-show="open" style="display: none;" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div @click.away="open = false" class="bg-white rounded-[32px] w-full max-w-md shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-lg font-bold text-[#26282A]">Share Folder: <span id="share_folder_display_name" class="text-blue-600"></span></h3>
                <button @click="open = false" type="button" class="text-slate-400 hover:text-[#26282A] p-2 rounded-full hover:bg-slate-100">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <form id="shareFolderForm" method="POST">
                @csrf
                <div class="p-6">
                    <label class="block text-sm font-bold text-slate-700 mb-1.5">Select a Contact</label>
                    <select name="friend_id" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-[#26282A] outline-none" required>
                        <option value="">-- Choose a friend --</option>
                        @if(auth()->check() && auth()->user()->friends)
                            @forelse(auth()->user()->friends as $friend)
                                <option value="{{ $friend->id }}">{{ $friend->name }} ({{ $friend->email }})</option>
                            @empty
                                <option value="" disabled>No contacts found. Go to 'My Contacts' to add friends first.</option>
                            @endforelse
                        @endif
                    </select>
                </div>
                <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3">
                    <button type="button" @click="open = false" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-[#26282A]">Cancel</button>
                    <button type="submit" class="px-5 py-2.5 text-sm font-medium bg-[#26282A] text-white rounded-xl hover:bg-[#151617]">Share Access</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div x-data="{ open: false, fileId: null, fileName: '' }" 
     @open-delete-modal.window="open = true; fileId = $event.detail.id; fileName = $event.detail.name">
    
    <div x-show="open" style="display: none;" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div @click.away="open = false" class="bg-white rounded-[32px] w-full max-w-sm shadow-xl overflow-hidden text-center p-8">
            
            <!-- Warning Icon -->
            <div class="mx-auto w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mb-6">
                <i class="bi bi-exclamation-triangle text-3xl text-red-500"></i>
            </div>
            
            <!-- Text Content -->
            <h3 class="text-xl font-bold text-[#26282A] mb-2">Delete File?</h3>
            <p class="text-slate-500 text-sm mb-8">
                Are you sure you want to delete <strong class="text-[#26282A]" x-text="fileName"></strong>? This action cannot be undone.
            </p>
            
            <!-- Dynamic Form -->
            <form :action="'/files/' + fileId" method="POST" class="flex gap-3">
                @csrf
                @method('DELETE')
                
                <button type="button" @click="open = false" class="flex-1 py-3 text-sm font-medium text-slate-600 bg-slate-50 hover:bg-slate-100 rounded-xl transition-colors">
                    Cancel
                </button>
                <button type="submit" class="flex-1 py-3 text-sm font-medium bg-red-500 text-white hover:bg-red-600 rounded-xl transition-colors shadow-sm">
                    Yes, Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openShareModal(id, name) {
        document.getElementById('shareFolderForm').action = '/folders/' + id + '/share';
        document.getElementById('share_folder_display_name').innerText = name;
        window.dispatchEvent(new CustomEvent('open-share-modal'));
    }
</script>