<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $table = 'majors';

    // Allow mass assignment for the 'name' column
    protected $fillable = ['name'];

    /**
     * Get the students for the major.
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
