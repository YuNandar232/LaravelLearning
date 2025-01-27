<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Summary of Student model
 */
class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'name',
        'major_id',
        'phone',
        'email',
        'address'
    ];

    /**
     * Relationship with major
     *
     * @return BelongsTo<Major, Student>
     */
    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }
}
