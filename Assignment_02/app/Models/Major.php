<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Major Model
 */
class Major extends Model
{
    protected $table = 'majors';

    // Allow mass assignment for the 'name' column
    protected $fillable = ['name'];

    /**
     * Students
     *
     * @return void
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
