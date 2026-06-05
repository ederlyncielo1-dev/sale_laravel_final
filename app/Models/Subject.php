<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_name',
        'subject_code',
    ];

    /**
     * Get all student grades assigned to this subject.
     */
    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }
}