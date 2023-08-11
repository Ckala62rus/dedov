<?php

namespace App\Http\Controllers;

use App\Contracts\InternetSpeed\InternetSpeedServiceInterface;
use App\Http\Requests\InternetSpeed\InternetSpeedCollectionRequest;
use App\Http\Requests\InternetSpeed\InternetSpeedStoreRequest;
use App\Http\Requests\InternetSpeed\InternetSpeedUpdateRequest;
use App\Http\Resources\Admin\Dashboard\InternetSpeed\InternetSpeedCollectionResource;
use App\Http\Resources\Admin\Dashboard\InternetSpeed\InternetSpeedShowResource;
use App\Http\Resources\Admin\Dashboard\InternetSpeed\InternetSpeedStoreResource;
use App\Http\Resources\Admin\Dashboard\InternetSpeed\InternetSpeedUpdateResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class InternetSpeedController extends BaseController
{
    /**
     * @param InternetSpeedServiceInterface $internetSpeedService
     */
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
            ['internet-speed' => InternetSpeedShowResource::make($model)],
            "Find internet-speed by id:$id",
            true,
            Response::HTTP_OK
        );
    }

    public function edit(int $id)
    {
        // return view
    }

    /**
     * Update internet speed entity by id
     * @param InternetSpeedUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(InternetSpeedUpdateRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();

        $model = $this
            ->internetSpeedService
            ->updateInternetSpeed($id, $data);

        return $this->response(
            ['internet-speed' => InternetSpeedUpdateResource::make($model)],
            "Update internet-speed by id:$id",
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Delete internet-speed entity by id
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

    /**
     * Get all internet speed entity with collection
     * @param InternetSpeedCollectionRequest $request
     * @return JsonResponse
     */
    public function getAllInternetSpeedWithPagination(InternetSpeedCollectionRequest $request): JsonResponse
    {
        $data = $request->validated();

        $models = $this
            ->internetSpeedService
            ->getAllInternetSpeedsWithPagination($data['limit'], $data);

        return response()->json([
            'data' => InternetSpeedCollectionResource::collection($models),
            'count' => $models->total()
        ]);
    }

    /**
     * Get all internet speed collection
     * @return JsonResponse
     */
    public function getAllInternetSpeedCollection(): JsonResponse
    {
        $models = $this
            ->internetSpeedService
            ->getAllInternetSpeedsCollection([]);

        return $this->response(
            ['internet-speed' => InternetSpeedCollectionResource::collection($models)],
            'Internet-speed collection',
            true,
            Response::HTTP_OK
        );
    }
}
