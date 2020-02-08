<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Blade::directive('error', function ($error) {
            if (isset($errors)) {
                return "<?php if ($errors->has($error)) { ?>";
            } else {
                return "<?php if (false) { ?>";
            }
        });

        \Blade::directive('enderror', function () {
            return "<?php } ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
