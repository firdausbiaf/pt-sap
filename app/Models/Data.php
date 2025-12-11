<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $table = 'data';

    protected $fillable = [
        'user_id',
        'kavling',
        'lokasi',
        'kluster',
        'tipe',
        'spk',
        'ptb',
        'harga_deal',
        'progres',
        'sales',
        'ktp',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
