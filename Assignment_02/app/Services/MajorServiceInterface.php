<?php
namespace App\Services;

/**
 * Major Service Interface
 */
interface MajorServiceInterface
{
    public function getAllMajors();

    public function createMajor(string $name);

    public function getMajorById(int $id);

    public function updateMajor(int $id, string $name);

    public function deleteMajor(int $id);

    public function validateFile($file);

    public function validateHeaders($file);

    public function importMajors($file);
}