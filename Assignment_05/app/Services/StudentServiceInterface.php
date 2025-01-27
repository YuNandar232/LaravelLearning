<?php

namespace App\Services;

/**
 * Summary of StudentServiceInterface
 */
interface StudentServiceInterface
{
    public function getAllStudents();

    public function createStudent(array $studentData);

    public function getStudentById(int $id);

    public function updateStudent(int $id, array $studentData);

    public function deleteStudent(int $id);
}
