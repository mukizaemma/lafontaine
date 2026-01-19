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

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        //View::share('categories', Category::with('blogs')->oldest()->get());
        //View::share('slides', Slide::oldest()->get());
        //View::share('programs', Program::oldest()->get());
        
        // Share setting with all admin views
        View::composer('admin.*', function ($view) {
            $view->with('setting', Setting::first());
        });
    }
}
