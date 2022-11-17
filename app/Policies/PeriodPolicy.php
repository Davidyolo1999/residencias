<?php

namespace App\Policies;

use App\Models\Period;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PeriodPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function index(User $user)
    {
        return $user->role === User::ADMIN_ROLE;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role === User::ADMIN_ROLE;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Period $period)
    {
        return $user->role === User::ADMIN_ROLE;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Period  $period
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function destroy(User $user, Period $period)
    {
        return  $user->role === User::ADMIN_ROLE;
    }
}
