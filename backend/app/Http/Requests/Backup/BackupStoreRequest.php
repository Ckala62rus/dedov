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
            'service' => 'required|string',
            'owner' => 'nullable|string',
            'hostname' => 'nullable|string',
            'object' => 'required|string',
            'tool' => 'nullable|string',
            'bd' => 'nullable|string',
            'restricted_point' => 'nullable|string',
            'type' => 'nullable|string',
            'day' => 'nullable|string',
            'time_start' => 'nullable|string',
            'storage_server' => 'nullable|string',
            'storage_long_time' => 'nullable|string',
            'organization_id' => 'required|integer',
        ];
    }
}
