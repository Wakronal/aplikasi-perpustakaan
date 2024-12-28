<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamen';

    protected $fillable = [
        'anggota_id',
        'buku_id',
        'waktu_pinjam',
        'waktu_pengembalian',
        'status',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public static function createPeminjaman($anggotaId, $bukuId)
    {
        // Pastikan anggota hanya bisa meminjam satu buku
        if (self::where('anggota_id', $anggotaId)->where('status', 'peminjaman')->exists()) {
            return ['berhasil' => false, 'message' => 'Anggota hanya dapat meminjam satu buku.'];
        }

        // Pastikan buku tersedia
        $buku = Buku::find($bukuId);
        if ($buku->stok < 1) {
            return ['berhasil' => false, 'message' => 'Stok buku tidak mencukupi.'];
        }

        // Kurangi stok buku
        $buku->decrement('stok');

        // Buat peminjaman
        self::create([
            'anggota_id' => $anggotaId,
            'buku_id' => $bukuId,
            'tanggal_pinjam' => now(),
            'tanggal_pengembalian' => now()->addDays(7), 
            'status' => 'peminjaman'
        ]);

        return ['berhasil' => true, 'message' => 'Buku berhasil dipinjam.'];
    }

}
