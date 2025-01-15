<?php
namespace App\Services;
use App\Repositories\StudentRepositoryInterface;
use App\Services\StudentServiceInterface;
use Illuminate\Database\Eloquent\Collection;
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
    public function getStudentById(int $id)
    {
        return $this->studentRepository->getStudentById($id);
    }
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
}