<?php

namespace App\Services;

use App\Repositories\MajorRepositoryInterface;
use App\Services\MajorServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * Summary of MajorService
 */
class MajorService implements MajorServiceInterface
{
    /**
     * @var MajorRepositoryInterface
     */
    private $_majorRepository;

    /**
     * MajorService constructor.
     *
     * @param \App\Repositories\MajorRepositoryInterface $majorRepository
     */
    public function __construct(MajorRepositoryInterface $majorRepository)
    {
        $this->_majorRepository = $majorRepository;
    }

    /**
     * Get all majors.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllMajors(): Collection
    {
        return $this->_majorRepository->getAllMajors();
    }

    /**
     * Create Major
     *
     * @param  string $name
     * @return void
     */
    public function createMajor(string $name): void
    {
        $this->_majorRepository->createMajor($name);
    }

    /**
     * Get Major By Id
     *
     * @param int $id
     */
    public function getMajorById(int $id)
    {
        return $this->_majorRepository->getMajorById($id);
    }

    /**
     * Update Major
     *
     * @param  int    $id
     * @param  string $name
     * @return void
     */
    public function updateMajor(int $id, string $name): void
    {
        $this->_majorRepository->updateMajor($id, $name);
    }

    /**
     * Delete a major by ID
     *
     * @param  int $id
     * @return void
     */
    public function deleteMajor(int $id): void
    {
        $this->_majorRepository->deleteMajor($id);
    }
}
