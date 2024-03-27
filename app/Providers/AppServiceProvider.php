<?php

namespace App\Providers;

use App\Models\NotificationsModel;
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
        
        //
        View::composer('*', function ($view) {
            $notifications = NotificationsModel::where('user_id', auth()->id())->where('seen',0)->get();
            $view->with('notifications', $notifications);
        });
    }
}
