<?php

namespace App\Livewire;

use App\Services\UserService;
use Livewire\Component;

class ManageNotificationsModal extends Component
{
    public $mailProvider;

    protected UserService $userService;

    public function save()
    {
        $user = auth()->user();

        if (!$user->can('update', $user)) {
            abort(403);
        }

        $this->userService->setMailProvider($user, $this->mailProvider);
    }

    public function boot(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function render()
    {
        return <<<'HTML'
        <div>
            <x-button.circle secondary icon="bell" onclick="$openModal('notificationsModal')" />

            <x-modal.card title="Choose mail provider" blur wire:model.defer="notificationsModal">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div class="col-span-1 sm:col-span-2">

                    <x-select
                        label="Select Mail Provider"
                        placeholder="Select one of the following"
                        :options="['Mailgun', 'Sendgrid', 'Postmark']"
                        wire:model.defer="mailProvider"
                    />
                    </div>

                </div>

            <x-slot name="footer">
                <div class="flex justify-between gap-x-4">
                    <div class="flex">
                        <x-button flat label="Cancel" x-on:click="close" />
                        <x-button primary label="Save" x-on:click="close" wire:click="save" />
                    </div>
                </div>
            </x-slot>
        </x-modal.card>

        </div>
        HTML;
    }
}
