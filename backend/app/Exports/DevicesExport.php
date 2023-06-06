<?php

namespace App\Exports;

use App\Contracts\DeviceServiceInterface;
use App\Http\Resources\Excel\DeviceExportCollectionResource;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DevicesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @var DeviceServiceInterface
     */
    private DeviceServiceInterface $deviceService;

    /**
     * @var array
     */
    protected array $filter;

    /**
     * @param Request $request
     * @param DeviceServiceInterface $deviceService
     */
    public function __construct(Request $request, DeviceServiceInterface $deviceService)
    {
        $this->deviceService = $deviceService;
        $this->filter = $request->all();
    }

    public function collection()
    {
        $data = $this
            ->deviceService
            ->getAllDevicesCollection($this->filter);

        return DeviceExportCollectionResource::collection($data);
    }

    public function headings(): array
    {
        return [
            'id',
            'hostname',
            'model',
            'date_buy',
            'description_service',
            'date_update',
            'operation_system',
            'cpu',
            'count_core',
            'count_core_with_ht',
            'memory',
            'hdd',
            'ssd',
            'address',
            'comment',

            'user_id',
            'user',

            'organization_id',
            'organization',

            'equipment_id',
            'equipment',
        ];
    }
}
