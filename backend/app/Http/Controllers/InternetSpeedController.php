<?php

namespace App\Http\Controllers;

use App\Contracts\InternetSpeed\InternetSpeedServiceInterface;
use App\Http\Requests\InternetSpeed\InternetSpeedStoreRequest;
use App\Http\Resources\Admin\Dashboard\InternetSpeed\InternetSpeedStoreResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InternetSpeedController extends BaseController
{
    public function __construct(
        private InternetSpeedServiceInterface $internetSpeedService
    ){}

    public function index()
    {
        // return view
    }

    public function create()
    {
        // return view
    }

    /**
     * Create internet speed entity
     * @param InternetSpeedStoreRequest $request
     * @return JsonResponse
     */
    public function store(InternetSpeedStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $model = $this
            ->internetSpeedService
            ->createInternetSpeed($data);

        return $this->response(
            ['internet-speed' => InternetSpeedStoreResource::make($model)],
            'Internet-speed was created',
            true,
            Response::HTTP_CREATED
        );
    }

    /**
     * Get internet speed entity by id
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $model = $this
            ->internetSpeedService
            ->getInternetSpeedById($id);

        if (!$model) {
            return $this->response(
                ['internet-speed' => []],
                'Get internet-speed entity by id:' . $id,
                false,
                Response::HTTP_OK
            );
        }

        return $this->response(
            ['internet-speed' => InternetSpeedStoreResource::make($model)],
            "Find internet-speed by id:$id",
            true,
            Response::HTTP_OK
        );
    }

    public function edit(int $id)
    {
        // return view
    }

    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Delete internet-speed intity by id
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        $isDelete = $this
            ->internetSpeedService
            ->deleteInternetSpeed($id);

        return $this->response(
            ['delete' => $isDelete],
            "Internet-speed was deleted with id:$id",
            true,
            Response::HTTP_OK
        );
    }
}
