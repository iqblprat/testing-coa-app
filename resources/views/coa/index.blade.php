@extends('layouts.app')

@section('content')

<h2 class="mt-3"><i class="fa-solid fa-chart-pie"></i> <b>Data Chart of Account (COA)</b></h2>
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
        <form action="{{ route('chart-of-account.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" value="{{ request('keyword') }}" placeholder="Cari berdasarkan nama Chart">
                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <button class="btn btn-outline-success mb-3 float-end" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fa-solid fa-plus"></i> Tambah Chart Baru
        </button>
    </div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($coa as $item)
            <tr>
                <td width="5%">{{ $loop->iteration }}</td>
                <td width="5%">{{ $item->kode }}</td>
                <td width="50%">{{ $item->nama }}</td>
                <td width="25%">{{ $item->kategori->nama ?? 'N/A' }}</td>
                <td width="15%">
                    <button type="button" class="btn btn-outline-warning edit-btn"
                            data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}"
                            data-id="{{ $item->id }}" data-nama="{{ $item->nama }}">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                    <form action="{{ route('chart-of-account.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn" onclick="return confirm('Apakah kamu yakin ingin menghapus item ini?')">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
                @include('coa.edit')
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data COA ditemukan</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3 d-flex justify-content-end">
    {{ $coa->links() }}
</div>

@include('coa.create')

@endsection
