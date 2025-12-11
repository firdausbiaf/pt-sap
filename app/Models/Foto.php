<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'fotos';

    protected $fillable = [
        'data_id',
        'photo',
        'komplain',
        'status_komplain'
    ];

    // Relasi ke model Data
    public function data()
    {
        return $this->belongsTo(Data::class, 'data_id');
    }
}
