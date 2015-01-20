<?php namespace Ironquest\Providers;

use Illuminate\Support\ServiceProvider;
use Ironquest\Validators\UserValidator;
use Ironquest\Services\Login;

class LoginServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('login', function()
        {
            return new Login(new UserValidator);
        });
    }
}

