<?php

namespace App\Http\Controllers;

use App\Contracts\DeviceServiceInterface;
use App\Http\Requests\Device\DeviceStoreRequest;
use App\Http\Resources\Admin\Dashboard\Device\DeviceShowResource;
use App\Http\Resources\Admin\Dashboard\Device\DeviceStoreResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DeviceController extends BaseController
{
    /**
     * @var DeviceServiceInterface
     */
    private DeviceServiceInterface $deviceService;

    /**
     * @param DeviceServiceInterface $deviceService
     */
    public function __construct(DeviceServiceInterface $deviceService)
    {
        $this->deviceService = $deviceService;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    /**
     * Create device
     * @param DeviceStoreRequest $request
     * @return JsonResponse
     */
    public function store(DeviceStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        try
        {
            $device = $this
                ->deviceService
                ->createDevice($data);
        }
        catch (\Exception $exception)
        {
            return $this->response(
                ['device' => null],
                $exception->getMessage(),
                false,
                ResponseAlias::HTTP_OK
            );
        }
        return $this->response(
            ['device' => DeviceStoreResource::make($device)],
            'Device was created',
            true,
            ResponseAlias::HTTP_CREATED
        );
    }

    /**
     * Get device by id
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $device = $this
            ->deviceService
            ->getDeviceById($id);

        if (!$device) {
            return $this->response(
                ['device' => null],
                "Device with id:$id not found!",
                false,
                ResponseAlias::HTTP_OK
            );
        }

        return $this->response(
            ['device' => DeviceShowResource::make($device)],
            'Device with id:' . $id,
            true,
            ResponseAlias::HTTP_OK
        );
    }

    public function edit(int $id)
    {
        //
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
