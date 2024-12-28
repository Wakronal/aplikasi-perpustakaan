<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;
    //
    protected $table = 'anggotas';

    protected $fillable = [
        'nama_anggota',
        'alamat',
        'no_hp',
    ];

    public function peminjamen(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'anggota_id');
    }
}
