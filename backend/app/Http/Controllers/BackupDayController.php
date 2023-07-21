<?php

namespace App\Http\Controllers;

use App\Contracts\Day\BackupDayServiceInterface;
use App\Http\Requests\BackupDay\BackupDayStoreRequest;
use App\Http\Requests\BackupDay\BackupDayUpdateRequest;
use App\Http\Resources\Admin\Dashboard\BackupDay\BackupDayShowResource;
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

    /**
     * Get backup entity by id
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $day = $this
            ->backupDayService
            ->getBackupDayById($id);

        if (!$day)
        {

            return $this->response(
                ['backupDay' => []],
                "BackupDay by id:{$id} not found",
                false,
                Response::HTTP_OK
            );
        }

        return $this->response(
            ['backupDay' => BackupDayShowResource::make($day)],
            "Find backupDay by id:{$id}",
            true,
            Response::HTTP_OK
        );
    }

    public function edit($id)
    {
        // view
    }

    /**
     * Update backup day by id
     * @param BackupDayUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(BackupDayUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        $day = $this
            ->backupDayService
            ->updateBackupDay($id, $data);

        if (!$day)
        {
            return $this->response(
                ['backupDay' => []],
                "BackupDay by id:{$id} not found",
                false,
                Response::HTTP_OK
            );
        }

        return $this->response(
            ['backupDay' => BackupDayShowResource::make($day)],
            "Update backupDay by id:{$id}",
            true,
            Response::HTTP_OK
        );
    }

    public function destroy($id)
    {
        //
    }
}
