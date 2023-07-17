<?php

namespace App\Http\Controllers;

use App\Contracts\BackupTool\BackupToolServiceInterface;
use App\Http\Requests\BackupTool\BackupToolStoreRequest;
use App\Http\Resources\Admin\Dashboard\BackupTool\BackupToolShowResource;
use App\Http\Resources\Admin\Dashboard\BackupTool\BackupToolStoreResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BackupToolController extends BaseController
{
    /**
     * @param BackupToolServiceInterface $backupToolService
     */
    public function __construct(
        private BackupToolServiceInterface $backupToolService
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
     * Create backup tool entity
     * @param BackupToolStoreRequest $request
     * @return JsonResponse
     */
    public function store(BackupToolStoreRequest $request): JsonResponse
    {
        $tool = $this
            ->backupToolService
            ->createBackupTool($request->validated());

        return $this->response(
            ['backupTool' => BackupToolStoreResource::make($tool)],
            'backupTool was create',
            true,
            Response::HTTP_CREATED
        );
    }

    /**
     * Get backup tool by id
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $tool = $this
            ->backupToolService
            ->getBackupToolById($id);

        if (!$tool)
        {
            return $this->response(
                ['backupTool' => BackupToolShowResource::make($tool)],
                'Backup tool not found by id:' . $id,
                false,
                Response::HTTP_OK
            );
        }

        return $this->response(
            ['backupTool' => BackupToolShowResource::make($tool)],
            'Find backup tool by id:' . $id,
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

    public function destroy($id)
    {
        //
    }
}
