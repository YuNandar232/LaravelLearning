<?php

namespace App\Services;

interface TaskServiceInterface
{
    public function getAllTasks();

    public function createTask(string $name);

    public function deleteTask(int $id);
}