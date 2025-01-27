<?php

namespace App\Repositories;

/**
 * Summary of MajorRepositoryInterface
 */
interface MajorRepositoryInterface
{
    public function getAllMajors();

    public function createMajor(string $name);

    public function getMajorById(int $id);

    public function updateMajor(int $id, string $name);

    public function deleteMajor(int $id);
}
