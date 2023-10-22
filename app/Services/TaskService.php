<?php

namespace App\Services;

use App\Repositories\TaskRepository;

class TaskService
{

    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function create($title, $user_id)
    {
        return $this->taskRepository->create($title, $user_id);
    }

    public function update($id, $status)
    {
        return $this->taskRepository->update($id, $status);
    }

    public function delete($id)
    {
        $this->taskRepository->delete($id);
    }

    public function findByUserId($user_id)
    {
        return $this->taskRepository->findByUserId($user_id);
    }

}
