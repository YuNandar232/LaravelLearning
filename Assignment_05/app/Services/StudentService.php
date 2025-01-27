<?php

namespace App\Services;

use App\Repositories\StudentRepositoryInterface;
use App\Services\StudentServiceInterface;
use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;

/**
 * Summary of StudentService
 */
class StudentService implements StudentServiceInterface
{
    /**
     * @var StudentRepositoryInterface
     */
    private $_studentRepository;
    /**
     * StudentService constructor.
     *
     * @param StudentRepositoryInterface $studentRepository
     */
    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->_studentRepository = $studentRepository;
    }

    /**
     * Get all students.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStudents(): Collection
    {
        return $this->_studentRepository->getAllStudents();
    }

    /**
     * Create a new student
     *
     * @param  array $studentData
     * @return \App\Models\Student
     */
    public function createStudent(array $studentData): Student
    {
        return $this->_studentRepository->createStudent($studentData);
    }

    /**
     * Get Student By Id
     *
     * @param int $id
     */
    public function getStudentById(int $id)
    {
        return $this->_studentRepository->getStudentById($id);
    }

    /**
     * Update Student
     *
     * @param  int   $id
     * @param  array $studentData
     * @return void
     */
    public function updatestudent(int $id, array $studentData): void
    {
        $this->_studentRepository->updateStudent($id, $studentData);
    }

    /**
     * Delete Student
     *
     * @param  int $id
     * @return void
     */
    public function deleteStudent(int $id): void
    {
        $this->_studentRepository->deleteStudent($id);
    }
}
