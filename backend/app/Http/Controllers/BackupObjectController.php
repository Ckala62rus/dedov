<?php

namespace App\Http\Controllers;

use App\Contracts\BackupObject\BackupObjectServiceInterface;
use App\Http\Requests\BackupObject\BackupObjectStoreRequest;
use App\Http\Resources\Admin\Dashboard\BackupObject\BackupObjectShowResource;
use App\Http\Resources\Admin\Dashboard\BackupObject\BackupObjectStoreResource;
use Illuminate\Http\Request;
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

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        //
    }
}
