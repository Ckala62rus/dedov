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

    public function show(int $id)
    {
        //
    }

    public function edit(int $id)
    {
        // return view
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
