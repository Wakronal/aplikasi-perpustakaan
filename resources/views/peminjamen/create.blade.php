@extends('layouts.app')

@section('content')
<h1>Tambahkan peminjaman baru</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('peminjamen.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="anggota_id" class="form-label">Nama Anggota</label>
        <select name="anggota_id" class="form-control" required>
            <option value="">Pilih Anggota</option>
            @foreach ($anggotas as $anggota)
                <option value="{{ $anggota->id }}">{{ $anggota->nama_anggota }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="buku_id" class="form-label">Judul Buku</label>
        <select name="buku_id" class="form-control" required>
            <option value="">Pilih Buku</option>
            @foreach ($bukus as $buku)
                <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="waktu_pinjam" class="form-label">Tanggal Pinjam</label>
        <input type="date" name="waktu_pinjam" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="waktu_pengembalian" class="form-label">Tanggal Kembali</label>
        <input type="date" name="waktu_pengembalian" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('peminjamen.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
