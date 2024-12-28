@extends('layouts.app')

@section('content')
<div class="container">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Daftar Peminjaman</h1>
    <a href="{{ route('peminjamen.create') }}" class="btn btn-primary">Tambah Peminjaman</a>
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
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($peminjamen as $peminjaman)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $peminjaman->anggota->nama_anggota }}</td>
                <td>{{ $peminjaman->buku->judul }}</td>
                <td>{{ $peminjaman->waktu_pinjam }}</td>
                <td>{{ $peminjaman->waktu_pengembalian }}</td>
                <td>
                @if ($peminjaman->status === 'peminjaman')
                    <span class="badge bg-warning">Dipinjam</span>
                @elseif ($peminjaman->status === 'pengembalian')
                    <span class="badge bg-success">Dikembalikan</span>
                @endif
                </td>
                <td>
                @if ($peminjaman->status === 'peminjaman')
                    <form action="{{ route('peminjamen.return', $peminjaman->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Kembalikan</button>
                    </form>
                @endif
                    <a href="{{ route('peminjamen.edit', $peminjaman->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('peminjamen.destroy', $peminjaman->id) }}" method="POST" style="display:inline;">
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
