<?php

namespace Tests\Feature\InternetServiceProvider;

use App\Models\ChannelType;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

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
     * @throws \Throwable
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


}
