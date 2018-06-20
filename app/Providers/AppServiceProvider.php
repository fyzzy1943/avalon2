<?php

namespace App\Providers;

use App\Http\Controllers\Auth\WebTokenGuard;
use Illuminate\Auth\CreatesUserProviders;
use Illuminate\Support\ServiceProvider;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    use CreatesUserProviders;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Schema::defaultStringLength(191);\

        Auth::extend('web-token', function ($app, $name, $config) {
            $guard = new WebTokenGuard(
                $this->createUserProvider($config['provider'] ?? null),
                $app['request'],
                $config['input_key'],
                $config['storage_key']
            );

            $app->refresh('request', $guard, 'setRequest');

            return $guard;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        if ($this->app->environment('dev')) {
//            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
//        }
    }
}
