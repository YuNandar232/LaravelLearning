<?php

namespace App\Http\Controllers;
use App\Services\StudentServiceInterface;
use App\Http\Requests\StudentRequest;
use App\Models\Major;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\HeadingRowImport;

/**
 * Student Controller
 */
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
     * Search students data.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $searchQuery = $request->input('search');

        $students = $this->studentService->searchStudents($searchQuery);

        return view('Student.list', compact('students'));
    }

    /**
     * Show Student Form
     *
     * @return View
     */
    public function create(): View
    {
         // Fetch all majors to pass to the view
         $majors = Major::all(); // Assuming you have a Major model

         return view('Student.create', compact('majors')); 
    }

    /**
     * Store Student.
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

    /**
     * Show Edit Student Form
     *
     * @param [type] $id
     * @return View
     */
    public function edit($id): View
    {
        $student = $this->studentService->getStudentById($id); // Get the student by its ID

        $majors = Major::all(); // Fetch all majors for the dropdown

        return view('Student.edit', compact('student', 'majors'));
    }

    /**
     * Update Student
     *
     * @param StudentRequest $request
     * @param [type] $id
     * @return RedirectResponse
     */
    public function update(StudentRequest $request, $id): RedirectResponse
    {
        $this->studentService->updateStudent($id, $request->all());

        return redirect()->route('students.index');
    }

    /**
     * Destroy Student
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

     /**
      * Export Students
      *
      * @return void
      */
    public function export() 
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    /**
     * Import Students
     *
     * @param Request $request
     * @return void
     */
    public function import(Request $request)
    {
        try {
            // Validate the file using the service
            $this->studentService->validateFile($request->file('file'));

            // If validation passes, perform the import
            $this->studentService->importStudents($request->file('file'));

            return back()->with('success', 'File imported successfully!');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             // Get the validation failures
             $failures = $e->failures();
             
              // Redirect back with errors in session using the Session facade
              return back()->withErrors($failures);
        }
    }
}
