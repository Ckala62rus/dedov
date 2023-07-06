<?php

namespace App\Http\Requests\Backup;

use Illuminate\Foundation\Http\FormRequest;

class BackupStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'service' => 'string',
            'owner' => 'string',
            'hostname' => 'string',
            'object' => 'string',
            'tool' => 'string',
            'bd' => 'string',
            'restricted_point' => 'string',
            'type' => 'string',
            'day' => 'string',
            'time_start' => 'string',
            'storage_server' => 'string',
            'storage_long_time' => 'string',
            'organization_id' => 'required|integer',
        ];
    }
}
