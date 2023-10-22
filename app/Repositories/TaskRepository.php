<?php
namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function create($title, $user_id) : Task
    {
        $task = $this->task->newInstance(['title' => $title, 'user_id' => $user_id]);
        $task->save();
        return $task;
    }

    public function update($id, $status) : Task
    {
        $task = $this->task->findOrFail($id);
        $task->status = $status;
        $task->save();
        return $task;
    }

    public function delete($id) : void
    {
        $task = $this->task->findOrFail($id);
        $task->delete();
    }

    public function findByUserId($user_id) : Task
    {
        return $this->task->where('user_id', $user_id)->get();
    }
}
