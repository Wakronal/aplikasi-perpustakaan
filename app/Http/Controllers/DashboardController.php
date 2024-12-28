<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalAnggota = Anggota::count();
        $peminjamanAktif = Peminjaman::where('status', '!=', 'pengembalian')->count();

        return view('dashboard', compact('totalBuku', 'totalAnggota', 'peminjamanAktif'));
    }
}
