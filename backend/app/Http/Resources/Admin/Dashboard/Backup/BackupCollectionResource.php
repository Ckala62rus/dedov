<?php

namespace App\Http\Resources\Admin\Dashboard\Backup;

use App\Http\Resources\Admin\Dashboard\Organization\OrganizationShowResource;
use App\Http\Resources\Admin\Dashboard\User\UserShowResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class BackupCollectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'service' => $this->service,
            'owner' => $this->owner,
            'hostname' => $this->hostname,
            'object' => $this->object,
            'tool' => $this->tool,
            'bd' => $this->bd,
            'restricted_point' => $this->restricted_point,
            'description_storage' => $this->description_storage,
            'day' => $this->day,
            'time_start' => $this->time_start,
            'storage_server' => $this->storage_server,
            'storage_server_long_time' => $this->storage_server_long_time,
            'description_storage_long_time' => $this->description_storage_long_time,

            'organization_id' => $this->organization_id,
            'organization' => OrganizationShowResource::make($this->organization),

            'user_id' => $this->user_id,
            'user' => UserShowResource::make($this->user),

            'can_action' => $this->can_delete_or_update_current_user($this),
        ];
    }

    private function can_delete_or_update_current_user($backup): bool
    {

        $user = Auth::user();

        if ($user->roles->first()->name === 'super') {
            return true;
        }

        if ($backup->organization_id == $user->organization_id) {
            return true;
        }
        return false;
    }
}
