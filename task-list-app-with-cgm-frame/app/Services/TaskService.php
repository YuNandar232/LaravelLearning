<?php

namespace App\Services;

use App\Repositories\TaskRepositoryInterface;
use App\Services\TaskServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class TaskService implements TaskServiceInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;

    /**
     * TaskService constructor.
     *
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Get all tasks.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTasks(): Collection
    {
        return $this->taskRepository->getAllTasks();
    }

    /**
     * Create a new task.
     * 
     * @param string $name
     * 
     * @return void
     */
    public function createTask(string $name): void
    {
        $this->taskRepository->createTask($name);
    }

    /**
     * Delete a task by ID.
     * 
     * @param int $id
     * 
     * @return void
     */
    public function deleteTask(int $id): void
    {
        $this->taskRepository->deleteTask($id);
    }
}