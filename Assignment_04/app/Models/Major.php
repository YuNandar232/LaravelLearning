<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Major Model
 */
class Major extends Model
{
    protected $table = 'majors';

    protected $fillable = ['name'];

    /**
     * Students
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
