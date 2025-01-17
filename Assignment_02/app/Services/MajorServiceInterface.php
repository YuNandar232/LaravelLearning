<?php
namespace App\Services;

/**
 * MajorServiceInter
 */
interface MajorServiceInterface
{
    /**
     * GetAllMajors
     *
     * @return void
     */
    public function getAllMajors();

    /**
     * CreateMajor
     *
     * @param string $name
     * @return void
     */
    public function createMajor(string $name);

    /**
     * GetMajorById
     *
     * @param integer $id
     * @return void
     */
    public function getMajorById(int $id);

    /**
     * UpdateMajor
     *
     * @param integer $id
     * @param string $name
     * @return void
     */
    public function updateMajor(int $id, string $name);

    /**
     * DeleteMajor
     *
     * @param integer $id
     * @return void
     */
    public function deleteMajor(int $id);
}