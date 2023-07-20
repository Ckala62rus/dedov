<?php

namespace Tests\Feature\BackupDay;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class BackupDayControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withHeaders([
            'accept' => 'application/json'
        ]);
    }

    /**
     * A basic feature test example.
     * clear && vendor/bin/phpunit --filter=BackupDayControllerTest
     *
     * @return void
     */
    public function test_create_backup_day_without_required_field_name_422_error(): void
    {
        // arrange
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);

        // act
        $response = $this->post('admin/backup-days', []);

        // assert
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors([
            'name' => 'The name field is required.',
        ]);
    }

    public function test_create_backup_day_success(): void
    {
        // arrange
        $this->withExceptionHandling();
        $user = User::factory()->create();

        $this->actingAs($user);
        $dataPrepare =  [
            'name' => 'some name',
        ];

        // act
        $response = $this->post('admin/backup-days', $dataPrepare);

        // assert
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => 'backupDay was created']);
        $response->assertJson([
            'data' => [
                'backupDay' => [
                    'name' => $dataPrepare['name'],
                    'description' => null,
                ],
            ],
        ]);
    }

    public function test_create_backup_days_with_all_field_success(): void
    {
        // arrange
        $this->withExceptionHandling();
        $user = User::factory()->create();

        $this->actingAs($user);
        $dataPrepare =  [
            'name' => 'some name',
            'description' => 'some description',
        ];

        // act
        $response = $this->post('admin/backup-days', $dataPrepare);

        // assert
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => 'backupDay was created']);
        $response->assertJson([
            'data' => [
                'backupDay' => [
                    'name' => $dataPrepare['name'],
                    'description' => $dataPrepare['description'],
                ],
            ],
        ]);
    }
}
