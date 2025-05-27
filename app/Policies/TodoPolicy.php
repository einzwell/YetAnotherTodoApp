<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Todo;

class TodoPolicy
{
    public function view(User $user, Todo $todoItem): bool
    {
        return $user->id === $todoItem->user_id;
    }

    public function update(User $user, Todo $todoItem): bool
    {
        return $user->id === $todoItem->user_id;
    }

    public function delete(User $user, Todo $todoItem): bool
    {
        return $user->id === $todoItem->user_id;
    }
}
