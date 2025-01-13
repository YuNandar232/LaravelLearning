<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function getAllTasks();

    public function createTask(string $name);

    public function deleteTask(int $id);
}