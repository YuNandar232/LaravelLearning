<?php

namespace App\Services;
use App\Repositories\MajorRepositoryInterface;
use App\Services\MajorServiceInterface;
use Illuminate\Database\Eloquent\Collection;

/**
 * MajorService
 */
class MajorService implements MajorServiceInterface
{
    /**
     * @var MajorRepositoryInterface
     */
    private $majorRepository;

    /**
     * MajorService constructor.
     *
     * @param MajorRepositoryInterface $majorRepository
     */
    public function __construct(MajorRepositoryInterface $majorRepository)
    {
        $this->majorRepository = $majorRepository;
    }

    /**
     * Get all majors.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllMajors(): Collection
    {
        return $this->majorRepository->getAllMajors();
    }

    /**
     * Create a new major.
     * 
     * @param string $name
     * 
     * @return void
     */
    public function createMajor(string $name): void
    {
        $this->majorRepository->createMajor($name);
    }

    /**
     * GetMajorById
     *
     * @param integer $id
     * @return void
     */
    public function getMajorById(int $id)
    {
        return $this->majorRepository->getMajorById($id);
    }

    /**
     * UpdateMajor
     *
     * @param integer $id
     * @param string $name
     * @return void
     */
    public function updateMajor(int $id, string $name): void
    {
        $this->majorRepository->updateMajor($id, $name);
    }

    /**
     * Delete a major by ID.
     * 
     * @param int $id
     * 
     * @return void
     */
    public function deleteMajor(int $id): void
    {
        $this->majorRepository->deleteMajor($id);
    }
}