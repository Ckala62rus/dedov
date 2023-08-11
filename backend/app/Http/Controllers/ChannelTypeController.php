<?php

namespace App\Http\Controllers;

use App\Contracts\ChannelType\ChannelTypeServiceInterface;
use App\Http\Requests\ChannelType\ChannelTypeStoreRequest;
use App\Http\Resources\Admin\Dashboard\ChannelType\ChannelTypeShowResource;
use App\Http\Resources\Admin\Dashboard\ChannelType\ChannelTypeStoreResource;
use Illuminate\Http\Request;
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

    public function show(int $id)
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

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        //
    }
}
