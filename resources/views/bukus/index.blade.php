@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Buku</h1>
    <a href="{{ route('bukus.create') }}" class="btn btn-primary">Tambah Buku</a>
</div>

@if (session('berhasil'))
    <div class="alert alert-success">{{ session('berhasil') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No.</th>
            <th>Judul</th>
            <th>Author</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bukus as $buku)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $buku->judul }}</td>
            <td>{{ $buku->author }}</td>
            <td>{{ $buku->kategori }}</td>
            <td>{{ $buku->stok }}</td>
            <td>
                <a href="{{ route('bukus.edit', $buku->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin dihapus?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
