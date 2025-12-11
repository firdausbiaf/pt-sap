<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $primaryKey='id';

    protected $fillable = [
        'title',
        'deskripsi',
        'category_id',
        'user_id',
        'requirment',
        'outcome',
        'harga',
        'photo'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function materi(){
        return $this->hasMany(Materi::class);
    }

    public function transaksi(){
        return $this->hasMany(Transaksi::class);
    }
}
