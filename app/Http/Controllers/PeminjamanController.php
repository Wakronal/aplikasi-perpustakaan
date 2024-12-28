<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $peminjamen = Peminjaman::when($query, function ($q) use ($query) {
            $q->whereHas('anggotas', function ($queryAnggota) use ($query) {
                $queryAnggota->where('nama_anggota', 'like', "%{$query}%");
            })->orWhereHas('bukus', function ($queryBuku) use ($query) {
                $queryBuku->where('judul', 'like', "%{$query}%");
            })->orWhere('status', 'like', "%{$query}%");
        })->paginate(10);
        return view('peminjamen.index', compact('peminjamen', 'query'));
    }

    public function create()
    {
        $anggotas = Anggota::all();
        $bukus = Buku::all();
        return view('peminjamen.create', compact('anggotas', 'bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'buku_id' => 'required|exists:bukus,id',
            'waktu_pinjam' => 'required|date',
        ]);

        // Cek stok buku
        $buku = Buku::findOrFail($request->buku_id);
        if ($buku->stok <= 0) {
            return redirect()->back()->with('error', 'Stok buku tidak tersedia!');
        }

        $buku->stok -= 1;
        $buku->save();
        Peminjaman::create($request->all());

        return redirect()->route('peminjamen.index')->with('berhasil', 'Peminjaman berhasil ditambahkan!!');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->findOrFail($id);
        return view('peminjamen.show', compact('peminjaman'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $anggotas = Anggota::all();
        $bukus = Buku::all();
        return view('peminjamen.edit', compact('peminjaman', 'anggotas', 'bukus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'buku_id' => 'required|exists:bukus,id',
            'waktu_pinjam' => 'required|date',
            'waktu_pengembalian' => 'nullable|date',
            'status' => 'required|in:peminjaman,pengembalian,terlambat',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'anggota_id' => $request->anggota_id,
            'buku_id' => $request->buku_id,
            'waktu_pinjam' => $request->waktu_pinjam,
            'waktu_pengembalian' => $request->waktu_pengembalian,
            'status' => $request->status,
        ]);

        return redirect()->route('peminjamen.index')->with('berhasil', 'peminjaman berhasil diupdate');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjamen.index')->with('berhasil', 'Peminjaman berhasil dihapus');
    }

    public function returnBook($id)
    {
        $peminjaman = Peminjaman::find($id);

        if ($peminjaman && $peminjaman->status === 'peminjaman') {
            // Tambahkan stok buku
            $buku = Buku::find($peminjaman->buku_id);
            $buku->increment('stok');

            // Ubah status peminjaman
            $peminjaman->update(['status' => 'pengembalian']);

            return redirect()->back()->with('berhasil', 'Buku berhasil dikembalikan.');
        }

        return redirect()->back()->with('error', 'Peminjaman tidak valid.');
    }
}
