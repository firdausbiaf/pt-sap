<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $primaryKey='id';

    protected $fillable = [
        'bukti',
        'user_id',
        'course_id',
        'verify',
        'progres'
    ];

    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

 
}
