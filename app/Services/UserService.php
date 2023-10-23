<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getMailProvider($user)
    {
        return $user->mail_provider;
    }

    public function setMailProvider($user, $mailProvider)
    {
        $this->userRepository->updateMailProvider($user,$mailProvider);
    }

}
