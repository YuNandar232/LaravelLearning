<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of Major modal
 */
class Major extends Model
{
    protected $table = 'majors';

    protected $fillable = ['name'];

    /**
     * Relationship with student
     *
     * @return HasMany<Student, Major>
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
