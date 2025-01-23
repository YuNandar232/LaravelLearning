<?php

namespace App\Http\Controllers;

use App\Exports\MajorsExport;
use App\Http\Requests\MajorRequest;
use App\Http\Requests\MajorUpdateRequest;
use App\Services\MajorServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

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
     * Major Controller constructor.
     *
     * @param MajorServiceInterface $majorService
     */
    public function __construct(MajorServiceInterface $majorService)
    {
        $this->_majorService = $majorService;
    }

    /**
     * Display a listing of the majors.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('Major.list');
    }

    /**
     * Fetch all majors (AJAX request).
     *
     * @return JsonResponse
     */
    public function fetchMajors()
    {
        try {
            $majors = $this->_majorService->getAllMajors();
            return response()->json(['majors' => $majors]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error_message' => 'Error occurred while fetching majors.',
                ],
                500
            );
        }
    }

    /**
     * Store Major
     *
     * @param  MajorRequest $request
     * @return RedirectResponse
     */
    public function store(MajorRequest $request): JsonResponse
    {
        try {
            $this->_majorService->createMajor($request->name);
            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Major created successfully!',
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Error occurred while creating major.',
                ],
                500
            );
        }
    }

    /**
     * Edit Major
     *
     * @param integer $id
     * @return void
     */
    public function edit(int $id)
    {
        try {
            $major = $this->_majorService->getMajorById($id);

            return response()->json(
                [
                    'status' => 200,
                    'major' => $major,
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Major not found'
                ]
            );
        }
    }

    /**
     * Update Major
     *
     * @param  MajorRequest $request
     * @param  [int]        $id
     * @return RedirectResponse
     */
    public function update(MajorUpdateRequest $request, $id): JsonResponse
    {
        try {
            $this->_majorService->updateMajor($id, $request->name);

            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Major updated successfully!',
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Error occurred while updating the major.',
                ],
                500
            );
        }
    }

    /**
     * Destory Major
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        $majorInUse = \App\Models\Student::where('major_id', $id)->exists();

        if ($majorInUse) {
            return response()->json(
                [
                    'message' => 'Cannot delete this major, 
                    it is assigned to students.',
                ]
            );
        }

        $this->_majorService->deletemajor($id);

        return response()->json(
            [
                'status' => 200,
                'message' => 'Major deleted successfully!',
            ]
        );
    }
}
