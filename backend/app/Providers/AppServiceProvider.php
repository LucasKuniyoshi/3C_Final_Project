<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domains\UserDomain\Services\UserService;
use App\Domains\UserDomain\Repositories\UserRepository;
use App\Domains\UserDomain\Services\Contracts\UserServiceInterface;
use App\Domains\UserDomain\Repositories\Contracts\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    public function boot()
    {
        //
    }
}
