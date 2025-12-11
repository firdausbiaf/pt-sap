<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Singhasari extends Model
{
    use HasFactory;
    protected $table = 'singhasaris';

    protected $fillable = [
        'kluster',
        'kavling',
        'status',
        'keterangan',
    ];
}
