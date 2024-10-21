@php
    use Carbon\Carbon;
@endphp

<form id="detailForm{{ $transaksi->id }}" method="POST" action="" enctype="multipart/form-data">
    <div class="modal fade" id="detailModal{{ $transaksi->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Transaksi</h5>
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal Transaksi</label>
                        <span class="form-control">
                            {{ Carbon::parse($transaksi->tanggal)->translatedFormat('l, d F Y') }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="coa_id" class="form-label">Chart of Account (COA)</label>
                        <span class="form-control">{{ $transaksi->coa->kode }} - {{ $transaksi->coa->nama }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <span class="form-control">{{ $transaksi->deskripsi }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="debit" class="form-label">Debit</label>
                        <span class="form-control">Rp. {{ number_format($transaksi->debit, 2, ',', '.') }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="credit" class="form-label">Credit</label>
                        <span class="form-control">Rp. {{ number_format($transaksi->credit, 2, ',', '.') }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="created_at" class="form-label">Dibuat pada</label>
                        <span class="form-control">{{ $transaksi->created_at }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="updated_at" class="form-label">Terakhir diubah</label>
                        <span class="form-control">{{ $transaksi->updated_at }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="user" class="form-label">User yang Melakukan Transaksi</label>
                        <span class="form-control">{{ $transaksi->user->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
