<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Backup extends Model
{
    use HasFactory;

    protected $fillable = [
        'service',
        'owner',
        'hostname',
        'object',
        'tool',
        'bd',
        'restricted_point',
        'type',
        'day',
        'time_start',
        'storage_server',
        'storage_long_time',
        'description_storage_long_time',
        'user_id',
        'organization_id',
    ];

    /**
     * Get organization mode via relation
     * @return HasOne
     */
    public function organization(): HasOne
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }

    /**
     * Get user model via relation
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
