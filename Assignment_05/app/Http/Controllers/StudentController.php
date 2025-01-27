<?php

namespace App\Http\Controllers;

use App\Services\StudentServiceInterface;
use App\Http\Requests\StudentRequest;
use App\Models\Major;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentCreatedMail;

/**
 * Student Controller
 */
class StudentController extends Controller
{
    /**
     * @var StudentServiceInterface
     */
    private $_studentService;

    /**
     * StudentController constructor.
     *
     * @param StudentServiceInterface $studentService
     */
    public function __construct(StudentServiceInterface $studentService)
    {
        $this->_studentService = $studentService;
    }

    /**
     * Display a listing of the students.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view(
            'Student.list',
            [
                'students' => $this->_studentService->getAllStudents(),
            ]
        );
    }

    /**
     * Show Student Create Form
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $majors = Major::all();

        return view('Student.create', compact('majors'));
    }

    /**
     * Store Student
     *
     * @param  \App\Http\Requests\StudentRequest $request
     * @return RedirectResponse
     */
    public function store(StudentRequest $request): RedirectResponse
    {
        $student = $this->_studentService->createStudent($request->all());

        Mail::to($student->email)->send(new StudentCreatedMail($student));

        return redirect()->route('student.index')
            ->with('success', 'Mail has been sent successfully!');
    }

    /**
     * Show student edit form
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $id): View
    {
        $student = $this->_studentService->getStudentById($id);

        $majors = Major::all();

        return view('Student.edit', compact('student', 'majors'));
    }

    /**
     * Update Student
     *
     * @param  \App\Http\Requests\StudentRequest $request
     * @param  int                               $id
     * @return RedirectResponse
     */
    public function update(StudentRequest $request, int $id): RedirectResponse
    {
        $this->_studentService->updateStudent($id, $request->all());

        return redirect()->route('student.index')
            ->with('success', 'Student updated successfully!');
    }

    /**
     * Destroy Student
     *
     * @param  int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->_studentService->deletestudent($id);

        return redirect()->route('student.index')
            ->with('success', 'Student deleted successfully!');
    }
}
