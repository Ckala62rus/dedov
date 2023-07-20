<?php

namespace App\Http\Controllers;

use App\Contracts\Day\BackupDayServiceInterface;
use App\Http\Requests\BackupDay\BackupDayStoreRequest;
use App\Http\Resources\Admin\Dashboard\BackupDay\BackupDayStoreResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BackupDayController extends BaseController
{
    /**
     * @param BackupDayServiceInterface $backupDayService
     */
    public function __construct(
        private BackupDayServiceInterface $backupDayService,
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
     * Create backup day entity
     * @param BackupDayStoreRequest $request
     * @return JsonResponse
     */
    public function store(BackupDayStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $backupDay = $this
            ->backupDayService
            ->createBackupDay($data);

        return $this->response(
            ['backupDay' => BackupDayStoreResource::make($backupDay)],
            'backupDay was created',
            true,
            Response::HTTP_CREATED
        );
    }

    public function show($id)
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
