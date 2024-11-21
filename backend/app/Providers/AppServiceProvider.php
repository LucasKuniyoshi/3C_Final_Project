<?php
namespace App\Providers;

use App\Domains\ApplicationDomain\Repositories\ApplicationRepository;
use App\Domains\ApplicationDomain\Repositories\Contracts\ApplicationRepositoryInterface;
use App\Domains\ApplicationDomain\Services\ApplicationService;
use App\Domains\ApplicationDomain\Services\Contracts\ApplicationServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Domains\UserDomain\Services\UserService;
use App\Domains\JobDomain\Repositories\JobRepository;
use App\Domains\CompanyDomain\Services\CompanyService;
use App\Domains\UserDomain\Repositories\UserRepository;
use App\Domains\CompanyDomain\Repositories\CompanyRepository;
use App\Domains\JobDomain\Services\Contracts\JobServiceInterface;
use App\Domains\UserDomain\Services\Contracts\UserServiceInterface;
use App\Domains\JobDomain\Repositories\Contracts\JobRepositoryInterface;
use App\Domains\CompanyDomain\Services\Contracts\CompanyServiceInterface;
use App\Domains\UserDomain\Repositories\Contracts\UserRepositoryInterface;
use App\Domains\CompanyDomain\Repositories\Contracts\CompanyRepositoryInterface;
use App\Domains\JobDomain\Services\JobService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(CompanyServiceInterface::class, CompanyService::class);
        $this->app->bind(JobRepositoryInterface::class, JobRepository::class);
        $this->app->bind(JobServiceInterface::class, JobService::class);
        $this->app->bind(ApplicationServiceInterface::class, ApplicationService::class);
        $this->app->bind(ApplicationRepositoryInterface::class, ApplicationRepository::class);
    }

    public function boot()
    {
        //
    }
}
