<?php

namespace App\Http\Controllers;
use App\Services\StudentServiceInterface;
use App\Http\Requests\StudentRequest;
use App\Models\Major;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * @var StudentServiceInterface
     */
     private $studentService;
    /**
     * StudentController constructor.
     *
     * @param StudentServiceInterface $studentService
     */
    public function __construct(StudentServiceInterface $studentService)
    {
        $this->studentService = $studentService;
    }
    /**
     * Display a listing of the students.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('Student.list', [
            'students' => $this->studentService->getAllStudents(),
        ]);
    }
    public function create(): View
    {
         // Fetch all majors to pass to the view
         $majors = Major::all(); // Assuming you have a Major model

         return view('Student.create', compact('majors')); 
    }
    /**
     * Store a newly created student in storage.
     *
     * @param \Illuminate\Http\Requests\StudentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StudentRequest $request): RedirectResponse
    {
        $this->studentService->createStudent($request->all());
        return redirect()->route('students.index');
    }
    public function edit($id): View
    {
        $student = $this->studentService->getStudentById($id); // Get the student by its ID
        $majors = Major::all(); // Fetch all majors for the dropdown
        return view('Student.edit', compact('student', 'majors'));
    }
    // Update the student
    public function update(StudentRequest $request, $id): RedirectResponse
    {
        $this->studentService->updateStudent($id, $request->all());
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified student from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->studentService->deletestudent($id);
        return redirect()->route('students.index');
    }
}
