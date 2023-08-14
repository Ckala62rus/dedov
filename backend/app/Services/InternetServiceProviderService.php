<?php

namespace App\Services;

use App\Contracts\InternetServiceProvider\InternetServiceProviderRepositoryInterface;
use App\Contracts\InternetServiceProvider\InternetServiceProviderServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class InternetServiceProviderService implements InternetServiceProviderServiceInterface
{
    /**
     * @param InternetServiceProviderRepositoryInterface $internetServiceProviderRepository
     */
    public function __construct(
        private InternetServiceProviderRepositoryInterface $internetServiceProviderRepository
    ){}

    /**
     * Get all internet service providers with pagination
     * @param int $limit
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function getAllInternetServiceProvidersWithPagination(int $limit, array $filter): LengthAwarePaginator
    {
        $query = $this
            ->internetServiceProviderRepository
            ->getQuery();

        return $this
            ->internetServiceProviderRepository
            ->getAllInternetServiceProvidersWithPagination($query, $limit);
    }

    /**
     * Get all internet service provider collection
     * @param array $filter
     * @return Collection
     */
    public function getAllInternetServiceProvidersCollection(array $filter): Collection
    {
        $query = $this
            ->internetServiceProviderRepository
            ->getQuery();

        return $this
            ->internetServiceProviderRepository
            ->getAllInternetServiceProvidersCollection($query);
    }

    /**
     * Create internet service provider and return created model
     * @param array $data
     * @return Model
     */
    public function createInternetServiceProvider(array $data): Model
    {
        $query = $this
            ->internetServiceProviderRepository
            ->getQuery();

        return $this
            ->internetServiceProviderRepository
            ->createInternetServiceProvider($query, $data);
    }

    /**
     * Get internet service provider entity and return model or null if not exist
     * @param int $id
     * @return Model|null
     */
    public function getInternetServiceProviderById(int $id): ?Model
    {
        $query = $this
            ->internetServiceProviderRepository
            ->getQuery();

        return $this
            ->internetServiceProviderRepository
            ->getInternetServiceProviderById($query, $id);
    }

    /**
     * Update internet service provider by id and return updated model
     * @param int $id
     * @param array $data
     * @return Model|null
     */
    public function updateInternetServiceProvider(int $id, array $data): ?Model
    {
        $query = $this
            ->internetServiceProviderRepository
            ->getQuery();

        return $this
            ->internetServiceProviderRepository
            ->updateInternetServiceProvider($query, $id, $data);
    }

    /**
     * Delete internet service provider by id
     * @param int $id
     * @return bool
     */
    public function deleteInternetServiceProvider(int $id): bool
    {
        $query = $this
            ->internetServiceProviderRepository
            ->getQuery();

        return $this
            ->internetServiceProviderRepository
            ->deleteInternetServiceProvider($query, $id);
    }
}
