<?php

namespace App\Services;

/**
 * Student Service Interface
 */
interface StudentServiceInterface
{
    public function getAllStudents();

    public function createStudent(array $studentData);

    public function getStudentById(int $id);

    public function updateStudent(int $id, array $studentData);

    public function deleteStudent(int $id);

    public function validateFile($file);

    public function validateHeaders($file);

    public function importStudents($file);
}
