<?php

namespace Tests\Feature\InternetServiceProvider;

use App\Models\ChannelType;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;
use Throwable;

class InternetServiceProviderControllerTest extends TestCase
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
     * clear && vendor/bin/phpunit --filter=InternetServiceProviderControllerTest
     *
     * @return void
     * @throws Throwable
     */
    public function test_controller_store_isp_success(): void
    {
        // arrange
        $organization   = Organization::factory()->create(['name' => 'my organization']); // required
        $address        = '123100, Москва, Пресненская набережная, дом 12 Башня Федерация'; // required
        $channelType    = ChannelType::factory()->create(['name' => 'some channel type']); // required

        $data = [
            'organization_id' => $organization->id,
            'address' => $address,
            'channel_type_id' => $channelType->id,
        ];

        $this->withExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        // act
        $response = $this->post('admin/isp', $data);

        // assert
        $response->assertStatus(ResponseAlias::HTTP_CREATED);
        $response->assertJson(['status' => true]);
        $response->assertJson([
            'data' => [
                'isp' => [
                    'organization_id' => $organization->id,
                    'user' =>
                        [
                            'name' => $user->name
                        ],
                    'address' => $address,
                    'channel_type_id' => $channelType->id,
                ],
            ]
        ]);
    }

    public function test_controller_store_isp_without_organization_id_fail(): void
    {
        // arrange
        $address        = '123100, Москва, Пресненская набережная, дом 12 Башня Федерация'; // required
        $channelType    = ChannelType::factory()->create(['name' => 'some channel type']); // required

        $data = [
            'address' => $address,
            'channel_type_id' => $channelType->id,
        ];

        $this->withExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        // act
        $response = $this->post('admin/isp', $data);

        // assert
        $response->assertStatus(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors([
            'organization_id' => 'The organization id field is required.',
        ]);
    }

    public function test_controller_store_isp_without_address_id_fail(): void
    {
        // arrange
        $organization   = Organization::factory()->create(['name' => 'my organization']); // required
        $channelType    = ChannelType::factory()->create(['name' => 'some channel type']); // required

        $data = [
            'organization_id' => $organization->id,
            'channel_type_id' => $channelType->id,
        ];

        $this->withExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        // act
        $response = $this->post('admin/isp', $data);

        // assert
        $response->assertStatus(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors([
            'address' => 'The address field is required.',
        ]);
    }

    public function test_controller_store_isp_without_channel_type_id_fail(): void
    {
        // arrange
        $organization   = Organization::factory()->create(['name' => 'my organization']); // required
        $address        = '123100, Москва, Пресненская набережная, дом 12 Башня Федерация'; // required

        $data = [
            'organization_id' => $organization->id,
            'address' => $address,
        ];

        $this->withExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        // act
        $response = $this->post('admin/isp', $data);

        // assert
        $response->assertStatus(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors([
            'channel_type_id' => 'The channel type id field is required.',
        ]);
    }
}
