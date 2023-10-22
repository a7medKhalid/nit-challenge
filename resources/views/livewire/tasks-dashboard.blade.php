<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <div>
            <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                @foreach($tasksGroups as $tasksGroup => $tasks)
                    <div class="md:w-1/3 p-4 bg-gray-100 rounded border">
                        <h3 class="text-lg font-bold mb-4">{{ $tasksGroup }}</h3>

                        <div class="space-y-2">
                            @foreach($tasks as $task)

                                <div class="p-4 bg-white rounded shadow flex justify-between items-center">
                                    <div>
                                        {{ $task['title'] }}
                                    </div>
                                    <div>
                                        <x-dropdown>
                                            <x-dropdown.header label="Change status">
                                                <x-dropdown.item icon="clock" label="New" />
                                                <x-dropdown.item icon="cog" label="In progress" />
                                                <x-dropdown.item icon="badge-check" label="Done" />
                                            </x-dropdown.header>
                                            <x-dropdown.item separator icon="trash" label="Delete" />
                                        </x-dropdown>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
