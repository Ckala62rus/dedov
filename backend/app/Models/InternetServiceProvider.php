<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternetServiceProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'static_ip_address',
        'schema_org_channel_provider',
        'cost_participant_1',
        'cost_participant_2',
        'cost_participant_3',
        'cost_participant_4',
        'cost_participant_5',
        'cost_participant_6',
        'comment',
        'internet_speed_id',
        'channel_type_id',
        'organization_id',
        'user_id',
    ];
}
