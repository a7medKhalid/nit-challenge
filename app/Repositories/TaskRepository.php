<?php
namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TaskRepository
{
    protected Task $task;

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

    public function findByUserId($user_id) : Collection
    {
        return $this->task->where('user_id', $user_id)
            ->get();
    }

    public function findByUserIdGroupedByStatus($user_id) : Collection
    {
        return $this->findByUserId($user_id)
            ->groupBy('status');
    }
}
