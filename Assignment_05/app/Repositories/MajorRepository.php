<?php
namespace App\Repositories;
use App\Models\Major;
use Illuminate\Database\Eloquent\Collection;
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
     * @param string $name
     * @return void
     */
    public function createMajor(string $name): void
    {
        $major = new Major();
        $major->name = $name;
        $major->save();
    }
    public function getMajorById(int $id)
    {
         return Major::findOrFail($id); // Find the major by ID, will throw an exception if not found
    }

    public function updateMajor(int $id, string $name): void
    {
         // Find the major by ID
         $major = Major::findOrFail($id);
         // Update the name
         $major->name = $name;
         // Save the changes to the database
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