<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

/**
 * Student Repository
 */
class StudentRepository implements StudentRepositoryInterface
{
    /**
     * Get all students.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStudents(): Collection
    {
        return Student::with('major')->orderBy('created_at', 'asc')->get();
    }

    /**
     * Create student
     *
     * @param  array $studentData
     * @return void
     */
    public function createStudent(array $studentData): void
    {
        Student::create(
            [
                'name' => $studentData['name'],
                'major_id' => $studentData['major_id'],
                'phone' => $studentData['phone'],
                'email' => $studentData['email'],
                'address' => $studentData['address'],
            ]
        );
    }

    /**
     * Get Student By Id
     *
     * @param  integer $id
     * @return void
     */
    public function getStudentById(int $id)
    {
        return Student::findOrFail($id);
    }

    /**
     * Update Student
     *
     * @param integer $id
     * @param array $studentData
     * @return void
     */
    public function updateStudent(int $id, array $studentData): void
    {
        $student = Student::findOrFail($id);

        $student->update(
            [
                'name' => $studentData['name'],
                'major_id' => $studentData['major_id'],
                'phone' => $studentData['phone'],
                'email' => $studentData['email'],
                'address' => $studentData['address'],
            ]
        );
    }

    /**
     * Delete Student.
     * @param int $id
     * @return void
     */
    public function deleteStudent(int $id): void
    {
        Student::findOrFail($id)->delete();
    }
}
