<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'q1',
        'q2',
        'q3',
        'q4',
    ];

    /**
     * Link back to the Student (User).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Link back to the Subject.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Dynamically compute final grade based on populated quarters.
     * Accessible via: $grade->final_grade
     */
    public function getFinalGradeAttribute(): ?float
    {
        // Filter out quarters that haven't been graded yet (null values)
        $populatedQuarters = array_filter([$this->q1, $this->q2, $this->q3, $this->q4], function ($value) {
            return !is_null($value);
        });

        if (count($populatedQuarters) === 0) {
            return null;
        }

        // Calculate average of the active quarters
        return round(array_sum($populatedQuarters) / count($populatedQuarters), 2);
    }

    /**
     * Dynamically determine passing status based on final grade.
     * Accessible via: $grade->status
     */
    public function getStatusAttribute(): string
    {
        $final = $this->final_grade;

        if (is_null($final)) {
            return 'Pending';
        }

        // Standard passing mark: 75.00
        return $final >= 75 ? 'Passed' : 'Failed';
    }
}