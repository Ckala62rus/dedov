<?php

namespace App\Exports;

use App\Contracts\Backup\BackupServiceInterface;
use App\Http\Resources\Excel\BackupExportCollectionResource;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BackupsExport implements FromCollection, WithHeadings, ShouldAutoSize//, WithEvents
{
    public function __construct(
        private Request $request,
        private BackupServiceInterface $backupService,
    ){}

    public function collection()
    {
        $data = $this
            ->backupService
            ->getAllBackupsCollection($this->request->all());
//dd($data);
        return BackupExportCollectionResource::collection($data);
    }

    public function registerEvents(): array
    {
        // TODO: Implement registerEvents() method.
    }

    public function headings(): array
    {
        return [
            'Id',
            'Organization',
            'Service',
            'Owner',
            'Hostname',
            'Object',
            'Tool',
            'Storage server',
            'Description_storage',
//            'Restricted point',
            'Day',
            'Time start',
            'Storage long time',
            'Description storage long time',
            'Test date',
            'Backup priority',
            'Comment',
            'Proposals',
            'Os version',
            'Created at',
            'Updated at',
        ];
    }
}
