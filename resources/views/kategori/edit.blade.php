<form id="editForm{{ $item->id }}" method="POST" action="{{ route('kategori-coa.update', $item->id) }}" enctype="multipart/form-data">
    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama" id="edit_nama" required value="{{ old('nama', $item->nama) }}">
                    </div>
                    <input type="hidden" name="id" id="edit_id" value="{{ old('id', $item->id) }}">
                    <div class="mb-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
