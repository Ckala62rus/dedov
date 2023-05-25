<?php

namespace App\Http\Controllers;

use App\Contracts\OrganizationServiceInterface;
use App\Http\Requests\Organization\OrganizationStoreRequest;
use App\Http\Requests\OrganizationCollectionRequest;
use App\Http\Resources\Admin\Dashboard\Organization\OrganizationCollectionResource;
use App\Http\Resources\Admin\Dashboard\Organization\OrganizationCreateResource;
use App\Http\Resources\Admin\Dashboard\Organization\OrganizationShowResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class OrganizationController extends BaseController
{
    private OrganizationServiceInterface $organizationService;

    public function __construct(OrganizationServiceInterface $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    /**
     * Return index view
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Organization/OrganizationIndex');
    }

    /**
     * Return create page
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Organization/OrganizationCreate');
    }

    /**
     * Create organization
     * @param OrganizationStoreRequest $request
     * @return mixed
     */
    public function store(OrganizationStoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        $organization = $this->organizationService->createOrganizations($data);
        return $this->response(
            [OrganizationCreateResource::make($organization)],
            'Organization was created',
            true,
            Response::HTTP_CREATED
        );
    }

    public function show(int $id)
    {
        $organization = $this->organizationService->getOrganizationsById($id);
        return $this->response(
            ['organization' => OrganizationShowResource::make($organization)],
            'Organization by id',
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Return edit page
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit(int $id)
    {
        return Inertia::render('Organization/OrganizationEdit', ['id' => $id]);
    }

    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Delete organization by id
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function destroy(int $id): \Symfony\Component\HttpFoundation\JsonResponse
    {
        $isDelete = $this->organizationService->deleteOrganizations($id);
        return $this->response(
            [$isDelete],
            'Organization was deleted',
            true,
            Response::HTTP_OK
        );
    }

    /**
     * Get organization collection
     * @param OrganizationCollectionRequest $request
     * @return JsonResponse
     */
    public function getAllOrganizationsWithPagination(OrganizationCollectionRequest $request): JsonResponse
    {
        $data = $request->validated();

        $organizations = $this
            ->organizationService
            ->getAllOrganizationsWithPagination($data['limit']);

        return response()->json([
            'data' => OrganizationCollectionResource::collection($organizations),
            'count' => $organizations->total()
        ]);
    }
}
