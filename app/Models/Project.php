<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * Field yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'name',
        'location',
        'project_value',
        'start_date',
        'end_date',
        'use_subcon',
        'status',
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'start_date'    => 'date',
        'end_date'      => 'date',
        'use_subcon'    => 'boolean',
        'project_value' => 'decimal:2',
    ];

    /* =======================
     |  STATUS CONSTANTS
     ======================= */
    public const STATUS_PLANNING   = 'planning';
    public const STATUS_ONGOING    = 'ongoing';
    public const STATUS_FINISHED   = 'finished';

    public const STATUSES = [
        self::STATUS_PLANNING,
        self::STATUS_ONGOING,
        self::STATUS_FINISHED,
    ];

    /* =======================
     |  RELATIONS
     ======================= */

    /**
     * Users related to this project (owner / contractor)
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users')
                    ->withPivot('type')
                    ->withTimestamps();
    }

    /**
     * Project owners
     */
    public function owners()
    {
        return $this->users()->wherePivot('type', 'owner');
    }

     /**
     * Kontraktor proyek (user role = member)
     */
    public function contractors()
    {
        return $this->users()->wherePivot('type', 'contractor');
    }

    /* =======================
     |  ACCESSORS
     ======================= */

    public function getStatusLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }

    /**
     * Project duration in days
     */
    public function getDurationDaysAttribute(): int
    {
        if (!$this->start_date || !$this->end_date) {
            return 0;
        }

        return $this->start_date->diffInDays($this->end_date) + 1;
    }
}
