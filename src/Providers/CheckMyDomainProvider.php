<?php
namespace Sysborg\CheckMyDomain\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;
use Sysborg\CheckMyDomain\Lib\Domain;

class CheckMyDomainProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/checkMyDomain.php', 'checkMyDomain');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton('checkMyDomain', function ($app) {
            return new Domain(config('checkMyDomain.prefix'), config('checkMyDomain.settings'));
        });
    }
}