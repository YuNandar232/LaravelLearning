<?php

namespace App\Services;
use App\Repositories\MajorRepositoryInterface;
use App\Services\MajorServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use App\Imports\MajorsImport;

/**
 * Major Service
 */
class MajorService implements MajorServiceInterface
{
    /**
     * @var MajorRepositoryInterface
     */
    private $majorRepository;

    /**
     * Major Service constructor.
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
     * Get Major By Id
     *
     * @param integer $id
     * @return void
     */
    public function getMajorById(int $id)
    {
        return $this->majorRepository->getMajorById($id);
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

    /**
     * Validate the uploaded file (size, type, headers).
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function validateFile($file)
    {
        // Validate file type and size manually
        if (!in_array($file->getClientOriginalExtension(), ['xlsx', 'xls', 'csv'])) {
            throw ValidationException::withMessages(['file' => 'Invalid file type. Only XLSX, XLS, and CSV are allowed.']);
        }

        if ($file->getSize() > 10240 * 1024) {  // 10MB
            throw ValidationException::withMessages(['file' => 'File size exceeds the maximum allowed size of 10MB.']);
        }

        // Validate headers
        $wrongHeaders = $this->validateHeaders($file);

        if (!empty($wrongHeaders)) {
            throw ValidationException::withMessages(['file' => 'Invalid headers: ' . implode(', ', $wrongHeaders)]);
        }
    }

    /**
     * Validate the headers of the uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return array
     */
    public function validateHeaders($file)
    {
        $headingRowImport = new HeadingRowImport();
        $headings = $headingRowImport->toArray($file)[0][0]; // Get the first row (headers)

        $expectedHeaders = ['name'];  // Define the expected headers

        // Normalize headers for case-insensitive comparison
        $normalizedHeadings = array_map('strtolower', $headings);
        $normalizedExpectedHeaders = array_map('strtolower', $expectedHeaders);

        // Identify any mismatched headers
        $wrongHeaders = array_diff($normalizedHeadings, $normalizedExpectedHeaders);

        return $wrongHeaders;
    }

    /**
     * Import the data after validation.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function importMajors($file)
    {
        Excel::import(new MajorsImport(), $file);
    }
}