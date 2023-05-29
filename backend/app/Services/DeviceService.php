<?php

namespace App\Services;

use App\Contracts\DeviceRepositoryInterface;
use App\Contracts\DeviceServiceInterface;
use App\Contracts\EquipmentServiceInterface;
use App\Contracts\OrganizationServiceInterface;
use App\Contracts\UserServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\Exception\NotFoundException;

class DeviceService implements DeviceServiceInterface
{
    /**
     * @var DeviceRepositoryInterface
     */
    private DeviceRepositoryInterface $deviceRepository;

    /**
     * @var OrganizationServiceInterface
     */
    private OrganizationServiceInterface $organizationService;

    /**
     * @var EquipmentServiceInterface
     */
    private EquipmentServiceInterface $equipmentService;

    /**
     * @var UserServiceInterface
     */
    private UserServiceInterface $userService;

    /**
     * @param DeviceRepositoryInterface $deviceRepository
     * @param OrganizationServiceInterface $organizationService
     * @param EquipmentServiceInterface $equipmentService
     * @param UserServiceInterface $userService
     */
    public function __construct(
        DeviceRepositoryInterface $deviceRepository,
        OrganizationServiceInterface $organizationService,
        EquipmentServiceInterface $equipmentService,
        UserServiceInterface $userService,
    ) {
        $this->deviceRepository = $deviceRepository;
        $this->organizationService = $organizationService;
        $this->equipmentService = $equipmentService;
        $this->userService = $userService;
    }

    /**
     * Get all devices with pagination and filters
     * @param int $limit
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function getAllDevicesWithPagination(int $limit, array $filter): LengthAwarePaginator
    {
        $query = $this
            ->deviceRepository
            ->getQuery();

        $query = $this
            ->deviceRepository
            ->withDeviceRelation($query, [
                'user',
                'organization',
                'equipment'
            ]);

        return $this
            ->deviceRepository
            ->getAllDevicesWithPagination($query, $limit);
    }

    /**
     * Get all devices collection
     * @param array $filter
     * @return Collection
     */
    public function getAllDevicesCollection(array $filter): Collection
    {
        $query = $this
            ->deviceRepository
            ->getQuery();

        $query = $this
            ->deviceRepository
            ->withDeviceRelation($query, [
                'user',
                'organization',
                'equipment'
            ]);

        return $this
            ->deviceRepository
            ->getAllDevicesCollection($query);
    }

    /**
     * Create device
     * @param array $data
     * @return Model
     */
    public function createDevice(array $data): Model
    {
        $this->checkExistForeignKeyEntity($data);

        $query = $this
            ->deviceRepository
            ->getQuery();

        return $this
            ->deviceRepository
            ->createDevice($query, $data);
    }

    /**
     * Get device by id
     * @param int $id
     * @return Model|null
     */
    public function getDeviceById(int $id): ?Model
    {
        $query = $this
            ->deviceRepository
            ->getQuery();

        $query = $this
            ->deviceRepository
            ->withDeviceRelation($query, [
                'user',
                'organization',
                'equipment'
            ]);

        return $this
            ->deviceRepository
            ->getDeviceById($query, $id);
    }

    /**
     * Update device
     * @param int $id
     * @param array $data
     * @return Model|null
     */
    public function updateDevice(int $id, array $data): ?Model
    {
        $query = $this
            ->deviceRepository
            ->getQuery();

        $this->checkExistForeignKeyEntity($data);

        return $this
            ->deviceRepository
            ->updateDevice($query, $id, $data);
    }

    /**
     * Delete device by  id
     * @param int $id
     * @return bool
     */
    public function deleteDevice(int $id): bool
    {
        $query = $this
            ->deviceRepository
            ->getQuery();

        return $this
            ->deviceRepository
            ->deleteDevice($query, $id);
    }

    private function checkExistForeignKeyEntity(array $data)
    {

        if (isset($data['organization_id'])){
            $organization = $this
                ->organizationService
                ->getOrganizationsById($data['organization_id']);

            if (!$organization) {
                throw new NotFoundException('Organization not found in database!');
            }
        }

        if (isset($data['equipment_id'])){
            $equipment = $this
                ->equipmentService
                ->getEquipmentById($data['equipment_id']);

            if (!$equipment) {
                throw new NotFoundException('Equipment not found in database!');
            }
        }

        if (isset($data['user_id'])){
            $user = $this
                ->userService
                ->getUserById($data['user_id']);

            if (!$user) {
                throw new NotFoundException("User not found in database!");
            }
        }
    }
}
