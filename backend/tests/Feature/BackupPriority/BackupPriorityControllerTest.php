<?php

namespace Tests\Feature\BackupPriority;

use App\Models\BackupPriority;
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

    public function test_show_backup_priority_success(): void
    {
        // arrange
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = ['name'=>'low priority'];
        $priority = BackupPriority::factory()->create($data);

        // act
        $response = $this->get('admin/backup-priority/' . $priority->id);

        // assert
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => 'Backup priority by id:' . $priority->id]);
        $response->assertJson([
            'data' => [
                'backupPriority' => [
                    'name' => $data['name'],
                ],
            ],
        ]);
    }

    public function test_show_backup_priority_if_not_exist_in_database(): void
    {
        // arrange
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);

        // act
        $response = $this->get('admin/backup-priority/' . random_int(1,100));

        // assert
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(['status' => false]);
        $response->assertJson([
            'data' => [
                'backupPriority' => [],
            ],
        ]);
    }


}
