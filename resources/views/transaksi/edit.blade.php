<form id="editForm{{ $transaksi->id }}" method="POST" action="{{ route('transaksi.update', $transaksi->id) }}" enctype="multipart/form-data">
    <div class="modal fade" id="editModal{{ $transaksi->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Transaksi</h5>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit_id" value="{{ old('id', $transaksi->id) }}">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Transaksi</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" required value="{{ old('tanggal', $transaksi->tanggal) }}">
                    </div>
                    <div class="mb-3">
                        <label for="coa_id" class="form-label">Chart of Account (COA)</label>
                        <select name="coa_id" class="form-select" required>
                            <option value="">Pilih COA</option>
                            @foreach ($charts as $coa)
                                <option value="{{ $coa->id }}" {{ $transaksi->coa_id == $coa->id ? 'selected' : '' }}>
                                    {{ $coa->kode }} - {{ $coa->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="2" required>{{ old('deskripsi', $transaksi->deskripsi) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="debit" class="form-label">Debit</label>
                        <input class="form-control" type="number" name="debit" id="debit" value="{{ old('debit', $transaksi->debit) }}">
                    </div>
                    <div class="mb-3">
                        <label for="credit" class="form-label">Credit</label>
                        <input class="form-control" type="number" name="credit" id="credit" value="{{ old('credit', $transaksi->credit) }}">
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
