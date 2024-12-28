<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Perpustakaan</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">Aplikasi Perpustakaan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('bukus.index') }}">Buku</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('anggotas.index') }}">Anggota</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('peminjamen.index') }}">Peminjaman</a></li>
                    <li>
                        <form action="{{ url()->current() }}" method="GET">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </form>
                    </li>
                    <li>
                    @if (Auth::check())
                    <form action="{{ route('logout') }}" method="post" class="px-3">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                    @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="container mt-4">
            <div class="content-container">
                @if (Auth::check())
                    <div class="text-center">
                        <p>Anda Login Sebagai: <strong>{{ Auth::user()->name }}</strong></p>
                    </div>
                @endif
                @yield('content')
            </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
