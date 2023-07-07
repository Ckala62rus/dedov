<?php

namespace App\Http\Controllers;

use App\Contracts\Backup\BackupServiceInterface;
use App\Http\Requests\Backup\BackupCollectionRequest;
use App\Http\Requests\Backup\BackupStoreRequest;
use App\Http\Requests\Backup\BackupUpdateRequest;
use App\Http\Resources\Admin\Dashboard\Backup\BackupCollectionResource;
use App\Http\Resources\Admin\Dashboard\Backup\BackupStoreResource;
use App\Http\Resources\Admin\Dashboard\Backup\BuckupShowResource;
use App\Http\Resources\Admin\Dashboard\Backup\BuckupUpdateResource;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BackupController extends BaseController
{
    /**
     * @param BackupServiceInterface $backupService
     */
    public function __construct(
        private BackupServiceInterface $backupService
    ){}

    public function index()
    {
        return Inertia::render('Backup/BackupIndex');
    }

    public function create()
    {
        return Inertia::render('Backup/BackupCreate');
    }

    /**
     * Create new backup
     * @param BackupStoreRequest $request
     * @return JsonResponse
     */
    public function store(BackupStoreRequest $request): JsonResponse
    {
        $backup = $this
            ->backupService
            ->createBackup($request->validated());

        return $this->response(
            ['backup' => BackupStoreResource::make($backup)],
            'Backup was created',
            true,
            Response::HTTP_CREATED
        );
    }

    /**
     * Get backup by id and return model or 404 error( status false )
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $backup = $this
            ->backupService
            ->getBackupById($id);

        if (!$backup) {
            return $this->response(
                ['backup' => []],
                'Get backup by id:' . $id,
                false,
                Response::HTTP_OK
            );
        }

        return $this->response(
            ['backup' => BuckupShowResource::make($backup)],
            'Get backup by id:' . $id,
            true,
            Response::HTTP_OK
        );
    }

    public function edit($id)
    {
        // view
    }

    /**
     * Update backup by id
     * @param BackupUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(BackupUpdateRequest $request, int $id): JsonResponse
    {
        $backup = $this
            ->backupService
            ->updateBackup($id, $request->validated());

        return $this->response(
            ['backup' => BuckupUpdateResource::make($backup)],
            'Backup was updated',
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Delete backup by id
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $isDelete = $this
            ->backupService
            ->deleteBackup($id);

        return $this->response(
            ['delete' => $isDelete],
            "Device was deleted with id:$id",
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Get all backups with pagination
     * @param BackupCollectionRequest $request
     * @return JsonResponse
     */
    public function getAllBackupWithPagination(BackupCollectionRequest $request): JsonResponse
    {
        $data = $request->validated();

        $devices = $this
            ->backupService
            ->getAllBackupsWithPagination($data['limit'], $data);

        return response()->json([
            'data' => BackupCollectionResource::collection($devices),
            'count' => $devices->total()
        ]);
    }
}
