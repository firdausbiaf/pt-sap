<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos';

    protected $fillable = [
        'data_id',
        'video'
    ];

    // Relasi: 1 video dimiliki 1 data
    public function data()
    {
        return $this->belongsTo(Data::class, 'data_id');
    }
}
