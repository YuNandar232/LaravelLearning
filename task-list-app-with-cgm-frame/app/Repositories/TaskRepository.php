<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * Get all tasks.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllTasks(): Collection
    {
        return Task::orderBy('created_at', 'asc')->get();
    }

    /**
     * Create Task.
     * @param string $name
     * @return void
     */
    public function createTask(string $name): void
    {
        $task = new Task();
        $task->name = $name;
        $task->save();
    }

    /**
     * Delete Task.
     * @param int $id
     * @return void
     */
    public function deleteTask(int $id): void
    {
        Task::findOrFail($id)->delete();
    }
}