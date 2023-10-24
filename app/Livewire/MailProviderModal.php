<?php

namespace App\Livewire;

use App\Services\UserService;
use Livewire\Component;

class MailProviderModal extends Component
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
        return view('livewire.mail-provider-modal');
    }
}
