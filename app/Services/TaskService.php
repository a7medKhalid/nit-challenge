<?php

namespace App\Services;

use App\Contracts\MailerInterface;
use App\Enums\TaskStatus;
use App\Repositories\TaskRepository;

class TaskService
{

    protected TaskRepository $taskRepository;
    protected MailerInterface $mailer;


    public function __construct(TaskRepository $taskRepository, MailerInterface $mailer)
    {
        $this->taskRepository = $taskRepository;
        $this->mailer = $mailer;
    }

    public function create($title, $user_id)
    {
        return $this->taskRepository->create($title, $user_id);
    }

    public function update($id, $status)
    {
        $task = $this->taskRepository->update($id, $status);

        //send email if task is completed
        if ($task->status == TaskStatus::done) {
            $email = auth()->user()->email;
            $this->mailer->raw('Task completed', $email, 'Task completed');
        }

        return $task;
    }

    public function delete($id)
    {
        $this->taskRepository->delete($id);
    }

    public function findByUserIdGroupedByStatus($user_id)
    {
        return $this->taskRepository->findByUserIdGroupedByStatus($user_id);
    }

}
