<?php

namespace App\Livewire;

use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Livewire\Component;

class TasksDashboard extends Component
{

    public $tasksGroups;
    public $taskName;
    private TaskService $taskService;

    public function create(): void
    {

        $user = auth()->user();

        if (! $user->can('create', new Task())){
            abort(403);
        }

        $this->taskService->create($this->taskName, $user->id);

        $this->taskName = '';

        $this->populateTasksGroups();

    }

    public function updateStatus($taskId, $status): void
    {

        if (! auth()->user()->can('update', Task::find($taskId))){
            abort(403);
        }

        $this->taskService->update($taskId, $status);

        $this->populateTasksGroups();

    }

    public function delete($taskId): void
    {

        if (! auth()->user()->can('delete', Task::find($taskId))){
            abort(403);
        }

        $this->taskService->delete($taskId);

        $this->populateTasksGroups();

    }

    private function populateTasksGroups(): void
    {
        $this->tasksGroups = $this->taskService->findByUserIdGroupedByStatus(auth()->user()->id)->toArray();
    }

    public function boot(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function mount()
    {

        $user = auth()->user();

        if (!$user->can('viewAny', new Task())){
            abort(403);
        }

        $this->populateTasksGroups();
    }

    public function render()
    {
        return view('livewire.tasks-dashboard');
    }
}
