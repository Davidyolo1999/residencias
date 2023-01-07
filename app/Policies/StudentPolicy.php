<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->role === User::ADMIN_ROLE || $user->role === User::TEACHER_ROLE || $user->role === User::EXTERNAL_ADVISOR_ROLE;
    }

    public function create(User $user)
    {
        return $user->role === User::ADMIN_ROLE;
    }

    public function show(User $user, Student $student)
    {
        return
            $user->role === User::ADMIN_ROLE ||
            $user->role === User::TEACHER_ROLE ||
            $user->role === User::EXTERNAL_ADVISOR_ROLE ||
            $user->id === $student->user_id;
    }

    public function update(User $user, Student $student)
    {
        return $user->role === User::ADMIN_ROLE;
    }
    
    public function destroy(User $user, Student $student)
    {
        return $user->role === User::ADMIN_ROLE;
    }
    
    public function export(User $user)
    {
        return $user->role === User::ADMIN_ROLE;
    }
}
