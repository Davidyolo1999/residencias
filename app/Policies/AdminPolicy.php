<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->role === User::ADMIN_ROLE;
    }

    public function create(User $user)
    {
        return $user->role === User::ADMIN_ROLE;
    }

    public function destroy(User $user, Admin $admin)
    {
        if ($admin->user_id === 1) {
            return false;
        }

        return $user->role === User::ADMIN_ROLE;
    }

    public function update(User $user, Admin $admin)
    {
        return $user->role === User::ADMIN_ROLE;
    }
}
