<?php

namespace App\Http\Controllers;

use App\Contracts\DeviceServiceInterface;
use App\Exports\DevicesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExcelController extends Controller
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

    /**
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function exportDevice(Request $request): BinaryFileResponse
    {
        return Excel::download(new DevicesExport($request, $this->deviceService),'devices.xlsx');
    }
}
