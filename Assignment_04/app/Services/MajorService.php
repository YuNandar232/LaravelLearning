<?php

namespace App\Services;

use App\Imports\MajorsImport;
use App\Repositories\MajorRepositoryInterface;
use App\Services\MajorServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

/**
 * Major Service
 */
class MajorService implements MajorServiceInterface
{
    /**
     * @var MajorRepositoryInterface
     */
    private $_majorRepository;

    /**
     * Major Service constructor.
     *
     * @param MajorRepositoryInterface $majorRepository
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
     * Create a new major.
     *
     * @param string $name
     *
     * @return void
     */
    public function createMajor(string $name): void
    {
        $this->_majorRepository->createMajor($name);
    }

    /**
     * Get Major By Id
     * @param int $id
     * @return mixed
     */
    public function getMajorById(int $id): mixed
    {
        return $this->_majorRepository->getMajorById($id);
    }

    /**
     * Update Major
     *
     * @param integer $id
     * @param string $name
     * @return void
     */
    public function updateMajor(int $id, string $name): void
    {
        $this->_majorRepository->updateMajor($id, $name);
    }

    /**
     * Delete a major by ID.
     * @param int $id
     * @return void
     */
    public function deleteMajor(int $id): void
    {
        $this->_majorRepository->deleteMajor($id);
    }

    /**
     * Validate the uploaded file (size, type, headers).
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function validateFile($file)
    {
        if (!in_array($file->getClientOriginalExtension(), ['xlsx', 'xls', 'csv'])) {
            throw ValidationException::withMessages(
                [
                    'file' => 'Invalid file type. Only XLSX, XLS, and CSV are allowed.'
                ]
            );
        }

        if ($file->getSize() > 10 * 1024 * 1024) {
            throw ValidationException::withMessages(
                [
                    'file' => 'File size exceeds the maximum allowed size of 10MB.'
                ]
            );
        }

        $wrongHeaders = $this->validateHeaders($file);

        if (!empty($wrongHeaders)) {
            throw ValidationException::withMessages(
                [
                    'file' => 'Invalid headers: ' . implode(', ', $wrongHeaders)
                ]
            );
        }
    }

    /**
     * Validate the headers of the uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return array
     */
    public function validateHeaders($file): array
    {
        $headingRowImport = new HeadingRowImport();
        $headings = $headingRowImport->toArray($file)[0][0];

        $expectedHeaders = ['name'];

        $normalizedHeadings = array_map('strtolower', $headings);
        $normalizedExpectedHeaders = array_map('strtolower', $expectedHeaders);

        $wrongHeaders = array_diff($normalizedHeadings, $normalizedExpectedHeaders);

        return $wrongHeaders;
    }

    /**
     * Import the data after validation.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function importMajors($file): void
    {
        Excel::import(new MajorsImport(), $file);
    }
}
