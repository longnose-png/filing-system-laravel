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