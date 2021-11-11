<?php

namespace File\Upload;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function register()
    {
        $this->app->singleton('oss', function () {
            return new Oss\Oss();
        });
        $this->app->singleton('kodo', function () {
            return new Kodo\Kodo();
        });
        $this->app->singleton('cos', function () {
            return new Cos\Cos();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config.php' => config_path('upload.php'),
        ]);
    }
}
