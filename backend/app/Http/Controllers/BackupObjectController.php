<?php

namespace App\Http\Controllers;

use App\Contracts\BackupObject\BackupObjectServiceInterface;
use App\Http\Requests\BackupObject\BackupObjectCollectionRequest;
use App\Http\Requests\BackupObject\BackupObjectStoreRequest;
use App\Http\Requests\BackupObject\BackupObjectUpdateRequest;
use App\Http\Resources\Admin\Dashboard\BackupObject\BackupObjectCollectionResource;
use App\Http\Resources\Admin\Dashboard\BackupObject\BackupObjectShowResource;
use App\Http\Resources\Admin\Dashboard\BackupObject\BackupObjectStoreResource;
use App\Http\Resources\Admin\Dashboard\BackupObject\BackupObjectUpdateResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class BackupObjectController extends BaseController
{
    public function __construct(
        private BackupObjectServiceInterface $backupObjectService
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
     * Create backup object entity
     * @param BackupObjectStoreRequest $request
     * @return JsonResponse
     */
    public function store(BackupObjectStoreRequest $request): JsonResponse
    {
        $backupObject = $this
            ->backupObjectService
            ->createBackupObject($request->validated());

        return $this->response(
            ['backupObject' => BackupObjectStoreResource::make($backupObject)],
            'BackupObject was create',
            true,
            ResponseAlias::HTTP_CREATED
        );
    }

    /**
     * Find backupObject by id
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $backupObject = $this
            ->backupObjectService
            ->getBackupObjectById($id);

        if (!$backupObject) {
            return $this->response(
                ['backupObject' => []],
                'BackupObject not found with id:' . $id,
                false,
                ResponseAlias::HTTP_OK
            );
        }

        return $this->response(
            ['backupObject' => BackupObjectShowResource::make($backupObject)],
            'Find backupObject by id:' . $id,
            true,
            ResponseAlias::HTTP_OK
        );
    }

    public function edit(int $id)
    {
        // view
    }

    /**
     * Update backup object by id and return updated new model
     * @param BackupObjectUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(BackupObjectUpdateRequest $request, int $id): JsonResponse
    {
        $backupObject = $this
            ->backupObjectService
            ->updateBackupObject($id, $request->all());

        return $this->response(
            ['backupObject' => BackupObjectUpdateResource::make($backupObject)],
            'Updated backupObject by id:' . $id,
            true,
            ResponseAlias::HTTP_OK
        );
    }

    /**
     * Delete backup object by id
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $isDelete = $this
            ->backupObjectService
            ->deleteBackupObject($id);

        return $this->response(
            ['isDelete' => $isDelete],
            'Delete backupObject by id:' . $id,
            true,
            ResponseAlias::HTTP_OK
        );
    }

    /**
     * Get backup objects with pagination
     * @param BackupObjectCollectionRequest $request
     * @return JsonResponse
     */
    public function getAllBackupWithPagination(BackupObjectCollectionRequest $request): JsonResponse
    {
        $data = $request->validated();

        $backupObjects = $this
            ->backupObjectService
            ->getAllBackupObjectsWithPagination($data['limit'], $data);

        return response()->json([
            'data' => BackupObjectCollectionResource::collection($backupObjects),
            'count' => $backupObjects->total()
        ]);
    }
}
