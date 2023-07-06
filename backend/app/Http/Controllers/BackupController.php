<?php

namespace App\Http\Controllers;

use App\Contracts\Backup\BackupServiceInterface;
use App\Http\Requests\Backup\BackupStoreRequest;
use App\Http\Resources\Admin\Dashboard\Backup\BackupStoreResource;
use Illuminate\Http\Request;
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
        // view
    }

    public function create()
    {
        // view
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
            ['backup' => BackupStoreResource::make($backup)],
            'Get backup by id:' . $id,
            true,
            Response::HTTP_OK
        );
    }

    public function edit($id)
    {
        // view
    }

    public function update(Request $request, $id)
    {
        //
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
}
