@extends('layouts.app')

@section('content')
<div class="container mt-5">
        <h1 class="text-center">Selamat Datang di Dashboard</h1>
        <p class="text-center">Ini adalah panel utama aplikasi perpustakaan.</p>
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Buku</h5>
                        <p class="card-text">Jumlah total buku: {{ $totalBuku }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Anggota Terdaftar</h5>
                        <p class="card-text">Jumlah anggota: {{ $totalAnggota }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pinjaman Aktif</h5>
                        <p class="card-text">Jumlah pinjaman: {{ $peminjamanAktif }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection