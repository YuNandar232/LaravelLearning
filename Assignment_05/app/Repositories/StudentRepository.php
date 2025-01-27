<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

/**
 * Summary of StudentRepository
 */
class StudentRepository implements StudentRepositoryInterface
{
    /**
     * Get All Students
     *
     * @return Collection<Student>
     */
    public function getAllStudents(): Collection
    {
        return Student::with('major')->orderBy('created_at', 'asc')->get();
    }

    /**
     * Create Student
     *
     * @param  array $studentData
     * @return TModel
     */
    public function createStudent(array $studentData): Student
    {
        $student = Student::create(
            [
                'name' => $studentData['name'],
                'major_id' => $studentData['major_id'],
                'phone' => $studentData['phone'],
                'email' => $studentData['email'],
                'address' => $studentData['address'],
            ]
        );
        return $student;
    }

    /**
     * Get Student By Id
     *
     * @param  int $id
     * @return TModel
     */
    public function getStudentById(int $id): Student
    {
        return Student::findOrFail($id);
    }

    /**
     * Update Student
     *
     * @param  int   $id
     * @param  array $studentData
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
     *
     * @param  int $id
     * @return void
     */
    public function deleteStudent(int $id): void
    {
        Student::findOrFail($id)->delete();
    }
}