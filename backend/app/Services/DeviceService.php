<?php

namespace App\Services;

use App\Contracts\DeviceRepositoryInterface;
use App\Contracts\DeviceServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class DeviceService implements DeviceServiceInterface
{
    /**
     * @var DeviceRepositoryInterface
     */
    private DeviceRepositoryInterface $deviceRepository;

    /**
     * @param DeviceRepositoryInterface $deviceRepository
     */
    public function __construct(DeviceRepositoryInterface $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
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
}
