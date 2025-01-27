<?php

namespace App\Http\Controllers;

use App\Services\MajorServiceInterface;
use App\Http\Requests\MajorRequest;
use App\Http\Requests\MajorUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Major Controller
 */
class MajorController extends Controller
{
    /**
     * @var MajorServiceInterface
     */
    private $_majorService;

    /**
     * MajorController constructor
     *
     * @param \App\Services\MajorServiceInterface $majorService
     */
    public function __construct(MajorServiceInterface $majorService)
    {
        $this->_majorService = $majorService;
    }

    /**
     * Display a listing of the majors.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view(
            'Major.list',
            [
                'majors' => $this->_majorService->getAllMajors(),
            ]
        );
    }

    /**
     * Show major create form
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('Major.create');
    }

    /**
     * Store Major
     *
     * @param  \App\Http\Requests\MajorRequest $request
     * @return RedirectResponse
     */
    public function store(MajorRequest $request): RedirectResponse
    {
        $this->_majorService->createMajor($request->name);

        return redirect()->route('major.index')
            ->with('success', 'Major created successfully');
    }

    /**
     * Show major edit form
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(int $id): View
    {
        $major = $this->_majorService->getMajorById($id);

        return view('Major.edit', compact('major'));
    }


    /**
     * Update major
     *
     * @param  \App\Http\Requests\MajorUpdateRequest $request
     * @param  int                                   $id
     * @return RedirectResponse
     */
    public function update(MajorUpdateRequest $request, int $id): RedirectResponse
    {
        $this->_majorService->updateMajor($id, $request->name);

        return redirect()->route('major.index')
            ->with('success', 'Major updated successfully');
    }

    /**
     * Destroy Major
     *
     * @param  int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $majorInUse = \App\Models\Student::where('major_id', $id)->exists();

        if ($majorInUse) {
            return redirect()->route('major.index')
                ->with(
                    'error',
                    'Cannot delete this major, it is assigned to students.'
                );
        }

        $this->_majorService->deletemajor($id);

        return redirect()->route('major.index')
            ->with('success', 'Major deleted successfully.');
    }
}
