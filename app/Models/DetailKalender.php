<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailKalender extends Model
{
    use HasFactory;

    protected $table = 'detail_kalenders';

    protected $fillable = [
        'data_id',
        'durasi_proyek_id',
        'tanggal',
        'kategori_kerja_id',
        'pic_nama',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi ke proyek
     */
    public function proyek(): BelongsTo
    {
        return $this->belongsTo(Data::class, 'data_id');
    }

    /**
     * Relasi ke header (durasi proyek)
     */
    public function header(): BelongsTo
    {
        return $this->belongsTo(
            DurasiProyek::class,
            'durasi_proyek_id'
        );
    }

    /**
     * Relasi ke klasifikasi pekerjaan
     */
    public function classification(): BelongsTo
    {
        return $this->belongsTo(
            KategoriKerja::class,
            'kategori_kerja_id'
        );
    }
}
