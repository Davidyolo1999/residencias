<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeacherPolicy
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
    
    public function destroy(User $user, Teacher $externaladvisor)
    {
        return  $user->role === User::ADMIN_ROLE;
    }

    public function update(User $user, Teacher $externaladvisor)
    {
        return $user->role === User::ADMIN_ROLE;
    }
}
