<?php

namespace App\Enums;
enum TaskStatus: string
{
    case new = 'new';
    case inProgress = 'in_progress';
    case done = 'done';
}
