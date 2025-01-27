<?php

namespace App\Repositories;

/**
 * MajorRepositoryInterface
 */
interface MajorRepositoryInterface
{
    public function getAllMajors();

    public function createMajor(string $name);

    public function getMajorById(int $id);

    public function updateMajor(int $id, string $name);

    public function deleteMajor(int $id);
}
