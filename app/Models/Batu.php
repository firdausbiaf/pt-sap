<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batu extends Model
{
    use HasFactory;
    protected $table = 'batus';

    protected $fillable = [
        'cluster',
        'kavling',
        'status',
        'keterangan',
    ];
}
