<?php

namespace App\Services;

use App\Contracts\InternetSpeed\InternetSpeedRepositoryInterface;
use App\Contracts\InternetSpeed\InternetSpeedServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class InternetSpeedService implements InternetSpeedServiceInterface
{
    /**
     * @param InternetSpeedRepositoryInterface $internetSpeedRepository
     */
    public function __construct(
        private InternetSpeedRepositoryInterface $internetSpeedRepository
    ){}

    /**
     * Get all internet speed entities with pagination
     * @param int $limit
     * @param array $filter
     * @return LengthAwarePaginator.
     */
    public function getAllInternetSpeedsWithPagination(int $limit, array $filter): LengthAwarePaginator
    {
        $query = $this
            ->internetSpeedRepository
            ->getQuery();

        return $this
            ->internetSpeedRepository
            ->getAllInternetSpeedsWithPagination($query, $limit);
    }

    public function getAllInternetSpeedsCollection(array $filter): Collection
    {
        // TODO: Implement getAllInternetSpeedsCollection() method.
    }

    public function createInternetSpeed(array $data): Model
    {
        // TODO: Implement createInternetSpeed() method.
    }

    public function getInternetSpeedById(int $id): ?Model
    {
        // TODO: Implement getInternetSpeedById() method.
    }

    public function updateInternetSpeed(int $id, array $data): ?Model
    {
        // TODO: Implement updateInternetSpeed() method.
    }

    public function deleteInternetSpeed(int $id): bool
    {
        // TODO: Implement deleteInternetSpeed() method.
    }
}
