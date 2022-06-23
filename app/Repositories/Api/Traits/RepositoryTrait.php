<?php

namespace App\Repositories\Api\Traits;

use App\Models\User;

trait RepositoryTrait
{
    private function getUserAuth(): User
    {
        return auth()->user();
    }
}