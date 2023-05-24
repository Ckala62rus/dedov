<?php

namespace App\Providers;

use App\Contracts\LessonCategoryRepositoryInterface;
use App\Contracts\LessonCategoryServiceInterface;
use App\Contracts\LessonRepositoryInterface;
use App\Contracts\LessonServiceInterface;
use App\Contracts\OrganizationRepositoryInterface;
use App\Contracts\OrganizationServiceInterface;
use App\Contracts\RoleRepositoryInterface;
use App\Contracts\RoleServiceInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Repositories\LessonCategoryRepository;
use App\Repositories\LessonRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\LessonCategoryService;
use App\Services\LessonService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(RoleServiceInterface::class, RoleService::class);

        $this->app->bind(OrganizationRepositoryInterface::class, OrganizationRepository::class);
        $this->app->bind(OrganizationServiceInterface::class, OrganizationRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {

        // Использовать для публикации в ngrok
        // ngrok http 127.0.0.1:8000
//        $url->forceScheme('https');
    }
}
