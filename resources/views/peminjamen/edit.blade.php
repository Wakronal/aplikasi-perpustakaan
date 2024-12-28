@extends('layouts.app')

@section('content')
<h1>Edit Peminjaman</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('peminjamen.update', $peminjaman->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="anggota_id" class="form-label">Nama Anggota</label>
        <select name="anggota_id" class="form-control" required>
            <option value="">Pilih Anggota</option>
            @foreach ($anggotas as $anggota)
                <option value="{{ $anggota->id }}" 
                    {{ $peminjaman->anggota_id == $anggota->id ? 'selected' : '' }}>
                    {{ $anggota->nama_anggota }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="buku_id" class="form-label">Judul Buku</label>
        <select name="buku_id" class="form-control" required>
            <option value="">Pilih Buku</option>
            @foreach ($bukus as $buku)
                <option value="{{ $buku->id }}" 
                    {{ $peminjaman->buku_id == $buku->id ? 'selected' : '' }}>
                    {{ $buku->judul }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="waktu_pinjam" class="form-label">Tanggal Pinjam</label>
        <input type="date" name="waktu_pinjam" class="form-control" value="{{ $peminjaman->waktu_pinjam }}" required>
    </div>

    <div class="mb-3">
        <label for="waktu_pengembalian" class="form-label">Tanggal Kembali</label>
        <input type="date" name="waktu_pengembalian" class="form-control" value="{{ $peminjaman->waktu_pengembalian }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
