<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Student model
 */
class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'name',
        'major_id',
        'phone',
        'email',
        'address',
    ];

    /**
     *  Get the major that the student belongs to.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
