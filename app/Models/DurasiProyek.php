<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DurasiProyek extends Model
{
    use HasFactory;

    protected $table = 'durasi_proyeks';

    protected $fillable = [
        'data_id',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    /**
     * Header ini milik satu proyek
     */
    public function proyek(): BelongsTo
    {
        return $this->belongsTo(Data::class, 'data_id');
    }

    /**
     * Detail kalender (aktivitas per tanggal)
     */
    public function detailKalenders(): HasMany
    {
        return $this->hasMany(
            DetailKalender::class,
            'durasi_proyek_id'
        );
    }
}
