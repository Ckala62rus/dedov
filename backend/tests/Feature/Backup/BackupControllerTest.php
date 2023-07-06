<?php

namespace Tests\Feature\Backup;

use App\Models\Backup;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;
use Throwable;

class BackupControllerTest extends TestCase
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
     * Return prepare array
     * @param Organization $organization
     * @return array
     */
    private function getData(Organization $organization): array
    {
        return [
            'service' => 'service  test',
            'owner' => 'owner  test',
            'hostname' => 'hostname  test',
            'object' => 'object  test',
            'tool' => 'tool  test',
            'bd' => 'bd  test',
            'restricted_point' => 'restricted_point  test',
            'type' => 'type  test',
            'day' => 'day  test',
            'time_start' => 'time_start test',
            'storage_server' => 'storage_server test',
            'storage_long_time' => 'storage_long_time test',
            'organization_id' => $organization->id,
        ];
    }

    /**
     * A basic feature test example.
     * clear && vendor/bin/phpunit --filter=BackupControllerTest
     *
     * @return void
     * @throws Throwable
     */
    public function test_create_backup_success(): void
    {
        // arrange
        $this->withExceptionHandling();
        $user           = User::factory()->create();
        $organization   = Organization::factory()->create();

        $this->actingAs($user);
        $data = $this->getData($organization);

        // act
        $response = $this->post('admin/backup', $data);

        // assert
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
        $response->assertJson(['status' => true]);
        $response->assertJson(['message' => 'Backup was created']);
        $response->assertJson([
            'data' => [
                'backup' => [
                    'service' => $data['service'],
                    'user_id' => $user->id,
                    'organization_id' => $organization->id,
                ],
            ],
        ]);
    }

    public function test_read_backup_by_id_success(): void
    {
        // arrange
        $this->withExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        $backupCreate = Backup::factory()->create();

        // act
        $response = $this->get('admin/backup/' . $backupCreate->id);
        dd($response->decodeResponseJson());
        // assert
    }
}
