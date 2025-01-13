<?php

namespace App\Http\Controllers;

use App\Services\TaskServiceInterface;
use App\Http\Requests\TaskRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
     /**
     * @var TaskServiceInterface
     */
    private $taskService;

    /**
     * TaskController constructor.
     *
     * @param TaskServiceInterface $taskService
     */
    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the tasks.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('tasks', [
            'tasks' => $this->taskService->getAllTasks(),
        ]);
    }

    /**
     * Store a newly created task in storage.
     *
     * @param \Illuminate\Http\Requests\TaskRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaskRequest $request): RedirectResponse
    {
        $this->taskService->createTask($request->name);

        return redirect()->route('tasks.index');
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
        $this->taskService->deleteTask($id);

        return redirect()->route('tasks.index');
    }
}
