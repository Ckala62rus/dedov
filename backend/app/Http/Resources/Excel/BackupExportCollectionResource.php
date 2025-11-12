<?php

namespace App\Http\Resources\Excel;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BackupExportCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
//        dd($this);
        return [
            'id' => $this->id,
            'organization' => $this->organization->name,
            'service' => $this->service,
            'owner' => $this->owner,
            'hostname' => $this->hostname,
            'object' => $this->backupObject->name,
            'tool' => $this->backupTool ? $this->backupTool->name : null,
            'storage_server' => $this->storage_server,
            'description_storage' => $this->description_storage,
//            'restricted_point' => $this->restricted_point,
            'day' => $this->backupDay ? $this->backupDay->name : null,
            'time_start' => $this->time_start,
            'storage_long_time' => $this->storage_server_long_time,
            'description_storage_long_time' => $this->description_storage_long_time,
            'test_date' => $this->test_date,
            'backup_priority' => $this->backupPriority ? $this->backupPriority->name : null,
            'comment' => $this->comment,
            'proposals' => $this->proposals,
            'os_version' => $this->os_version,
//            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
//            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d'),
        ];
    }
}
