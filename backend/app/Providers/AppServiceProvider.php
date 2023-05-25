<?php

namespace App\Providers;

use App\Contracts\EquipmentRepositoryInterface;
use App\Contracts\EquipmentServiceInterface;
use App\Contracts\OrganizationRepositoryInterface;
use App\Contracts\OrganizationServiceInterface;
use App\Contracts\RoleRepositoryInterface;
use App\Contracts\RoleServiceInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Repositories\EquipmentRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\EquipmentService;
use App\Services\OrganizationsService;
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
        $this->app->bind(OrganizationServiceInterface::class, OrganizationsService::class);

        $this->app->bind(EquipmentRepositoryInterface::class, EquipmentRepository::class);
        $this->app->bind(EquipmentServiceInterface::class, EquipmentService::class);
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
