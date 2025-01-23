<?php

namespace App\Services;

use App\Imports\StudentsImport;
use App\Repositories\StudentRepositoryInterface;
use App\Services\StudentServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

/**
 * Student Service
 */
class StudentService implements StudentServiceInterface
{
    /**
     * @var StudentRepositoryInterface
     */
    private $_studentRepository;

    /**
     * StudentService constructor.
     *
     * @param StudentRepositoryInterface $studentRepository
     */
    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->_studentRepository = $studentRepository;
    }

    /**
     * Get all students.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStudents(): Collection
    {
        return $this->_studentRepository->getAllStudents();
    }

    /**
     * Create a new student.
     * @param array $studentData
     * @return void
     */
    public function createStudent(array $studentData): void
    {
        $this->_studentRepository->createStudent($studentData);
    }

    /**
     * Get Student By Id
     * @param int $id
     * @return mixed
     */
    public function getStudentById(int $id): mixed
    {
        return $this->_studentRepository->getStudentById($id);
    }

    /**
     * Update Student
     *
     * @param integer $id
     * @param array $studentData
     * @return void
     */
    public function updatestudent(int $id, array $studentData): void
    {
        $this->_studentRepository->updateStudent($id, $studentData);
    }

    /**
     * Delete a student by ID.
     *
     * @param int $id
     *
     * @return void
     */
    public function deleteStudent(int $id): void
    {
        $this->_studentRepository->deleteStudent($id);
    }

    /**
     * Validate the uploaded file (size, type, headers).
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return void
     */
    public function validateFile($file): void
    {
        if (!in_array($file->getClientOriginalExtension(), ['xlsx', 'xls', 'csv'])) {
            throw ValidationException::withMessages(
                [
                    'file' => 'Invalid file type.Only XLSX, XLS,and CSV are allowed.'
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

        $expectedHeaders = [
            'student',
            'major',
            'phone',
            'email',
            'address',
        ];

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
    public function importStudents($file): void
    {
        Excel::import(new StudentsImport(), $file);
    }
}
