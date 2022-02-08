<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Teacher;
use App\Models\User;
use App\Policies\AdminPolicy;
use App\Policies\StudentPolicy;
use App\Policies\TeacherPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Admin::class => AdminPolicy::class,
        Student::class => StudentPolicy::class,
        Teacher::class => TeacherPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-personal-info', function (User $user) {
            return $user->role === User::STUDENT_ROLE;
        });

        Gate::define('view-company-info', function (User $user) {
            return $user->role === User::STUDENT_ROLE;
        });

        Gate::define('view-project-info', function (User $user) {
            return $user->role === User::STUDENT_ROLE;
        });

        Gate::define('view-residency-info', function (User $user) {
            return $user->role === User::STUDENT_ROLE;
        });

    }
}
