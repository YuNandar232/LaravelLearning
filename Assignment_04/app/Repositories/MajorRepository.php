<?php

namespace App\Repositories;

use App\Models\Major;
use Illuminate\Database\Eloquent\Collection;

/**
 * Major Repository
 */
class MajorRepository implements MajorRepositoryInterface
{
    /**
     * Get all majors.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllMajors(): Collection
    {
        return Major::orderBy('created_at', 'asc')->get();
    }

    /**
     * Create Major.
     *
     * @param string $name
     * @return void
     */
    public function createMajor(string $name): void
    {
        $major = new Major();
        $major->name = $name;
        $major->save();
    }

    /**
     * Get Major By Id
     *
     * @param integer $id
     * @return void
     */
    public function getMajorById(int $id)
    {
        return Major::findOrFail($id);
    }

    /**
     * Update Major
     *
     * @param integer $id
     * @param string $name
     * @return void
     */
    public function updateMajor(int $id, string $name): void
    {
        $major = Major::findOrFail($id);

        $major->name = $name;

        $major->save();
    }

    /**
     * Delete Major.
     * @param int $id
     * @return void
     */
    public function deleteMajor(int $id): void
    {
        Major::findOrFail($id)->delete();
    }
}
