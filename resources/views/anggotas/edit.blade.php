@extends('layouts.app')

@section('content')
<h1>Edit Anggota</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('anggotas.update', $anggota->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nama_anggota" class="form-label">Nama Anggota</label>
        <input type="text" name="nama_anggota" id="nama_anggota" class="form-control" value="{{ $anggota->nama_anggota }}">
    </div>
    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <input type="text" name="alamat" id="alamat" class="form-control" value="{{ $anggota->alamat }}">
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label">Telepon</label>
        <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ $anggota->no_hp }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
