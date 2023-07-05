<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'user_id',
        'organization_id',
    ];
}
