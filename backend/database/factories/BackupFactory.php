<?php

namespace Database\Factories;

use App\Models\Backup;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Backup>
 */
class BackupFactory extends Factory
{
    protected $model = Backup::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'service' => fake()->slug,
            'owner' => fake()->text(10),
            'hostname' => fake()->slug,
            'object' => fake()->slug,
            'tool' => fake()->slug,
            'bd' => fake()->slug,
            'restricted_point' => fake()->slug,
            'type' => fake()->slug,
            'day' => fake()->slug,
            'time_start' =>  fake()->date(),
            'storage_server' => fake()->slug,
            'storage_long_time' => fake()->date(),
            'user_id' => User::factory()->create(),
            'organization_id' => Organization::factory()->create(),
        ];
    }
}