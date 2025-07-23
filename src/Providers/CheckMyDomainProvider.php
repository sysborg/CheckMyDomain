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
        $this->mergeConfigFrom(__DIR__.'/../config/check-my-domain.php', 'check-my-domain');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->singleton('checkMyDomain', function ($app) {
            return new Domain(config('check-my-domain.prefix'), config('check-my-domain.settings'));
        });

        $this->publishes([
            __DIR__.'/../config/check-my-domain.php' => config_path('check-my-domain.php'),
        ], 'check-my-domain-config');
    }
}