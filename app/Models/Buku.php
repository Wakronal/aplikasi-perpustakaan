<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;
    //
    protected $table = 'bukus';

    protected $fillable = [
        'judul',
        'author',
        'kategori',
        'stok',
    ];

    public function peminjamen(): HasMany
    {
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }
}
