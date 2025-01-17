<?php
namespace App\Services;

/**
 * StudentServiceInterface
 */
interface StudentServiceInterface
{
    /**
     * GetAllStudents
     *
     * @return void
     */
    public function getAllStudents();

    /**
     * Create Student
     *
     * @param array $student_data
     * @return void
     */
    public function createStudent(array $student_data);

    /**
     * GetStudentById
     *
     * @param integer $id
     * @return void
     */
    public function getStudentById(int $id);

    /**
     * Update Student
     *
     * @param integer $id
     * @param array $student_data
     * @return void
     */
    public function updateStudent(int $id, array $student_data);

    /**
     * Delete Student
     *
     * @param integer $id
     * @return void
     */
    public function deleteStudent(int $id);
}