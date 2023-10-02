<?php

namespace App\Http\Resources\Admin\Dashboard\BackupPriority;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BackupPriorityStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
