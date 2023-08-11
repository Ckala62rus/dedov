<?php

namespace App\Http\Controllers;

use App\Contracts\ChannelType\ChannelTypeServiceInterface;
use App\Http\Requests\ChannelType\ChannelTypeStoreRequest;
use App\Http\Requests\ChannelType\ChannelTypeUpdateRequest;
use App\Http\Resources\Admin\Dashboard\ChannelType\ChannelTypeShowResource;
use App\Http\Resources\Admin\Dashboard\ChannelType\ChannelTypeStoreResource;
use App\Http\Resources\Admin\Dashboard\ChannelType\ChannelTypeUpdateResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ChannelTypeController extends BaseController
{
    /**
     * @param ChannelTypeServiceInterface $channelTypeService
     */
    public function __construct(
        private ChannelTypeServiceInterface $channelTypeService
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
     * Create channel type entity
     * @param ChannelTypeStoreRequest $request
     * @return JsonResponse
     */
    public function store(ChannelTypeStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $channelType = $this
            ->channelTypeService
            ->createChannelType($data);

        return $this->response(
            ['channel-type' => ChannelTypeStoreResource::make($channelType)],
            'Channel type was created',
            true,
            Response::HTTP_CREATED
        );
    }

    /**
     * Get channel type entity by id
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $model = $this
            ->channelTypeService
            ->getChannelTypeById($id);

        if (!$model) {
            return $this->response(
                ['channel-type' => []],
                'Get channel-type entity by id:' . $id,
                false,
                Response::HTTP_OK
            );
        }

        return $this->response(
            ['channel-type' => ChannelTypeShowResource::make($model)],
            'Channel type was created',
            true,
            Response::HTTP_OK
        );
    }

    public function edit(int $id)
    {
        // view
    }

    /**
     * Update channel type entity by id
     * @param ChannelTypeUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ChannelTypeUpdateRequest $request, int $id): JsonResponse
    {
        $model = $this
            ->channelTypeService
            ->updateChannelType($id, $request->validated());

        return $this->response(
            ['channel-type' => ChannelTypeUpdateResource::make($model)],
            "Update channel-type by id:$id",
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Delete channel type by id
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $isDelete = $this
            ->channelTypeService
            ->deleteChannelType($id);

        return $this->response(
            ['delete' => $isDelete],
            "Channel type was deleted with id:$id",
            true,
            Response::HTTP_OK
        );
    }
}
