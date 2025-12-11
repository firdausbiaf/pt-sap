<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpark extends Model
{
    use HasFactory;

    protected $table = 'dparks';

    protected $fillable = [
        'cluster',
        'kavling',
        'status',
        'keterangan'
    ];
}
