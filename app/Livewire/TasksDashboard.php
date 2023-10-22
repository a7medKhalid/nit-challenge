<?php

namespace App\Livewire;

use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Livewire\Component;

class TasksDashboard extends Component
{

    public $tasksGroups;

    private TaskService $taskService;

    public function boot(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function mount(){

        $user = auth()->user();

        if (!$user->can('viewAny', new Task())){
            abort(403);
        }

        $this->tasksGroups = $this->taskService->findByUserIdGroupedByStatus($user->id)->toArray();

    }

    public function render()
    {
        return view('livewire.tasks-dashboard');
    }
}
