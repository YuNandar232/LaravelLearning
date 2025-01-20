<?php

namespace App\Http\Controllers;
use App\Services\MajorServiceInterface;
use App\Http\Requests\MajorRequest;
use Illuminate\Http\RedirectResponse;
use App\Exports\MajorsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\View\View;
use Illuminate\Http\Request;

/**
 * Major Controller
 */
class MajorController extends Controller
{
    /**
     * @var MajorServiceInterface
     */
    private $majorService;

    /**
     * Major Controller constructor.
     *
     * @param MajorServiceInterface $majorService
     */
    public function __construct(MajorServiceInterface $majorService)
    {
        $this->majorService = $majorService;
    }

    /**
     * Display a listing of the majors.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('Major.list', [
            'majors' => $this->majorService->getAllMajors(),
        ]);
    }
 
    /**
     * Create
     *
     * @return View
     */
    public function create(): View
    {
        return view('Major.create'); // Make sure this points to the correct blade view
    }

    /**
     * Store Major
     *
     * @param MajorRequest $request
     * @return RedirectResponse
     */
    public function store(MajorRequest $request): RedirectResponse
    {
        $this->majorService->createMajor($request->name);
        
        return redirect()->route('majors.index');
    }

    /**
     * Edit Major
     *
     * @param [int] $id
     * @return View
     */
    public function edit($id): View
    {
        $major = $this->majorService->getMajorById($id); // Get the major by its ID
        
        return view('Major.edit', compact('major'));
    }

    /**
     * Update Major
     *
     * @param MajorRequest $request
     * @param [int] $id
     * @return RedirectResponse
     */
    public function update(MajorRequest $request, $id): RedirectResponse
    {
        $this->majorService->updateMajor($id, $request->name);
        
        return redirect()->route('majors.index');
    }

    /**
     * Destory Major
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        // Check if any students are using this major
        $majorInUse = \App\Models\Student::where('major_id', $id)->exists();

        if ($majorInUse) {
            // If the major is being used by students, return with an error message
            return redirect()->route('majors.index')->with('error', 'Cannot delete this major, it is assigned to students.');
        }

        $this->majorService->deletemajor($id);
        
        return redirect()->route('majors.index');
    }

    /**
     * Import Majors
     *
     * @return void
     */
    public function import(Request  $request)
    {
        try {
            // Validate the file using the service
            $this->majorService->validateFile($request->file('file'));

            // If validation passes, perform the import
            $this->majorService->importMajors($request->file('file'));

            return back()->with('success', 'File imported successfully!');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             // Get the validation failures
             $failures = $e->failures();
             
              // Redirect back with errors in session using the Session facade
              return back()->withErrors($failures);
        }
    }

    /**
     * Export Majors
     *
     * @return void
     */
    public function export() 
    {
        return Excel::download(new MajorsExport, 'majors.xlsx');
    }
}
