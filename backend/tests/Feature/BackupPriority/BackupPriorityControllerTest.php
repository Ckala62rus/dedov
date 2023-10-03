<?php

namespace Tests\Feature\BackupPriority;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Tests\TestCase;

class BackupPriorityControllerTest extends TestCase
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
     * clear && vendor/bin/phpunit --filter=BackupPriorityControllerTest
     *
     * @return void
     */
    public function test_create_backup_priority_success(): void
    {
        // arrange
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = ['name' => 'low priority'];

        // act
        $response = $this->post('admin/backup-priority', $data);

        // assert
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => 'Backup priority was created']);
        $response->assertJson([
            'data' => [
                'backupPriority' => [
                    'name' => $data['name'],
                ],
            ],
        ]);
    }

    public function test_create_backup_priority_fail(): void
    {
        // arrange
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [];

        // act
        $response = $this->post('admin/backup-priority', $data);

        // assert
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
