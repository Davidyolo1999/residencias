<?php

namespace App\Policies;

use App\Models\ExternalAdvisor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExternalAdvisorPolicy
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
    
    public function destroy(User $user, ExternalAdvisor $teacher)
    {
        return  $user->role === User::ADMIN_ROLE;
    }

    public function update(User $user, ExternalAdvisor $teacher)
    {
        return $user->role === User::ADMIN_ROLE;
    }

}
