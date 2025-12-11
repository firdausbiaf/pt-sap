<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legalitas extends Model
{
    use HasFactory;

    protected $table = 'legalitas';

    protected $fillable = [
        'data_id',
        'nomor',
        'tgl_masuk',
        'tgl_keluar',
        'masuk',
        'keluar',
        'keterangan',
    ];

    // Relasi ke model Data
    public function data()
    {
        return $this->belongsTo(Data::class, 'data_id');
    }
}
