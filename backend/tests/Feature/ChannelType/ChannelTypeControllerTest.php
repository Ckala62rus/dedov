<?php

namespace Tests\Feature\ChannelType;

use App\Models\ChannelType;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class ChannelTypeControllerTest extends TestCase
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
     * clear && vendor/bin/phpunit --filter=ChannelTypeControllerTest
     *
     * @return void
     */
    public function test_store_channel_type_controller_success(): void
    {
        // arrange
        $data = ['name' => 'server'];
        $this->withExceptionHandling();
        $this->actingAs(User::factory()->create());

        // act
        $response = $this->post('admin/channel-types', $data);

        // assert
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson(['status' => true]);
        $response->assertJson([
            'data' => [
                'channel-type' => [
                    'name' => $data['name'],
                    'description' => null
                ]
            ]
        ]);
    }

    public function test_store_channel_type_controller_all_fields_success(): void
    {
        // arrange
        $data = ['name' => 'server', 'description' => 'some text'];
        $this->withExceptionHandling();
        $this->actingAs(User::factory()->create());

        // act
        $response = $this->post('admin/channel-types', $data);

        // assert
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson(['status' => true]);
        $response->assertJson([
            'data' => [
                'channel-type' => [
                    'name' => $data['name'],
                    'description' => $data['description']
                ]
            ]
        ]);
    }

    public function test_controller_show_channel_type_by_id_success(): void
    {
        // arrange
        $channelTypeCreated = ChannelType::factory()->create();
        $this->withExceptionHandling();
        $this->actingAs(User::factory()->create());

        // act
        $response = $this->get('admin/channel-types/' . $channelTypeCreated->id);

        // assert
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(['status' => true]);
        $response->assertJson([
            'data' => [
                'channel-type' => [
                    'name' => $channelTypeCreated->name,
                    'description' => $channelTypeCreated->description
                ]
            ]
        ]);
    }
}
