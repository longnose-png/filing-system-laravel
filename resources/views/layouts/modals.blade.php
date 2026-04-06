<!-- New Folder Modal -->
<div class="modal fade" id="newFolderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('folders.store') }}" method="POST" class="modal-content border-0 shadow">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold">New Folder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Folder Name</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. My Documents" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Password (Optional)</label>
                    <input type="password" name="password" class="form-control" placeholder="Leave blank for public">
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="submit" class="btn btn-primary px-4">Create Folder</button>
            </div>
        </form>
    </div>
</div>

<!-- Upload File Modal -->
<div class="modal fade" id="uploadFileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('files.upload') }}" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Upload File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- HIDDEN INPUT: This is what saves the file into the folder -->
                <input type="hidden" name="folder_id" id="modal_folder_id" value="">

               

            <div class="modal-body">
                <div class="mb-3 text-center py-4 border border-dashed rounded bg-light">
                    <input type="file" name="file" class="form-control mb-2" id="fileInput" required>
                    <p class="text-muted small mb-0">Max file size: 10MB</p>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="submit" class="btn btn-primary px-4">Start Upload</button>
            </div>
        </form>
    </div>
</div>

//Share to friend modal

<!-- Share Folder Modal -->
<div class="modal fade" id="shareFolderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="shareFolderForm" method="POST" class="modal-content border-0 shadow">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Share Folder: <span id="share_folder_display_name" class="text-primary"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Select a Contact</label>
                    <select name="friend_id" class="form-select" required>
                        <option value="">-- Choose a friend --</option>
                        @forelse(auth()->user()->friends as $friend)
                            <option value="{{ $friend->id }}">{{ $friend->name }} ({{ $friend->email }})</option>
                        @empty
                            <option value="" disabled>No contacts found. Go to 'My Contacts' to add friends first.</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary px-4">Share Access</button>
            </div>
        </form>
    </div>
</div>

<!-- THIS SCRIPT MUST BE INSIDE THE MODALS FILE OR MASTER LAYOUT -->
<script>
    function openShareModal(id, name) {
        // 1. Update the Form Action URL
        document.getElementById('shareFolderForm').action = '/folders/' + id + '/share';
        
        // 2. Update the Display Name in the modal header
        document.getElementById('share_folder_display_name').innerText = name;
    }
</script>