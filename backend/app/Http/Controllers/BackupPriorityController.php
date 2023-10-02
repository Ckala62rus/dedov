<?php

namespace App\Http\Controllers;

use App\Contracts\BackupPriority\BackupPriorityServiceInterface;
use App\Http\Requests\BackupPriority\BackupPriorityStoreRequest;
use App\Http\Resources\Admin\Dashboard\BackupPriority\BackupPriorityShowResource;
use App\Http\Resources\Admin\Dashboard\BackupPriority\BackupPriorityStoreResource;
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

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        //
    }
}
