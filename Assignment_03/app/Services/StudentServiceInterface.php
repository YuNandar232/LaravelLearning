<?php
namespace App\Services;

/**
 * Student Service Interface
 */
interface StudentServiceInterface
{
    public function searchStudents(?string $searchQuery);

    public function createStudent(array $student_data);

    public function getStudentById(int $id);

    public function updateStudent(int $id, array $student_data);

    public function deleteStudent(int $id);

    public function validateFile($file);

    public function validateHeaders($file);
    
    public function importStudents($file);
}