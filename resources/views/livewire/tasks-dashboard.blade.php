<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <x-modal.card title="Create Task" blur wire:model.defer="cardModal">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

            <div class="col-span-1 sm:col-span-2">
                <x-input wire:model="taskName" label="Title" placeholder="Task title" />
            </div>

        </div>

        <x-slot name="footer">
            <div class="flex justify-between gap-x-4">
                <div class="flex">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Save" x-on:click="close" wire:click="create" />
                </div>
            </div>
        </x-slot>
    </x-modal.card>


    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto">

            <x-button secondary class="mb-4" onclick="$openModal('cardModal')" label="Create Task" />

            <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                @foreach(\App\Enums\TaskStatus::cases() as $status)
                    <div class="md:w-1/3 p-4 bg-gray-100 rounded border">
                        <h3 class="text-lg font-bold mb-4">{{ $status->value }}</h3>

                        <div class="space-y-2">
                            @if(isset($tasksGroups[$status->value]))

                                @foreach($tasksGroups[$status->value] as $task)

                                    <div class="p-4 bg-white rounded shadow flex justify-between items-center">
                                        <div>
                                            {{ $task['title'] }}
                                        </div>
                                        <div>
                                            <x-dropdown>
                                                <x-dropdown.header label="Change status">

                                                    @if($task['status'] != \App\Enums\TaskStatus::new->value)
                                                        <x-dropdown.item wire:click="updateStatus('{{ $task['id'] }}', '{{ App\Enums\TaskStatus::new->value }}')" icon="clock" label="New" />
                                                    @endif

                                                    @if($task['status'] != \App\Enums\TaskStatus::inProgress->value)
                                                        <x-dropdown.item wire:click="updateStatus('{{ $task['id'] }}', '{{ App\Enums\TaskStatus::inProgress->value }}')" icon="cog" label="In progress" />
                                                    @endif

                                                    @if($task['status'] != \App\Enums\TaskStatus::done->value)
                                                        <x-dropdown.item wire:click="updateStatus('{{ $task['id'] }}', '{{ App\Enums\TaskStatus::done->value }}')" icon="badge-check" label="Done" />
                                                    @endif
                                                </x-dropdown.header>
                                                <x-dropdown.item wire:click="delete({{ $task['id'] }})" separator icon="trash" label="Delete" />
                                            </x-dropdown>
                                        </div>
                                    </div>

                                @endforeach
                        @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
