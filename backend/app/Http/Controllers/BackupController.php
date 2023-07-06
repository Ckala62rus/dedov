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

    public function show(int $id)
    {
        //
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
