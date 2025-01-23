<?php

namespace App\Http\Controllers;

use App\Exports\StudentsExport;
use App\Http\Requests\StudentRequest;
use App\Models\Major;
use App\Services\StudentServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

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
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('Student.list');
    }

    /**
     * Fetch all students (AJAX request).
     *
     * @return JsonResponse
     */
    public function fetchStudents(): JsonResponse
    {
        try {
            $students = $this->_studentService->getAllStudents();

            return response()->json(['students' => $students]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'error_message' => 'Error occurred while fetching students.',
                ],
                500
            );
        }
    }

    /**
     * Show Student Form
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(): JsonResponse
    {
        $majors = Major::all();

        return response()->json(['majors' => $majors]);
    }

    /**
     * Store Student
     * @param \App\Http\Requests\StudentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StudentRequest $request): JsonResponse
    {
        try {
            $this->_studentService->createStudent($request->all());

            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Student created successfully!',
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Error occurred while creating student.',
                ],
                500
            );
        }
    }

    /**
     * Show Edit Student Form
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        try {
            $student = $this->_studentService->getStudentById($id);

            $majors = Major::all();

            return response()->json(
                [
                    'status' => 200,
                    'majors' => $majors,
                    'student' => $student,
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Student not found'
                ]
            );
        }
    }

    /**
     * Update Student
     *
     * @param StudentRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function update(StudentRequest $request, int $id): JsonResponse
    {
        try {
            $this->_studentService->updateStudent($id, $request->all());

            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Student updated successfully!',
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Error occurred while updating the student.',
                ],
                500
            );
        }
    }

    /**
     * Destroy Student
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->_studentService->deletestudent($id);

            return response()->json(
                [
                    'status' => 200,
                    'message' => 'Student deleted successfully!',
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Student not found'
                ]
            );
        }
    }
}
