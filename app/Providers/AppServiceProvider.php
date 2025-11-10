<?php

namespace App\Providers;

use App\Models\Slide;
use App\Models\Aboutus;
use App\Models\Program;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //View::share('categories', Category::with('blogs')->oldest()->get());
        //View::share('slides', Slide::oldest()->get());
        //View::share('programs', Program::oldest()->get());
        //View::share('setting', Setting::first());
    }
}
