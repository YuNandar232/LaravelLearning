<?php

namespace App\Http\Controllers;
use App\Services\MajorServiceInterface;
use App\Http\Requests\MajorRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MajorController extends Controller
{
    /**
     * @var MajorServiceInterface
     */
    private $majorService;
    /**
     * MajorController constructor.
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
    public function create(): View
    {
        return view('Major.create'); // Make sure this points to the correct blade view
    }
    /**
     * Store a newly created task in storage.
     *
     * @param \Illuminate\Http\Requests\TaskRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MajorRequest $request): RedirectResponse
    {
        $this->majorService->createMajor($request->name);
        return redirect()->route('majors.index');
    }
    public function edit($id): View
    {
        $major = $this->majorService->getMajorById($id); // Get the major by its ID
        return view('Major.edit', compact('major'));
    }
    // Update the major
    public function update(MajorRequest $request, $id): RedirectResponse
    {
        $this->majorService->updateMajor($id, $request->name);
        return redirect()->route('majors.index');
    }

    /**
     * Remove the specified task from storage.
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
}
