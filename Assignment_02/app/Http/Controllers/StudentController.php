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
 * StudentController
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
     * Import Student
     *
     * @param Request $request
     * @return void
     */
    public function import(Request $request)
    {
         // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240',
         ]);

         // Get the headers from the uploaded file
        $headingRowImport = new HeadingRowImport();
        $headings = $headingRowImport->toArray($request->file('file'))[0][0];

        // Expected headers (all in lowercase for comparison)
        $expectedHeaders = [
        'student',
        'major',
        'phone',
        'email',
        'address'
        ];

        // Normalize all headers to lowercase for case-insensitive comparison
        $normalizedHeadings = array_map('strtolower', $headings);
        $normalizedExpectedHeaders = array_map('strtolower', $expectedHeaders);

        // Identify wrong headers (headers that do not match expected ones)
        $wrongHeaders = [];

        // Check if any headers in the file do not match the expected headers
        foreach ($normalizedHeadings as $heading) {
            if (!in_array($heading, $normalizedExpectedHeaders)) {
                $wrongHeaders[] = $heading;
            }
        }

        // If there are any wrong headers, return an error
        if (!empty($wrongHeaders)) {
            // Join wrong headers and return the error message
            return back()->withErrors(['error' => 'Wrong header(s): ' . implode(', ', $wrongHeaders)]);
        }

        $import = new StudentsImport();

        try {
            // Perform the import
            Excel::import($import, $request->file('file'));

            // Success message
            return back()->with('success', 'File imported successfully!');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             // Get the validation failures
             $failures = $e->failures();
             
              // Redirect back with errors in session using the Session facade
              return back()->withErrors($failures);
        }
    }
}
