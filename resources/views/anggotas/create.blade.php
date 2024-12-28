@extends('layouts.app')

@section('content')
<h1>Tambahkan anggota baru</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('anggotas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nama_anggota" class="form-label">Nama Anggota</label>
        <input type="text" name="nama_anggota" id="nama_anggota" class="form-control" value="{{ old('nama_anggota') }}">
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat') }}">
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label">Telepon</label>
        <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp') }}">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="{{ route('anggotas.index') }}" class="btn btn-secondary">Kembali</a>
</form>
@endsection
