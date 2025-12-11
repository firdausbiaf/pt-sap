<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugass';
    protected $primaryKey='id';

    protected $fillable = [
        'pdf',
        'materi_id',
        'user_id',
        'nilai'
    ];

    public function materi(){
        return $this->belongsTo(Materi::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
