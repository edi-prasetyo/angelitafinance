<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalCenter">
    Delete
</button>

<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Hapus Paket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <a href="{{url('admin/packages/delete/' .$item->id)}}" class="btn btn-danger">Ya Hapus..!</a>
            </div>
        </div>
    </div>
</div>