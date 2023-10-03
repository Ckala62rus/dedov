<?php

namespace App\Http\Controllers;

use App\Contracts\BackupPriority\BackupPriorityServiceInterface;
use App\Http\Requests\BackupPriority\BackupPriorityStoreRequest;
use App\Http\Requests\BackupPriority\BackupPriorityUpdateRequest;
use App\Http\Resources\Admin\Dashboard\BackupPriority\BackupPriorityShowResource;
use App\Http\Resources\Admin\Dashboard\BackupPriority\BackupPriorityStoreResource;
use App\Http\Resources\Admin\Dashboard\BackupPriority\BackupPriorityUpdateResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BackupPriorityController extends BaseController
{
    /**
     * @param BackupPriorityServiceInterface $backupPriorityService
     */
    public function __construct(
        private BackupPriorityServiceInterface $backupPriorityService
    ){}

    public function index()
    {
        // view
    }

    public function create()
    {
        // view
    }

    /**
     * Create backup priority and return entity
     * @param BackupPriorityStoreRequest $request
     * @return JsonResponse
     */
    public function store(BackupPriorityStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $priority = $this
            ->backupPriorityService
            ->createBackupPriority($data);

        return $this->response(
            ['backupPriority' => BackupPriorityStoreResource::make($priority)],
            'Backup priority was created',
            true,
            Response::HTTP_CREATED
        );
    }

    /**
     * Get backup priority by id
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $priority = $this
            ->backupPriorityService
            ->getBackupPriorityById($id);

        if (!$priority) {
            return $this->response(
                ['backupPriority' => []],
                'Backup priority by id:' . $id,
                false,
                Response::HTTP_OK
            );
        }

        return $this->response(
            ['backupPriority' => BackupPriorityShowResource::make($priority)],
            "Backup priority by id:$id",
            true,
            Response::HTTP_OK
        );
    }

    public function edit(int $id)
    {
        // view
    }

    /**
     * Update backup priority by id
     * @param BackupPriorityUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(BackupPriorityUpdateRequest $request, int $id)
    {
        $data = $request->validated();

        $model = $this
            ->backupPriorityService
            ->updateBackupPriority($id, $data);

        return $this->response(
            ['backupPriority' => BackupPriorityUpdateResource::make($model)],
            "Updated backup priority by id:$id",
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Delete backup priority by id
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $isDelete = $this
            ->backupPriorityService
            ->deleteBackupPriority($id);

        return $this->response(
            ['delete' => $isDelete],
            "Backup priority was deleted with id:$id",
            true,
            Response::HTTP_OK
        );
    }
}
