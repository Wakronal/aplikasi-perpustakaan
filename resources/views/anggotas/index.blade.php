@extends('layouts.app')

@section('content')
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Anggota</h1>
    <a href="{{ route('anggotas.create') }}" class="btn btn-primary">Tambah Anggota</a>
</div>

    @if (session('berhasil'))
        <div class="alert alert-success">
            {{ session('berhasil') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Anggota</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggotas as $anggota)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $anggota->nama_anggota }}</td>
                <td>{{ $anggota->alamat }}</td>
                <td>{{ $anggota->no_hp }}</td>
                <td>
                    <a href="{{ route('anggotas.edit', $anggota->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('anggotas.destroy', $anggota->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
