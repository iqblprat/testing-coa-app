@extends('layouts.app')

@section('content')

<h2 class="mt-3"><i class="fa-solid fa-exchange-alt"></i> <b>Data Transaksi</b></h2>
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
        <form action="{{ route('transaksi.index') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control" value="{{ request('keyword') }}" placeholder="Cari berdasarkan Deskripsi">
                <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <button class="btn btn-outline-success mb-3 float-end" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fa-solid fa-plus"></i> Tambah Transaksi Baru
        </button>
    </div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>COA Kode</th>
            <th>COA Nama</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($transaksis as $transaksi)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $transaksi->tanggal }}</td>
                <td>{{ $transaksi->coa->kode }}</td>
                <td>{{ $transaksi->coa->nama }}</td>
                <td>{{ $transaksi->deskripsi }}</td>
                <td width="20%">
                    <button type="button" class="btn btn-outline-info edit"
                        data-bs-toggle="modal" data-bs-target="#detailModal{{ $transaksi->id }}"
                        data-id="{{ $transaksi->id }}">
                    <i class="fa-solid fa-info-circle"></i> Detail
                    </button>
                    <button type="button" class="btn btn-outline-warning edit-btn"
                        data-bs-toggle="modal" data-bs-target="#editModal{{ $transaksi->id }}"
                        data-id="{{ $transaksi->id }}">
                    <i class="fa-solid fa-pen-to-square"></i> Edit
                    </button>
                    <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn" onclick="return confirm('Apakah kamu yakin ingin menghapus item ini?')">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
                @include('transaksi.edit')
                @include('transaksi.detail')
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data Transaksi ditemukan</td>
            </tr>
        @endforelse
    </tbody>
</table>

@include('transaksi.create')

@endsection
