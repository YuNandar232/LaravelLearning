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
     * @param  array $student_data
     * @return void
     */
    public function createStudent(array $student_data): void
    {
        Student::create(
            [
                'name' => $student_data['name'],
                'major_id' => $student_data['major_id'],
                'phone' => $student_data['phone'],
                'email' => $student_data['email'],
                'address' => $student_data['address'],
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
     * @param array $student_data
     * @return void
     */
    public function updateStudent(int $id, array $student_data): void
    {
        $student = Student::findOrFail($id);
        $student->update(
            [
                'name' => $student_data['name'],
                'major_id' => $student_data['major_id'],
                'phone' => $student_data['phone'],
                'email' => $student_data['email'],
                'address' => $student_data['address'],
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
