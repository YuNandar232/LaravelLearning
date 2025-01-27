<?php

namespace App\Repositories;

/**
 * Summary of StudentRepositoryInterface
 */
interface StudentRepositoryInterface
{
    public function getAllStudents();

    public function createStudent(array $studentData);

    public function getStudentById(int $id);

    public function updateStudent(int $id, array $studentData);

    public function deleteStudent(int $id);
}
