@extends('layouts.app')

@section('content')

<h2 class="mt-3"><i class="fa-solid fa-list"></i> <b>Data Kategori</b></h2>
<hr>

@if (session('success_store'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success_store') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('success_update'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('success_update') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('success_destroy'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('success_destroy') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('kategori-coa.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" value="{{ request('keyword') }}" placeholder="Cari berdasarkan nama Kategori">
                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <button class="btn btn-outline-success mb-3 float-end" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fa-solid fa-plus"></i> Tambah Kategori Baru
        </button>
    </div>
</div>

<table class="table table-hover">
    <thead>
        <th>No</th>
        <th>Nama</th>
        <th>Aksi</th>
    </thead>
    @forelse ($kategori as $item)
        <tr>
            <td width="5%">{{ $loop->iteration }}</td>
            <td width="75%">{{ $item->nama }} </td>
            <td width="20%">
                <button type="button" class="btn btn-outline-warning edit-btn"
                        data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"
                        data-id="{{ $item->id }}" data-nama="{{ $item->nama }}">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                </button>
                <form action="{{ route('kategori-coa.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn" onclick="return confirm('Apakah kamu yakin ingin menghapus item ini?')">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </form>
            </td>
            @include('kategori.edit')
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center">Tidak ada data Kategori ditemukan</td>
        </tr>
    @endforelse
</table>

<div class="mt-3 d-flex justify-content-end">
    {{ $kategori->links() }}
</div>

@include('kategori.create')

@endsection

@section('scripts')
<script>
    var editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var nama = button.getAttribute('data-nama');

            var form = document.getElementById('editForm');
            form.action = '/kategori-coa/' + id;

            var inputNama = document.getElementById('edit_nama');
            inputNama.value = nama;

            var inputId = document.getElementById('edit_id');
            inputId.value = id;
        });

    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');

            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_id').value = id;

            document.getElementById('editForm').action = `/kategori-coa/${id}`;
        });
    });
</script>
@endsection
