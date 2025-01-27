<?php
namespace App\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Student Repository
 */
class StudentRepository implements StudentRepositoryInterface
{
    /**
     * Get all students.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStudents(): Collection
    {
        return Student::with('major')->orderBy('created_at', 'asc')->get();
    }
    
    /**
     * Search students based on ORM.
     *
     * @param string|null $searchQuery
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchStudents(?string $searchQuery): Collection
    {
        if (!$searchQuery) {
            return $this->getAllStudents();
        }
    
        $searchQuery = strtolower($searchQuery);

        $students = Student::with('major') 
            ->whereRaw('LOWER(name) LIKE ?', ['%' . $searchQuery . '%'])
            ->orWhereRaw('LOWER(email) LIKE ?', ['%' . $searchQuery . '%'])
            ->orWhereRaw('LOWER(phone) LIKE ?', ['%' . $searchQuery . '%'])
            ->orWhereRaw('LOWER(address) LIKE ?', ['%' . $searchQuery . '%'])
            ->orWhereHas('major', function ($query) use ($searchQuery) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . $searchQuery . '%']);
            })
        ->get();
    
        return $students;
    }   

    /**
     * Search students based on the Raw.
     *
     * @param string|null $searchQuery
     * @return \Illuminate\Database\Eloquent\Collection
     */
    /* public function searchStudents(?string $searchQuery): Collection
    {
        if (!$searchQuery) {
            return $this->getAllStudents();
        }
    
        $searchQuery = strtolower($searchQuery);
    
        // Raw SQL query to search students and majors 
        $resultsRaw = DB::select('
        SELECT students.*, majors.name as major_name
        FROM students
        LEFT JOIN majors ON students.major_id = majors.id
        WHERE LOWER(students.name) LIKE ? 
        OR LOWER(students.email) LIKE ?
        OR LOWER(students.phone) LIKE ?
        OR LOWER(students.address) LIKE ?
        OR LOWER(majors.name) LIKE ?',
            [
            '%' . $searchQuery . '%',
            '%' . $searchQuery . '%',
            '%' . $searchQuery . '%',
            '%' . $searchQuery . '%',
            '%' . $searchQuery . '%'
            ]
        );
    
        // Convert raw results into Eloquent models using 'hydrate'
        $students = Student::hydrate($resultsRaw);
    
         return $students; 
    }  */  

    /**
     * Create Student.
     * @param string $name
     * @return void
     */
    public function createStudent(array $student_data): void
    {
        // Create a new student record with all the necessary fields
        Student::create([
            'name' => $student_data['name'],
            'major_id' => $student_data['major_id'],
            'phone' => $student_data['phone'],
            'email' => $student_data['email'],
            'address' => $student_data['address'],
        ]);
    }

    /**
     * Get Student By Id
     *
     * @param integer $id
     * @return void
     */
    public function getStudentById(int $id)
    {
         return Student::findOrFail($id); // Find the major by ID, will throw an exception if not found
    }

    /**
     * Update Student
     *
     * @param integer $id
     * @param array $student_data
     * @return void
     */
    public function updateStudent(int $id, array $student_data): void
    {
         // Find the student by ID
         $student = Student::findOrFail($id);
        $student->update([
             'name' => $student_data['name'],
             'major_id' => $student_data['major_id'],
             'phone' => $student_data['phone'],
             'email' => $student_data['email'],
             'address' => $student_data['address'],
        ]);
    }

    /**
     * Delete Student.
     * @param int $id
     * @return void
     */
    public function deleteStudent(int $id): void
    {
        Student::findOrFail($id)->delete();
    }
}