<?php

namespace App\Providers;

use App\Contracts\Backup\BackupRepositoryInterface;
use App\Contracts\Backup\BackupServiceInterface;
use App\Contracts\BackupObject\BackupObjectRepositoryInterface;
use App\Contracts\BackupObject\BackupObjectServiceInterface;
use App\Contracts\BackupTool\BackupToolRepositoryInterface;
use App\Contracts\BackupTool\BackupToolServiceInterface;
use App\Contracts\Day\BackupDayRepositoryInterface;
use App\Contracts\Day\BackupDayServiceInterface;
use App\Contracts\DeviceRepositoryInterface;
use App\Contracts\DeviceServiceInterface;
use App\Contracts\EquipmentRepositoryInterface;
use App\Contracts\EquipmentServiceInterface;
use App\Contracts\OrganizationRepositoryInterface;
use App\Contracts\OrganizationServiceInterface;
use App\Contracts\RoleRepositoryInterface;
use App\Contracts\RoleServiceInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Repositories\BackupDayRepository;
use App\Repositories\BackupObjectRepository;
use App\Repositories\BackupRepository;
use App\Repositories\BackupToolRepository;
use App\Repositories\DeviceRepository;
use App\Repositories\EquipmentRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\BackupDayService;
use App\Services\BackupObjectService;
use App\Services\BackupService;
use App\Services\BackupToolService;
use App\Services\DeviceService;
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

        $this->app->bind(DeviceRepositoryInterface::class, DeviceRepository::class);
        $this->app->bind(DeviceServiceInterface::class, DeviceService::class);

        $this->app->bind(BackupRepositoryInterface::class, BackupRepository::class);
        $this->app->bind(BackupServiceInterface::class, BackupService::class);

        $this->app->bind(BackupObjectRepositoryInterface::class, BackupObjectRepository::class);
        $this->app->bind(BackupObjectServiceInterface::class, BackupObjectService::class);

        $this->app->bind(BackupToolRepositoryInterface::class, BackupToolRepository::class);
        $this->app->bind(BackupToolServiceInterface::class, BackupToolService::class);

        $this->app->bind(BackupDayRepositoryInterface::class, BackupDayRepository::class);
        $this->app->bind(BackupDayServiceInterface::class, BackupDayService::class);
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
