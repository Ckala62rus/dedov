<?php

namespace App\Services;

use App\Contracts\Backup\BackupRepositoryInterface;
use App\Contracts\Backup\BackupServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class BackupService implements BackupServiceInterface
{
    /**
     * @param BackupRepositoryInterface $backupRepository
     */
    public function __construct(
        private BackupRepositoryInterface $backupRepository,
    ){}

    /**
     * Get all backup with pagination and relation
     * @param int $limit
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function getAllBackupsWithPagination(int $limit, array $filter): LengthAwarePaginator
    {
        $query = $this
            ->backupRepository
            ->getQuery();

        return $this
            ->backupRepository
            ->getAllBackupsWithPagination($query, $limit);
    }

    /**
     * Get all backup collection without pagination
     * @param array $filter
     * @return Collection
     */
    public function getAllBackupsCollection(array $filter): Collection
    {
        $query = $this
            ->backupRepository
            ->getQuery();

        return $this
            ->backupRepository
            ->getAllBackupsCollection($query);
    }

    /**
     * Create and return created model backup
     * @param array $data
     * @return Model
     */
    public function createBackup(array $data): Model
    {
        $query = $this
            ->backupRepository
            ->getQuery();

        return $this
            ->backupRepository
            ->createBackup($query, $data);
    }

    /**
     * Get backup by id or return null if not exist
     * @param int $id
     * @return Model|null
     */
    public function getBackupById(int $id): ?Model
    {
        $query = $this
            ->backupRepository
            ->getQuery();

        return $this
            ->backupRepository
            ->getBackupById($query, $id);
    }

    /**
     * Update backup model by id and return updated model
     * @param int $id
     * @param array $data
     * @return Model|null
     */
    public function updateBackup(int $id, array $data): ?Model
    {
        $query = $this
            ->backupRepository
            ->getQuery();

        return $this
            ->backupRepository
            ->updateBackup($query, $id, $data);
    }

    /**
     * Delete backup by id and return boolean
     * @param int $id
     * @return bool
     */
    public function deleteBackup(int $id): bool
    {
        $query = $this
            ->backupRepository
            ->getQuery();

        return $this
            ->backupRepository
            ->deleteBackup($query, $id);
    }
}
