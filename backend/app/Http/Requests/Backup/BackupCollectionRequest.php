<?php

namespace App\Http\Requests\Backup;

use Illuminate\Foundation\Http\FormRequest;

class BackupCollectionRequest extends FormRequest
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
            'limit' => 'required|integer',
            "organization_id" => 'integer',
            "hostname" => 'nullable|string',
            "service" => 'nullable|string',
            "owner" => 'nullable|string',
            "object" => 'nullable|string',
            "tool" => 'nullable|string',
            "bd" => 'nullable|string',
            "storage_server" => 'nullable|string',
        ];
    }
}
