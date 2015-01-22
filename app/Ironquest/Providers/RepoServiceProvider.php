<?php namespace Ironquest\Providers;

use Illuminate\Support\ServiceProvider;
use Ironquest\Repos\Eloquent;
use Ironquest;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->bind('\Ironquest\Repos\AbilityRepoInterface', function()
        {
            return new Ironquest\Repos\Eloquent\AbilityRepo(new Ironquest\Ability());
        });

        $this->app->bind('\Ironquest\Repos\ApiKeyRepoInterface', function()
        {
            return new Ironquest\Repos\Eloquent\ApiKeyRepo(new Ironquest\ApiKey());
        });

        $this->app->bind('\Ironquest\Repos\AttributeModifierRepoInterface', function()
        {
            return new Ironquest\Repos\Eloquent\AttributeModifierRepo(new Ironquest\AttributeModifier());
        });

        $this->app->bind('\Ironquest\Repos\AttunementRepoInterface', function()
        {
            return new Ironquest\Repos\Eloquent\AttunementRepo(new Ironquest\Attunement());
        });

        $this->app->bind('\Ironquest\Repos\MilestoneRepoInterface', function()
        {
            return new Ironquest\Repos\Eloquent\MilestoneRepo(new Ironquest\Milestone());
        });

        $this->app->bind('\Ironquest\Repos\TargetRepoInterface', function()
        {
            return new Ironquest\Repos\Eloquent\TargetRepo(new Ironquest\Target());
        });

        $this->app->bind('\Ironquest\Repos\UserRepoInterface', function()
        {
            return new Ironquest\Repos\Eloquent\UserRepo(new Ironquest\User());
        });

        $this->app->bind('\Ironquest\Repos\UserTypeRepoInterface', function()
        {
            return new Ironquest\Repos\Eloquent\UserTypeRepo(new Ironquest\UserType());
        });
    }
}

