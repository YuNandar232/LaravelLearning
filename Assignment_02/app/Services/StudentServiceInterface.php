<?php
namespace App\Services;
interface StudentServiceInterface
{
    public function getAllStudents();
    public function createStudent(array $student_data);
    public function getStudentById(int $id);
    public function updateStudent(int $id, array $student_data);
    public function deleteStudent(int $id);
}