<?php

namespace App\Providers;

use App\Models\Correction;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::composer('layouts.navbars.navs.auth', function ($view) {
            $corrections = Correction::query()
                ->where('is_solved', 0)
                ->whereHas('correctionable', fn($query) => $query->where('user_id', Auth::id()))
                ->get();

            $view->with('corrections', $corrections);
        });
    }
}
