<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriKerja extends Model
{
    use HasFactory;

    protected $table = 'kategori_kerjas';

    protected $fillable = [
        'nama',
        'warna',
    ];

    /**
     * Banyak tanggal kalender memakai satu klasifikasi
     */
    public function detailKalender(): HasMany
    {
        return $this->hasMany(
            DetailKalender::class,
            'kategori_kerja_id'
        );
    }
}
