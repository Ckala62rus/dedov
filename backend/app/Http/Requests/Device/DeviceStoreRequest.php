<?php

namespace App\Http\Requests\Device;

use Illuminate\Foundation\Http\FormRequest;

class DeviceStoreRequest extends FormRequest
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
            'hostname' => 'string',
            'model' => 'string',
            'date_buy' => 'string',
            'description_service' => 'string',
            'date_update' => 'string',
            'operation_system' => 'string',
            'cpu' => 'string',
            'count_core' => 'integer',
            'count_core_with_ht' => 'integer',
            'memory' => 'integer',
            'hdd' => 'decimal:2',
            'ssd' => 'integer',
            'address' => 'string',
            'comment' => 'string',
            'user_id' => 'integer',
            'organization_id' => 'integer',
            'equipment_id' => 'integer',
        ];
    }
}
