<?php
namespace App\Services;
use App\Repositories\StudentRepositoryInterface;
use App\Services\StudentServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use App\Imports\StudentsImport;

/**
 * Student Service
 */
class StudentService implements StudentServiceInterface
{
    /**
     * @var StudentRepositoryInterface
     */
    private $studentRepository;

    /**
     * studentService constructor.
     *
     * @param StudentRepositoryInterface $studentRepository
     */
    public function __construct(StudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    /**
     * Get all students.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStudents(): Collection
    {
        return $this->studentRepository->getAllStudents();
    }

     /**
     * Search students data.
     *
     * @param string|null $searchQuery
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchStudents(?string $searchQuery): Collection
    {
        return $this->studentRepository->searchStudents($searchQuery);
    }
    
    /**
     * Create a new student.
     * 
     * @param string $name
     * 
     * @return void
     */
    public function createStudent(array $student_data): void
    {
        $this->studentRepository->createStudent($student_data);
    }

    /**
     * Get Student ById
     *
     * @param integer $id
     * @return void
     */
    public function getStudentById(int $id)
    {
        return $this->studentRepository->getStudentById($id);
    }

    /**
     * Update Student
     *
     * @param integer $id
     * @param array $student_data
     * @return void
     */
    public function updatestudent(int $id, array $student_data): void
    {
        $this->studentRepository->updateStudent($id, $student_data);
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
        $this->studentRepository->deleteStudent($id);
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

        $expectedHeaders = [
            'student',
            'major',
            'phone',
            'email',
            'address'
            ];

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
    public function importStudents($file)
    {
        Excel::import(new StudentsImport(), $file);
    }
}