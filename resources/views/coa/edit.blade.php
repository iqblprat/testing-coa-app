<form id="editForm{{ $item->id }}" method="POST" action="{{ route('chart-of-account.update', $item->id) }}" enctype="multipart/form-data">
    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Chart</h5>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Chart</label>
                        <input type="number" class="form-control" name="kode" id="kode" required value="{{ old('kode', $item->kode) }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Chart</label>
                        <input type="text" class="form-control" name="nama" id="nama" required value="{{ old('nama', $item->nama) }}">
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ $item->kategori_id == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama }}
                                </option>
                            @endforeach
                        </select>
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
