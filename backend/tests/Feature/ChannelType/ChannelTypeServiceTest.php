<?php

namespace Tests\Feature\ChannelType;

use App\Services\ChannelTypeService;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ChannelTypeServiceTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     * clear && vendor/bin/phpunit --filter=ChannelTypeServiceTest
     *
     * @return void
     */
    public function test_service_channel_type_create_success(): void
    {
        // arrange
        $data = ['name' => 'new channel type'];

        /** @var ChannelTypeService $service */
        $service = $this->app->make(ChannelTypeService::class);

        // act
        $channelType = $service->createChannelType($data);

        // assert
        $this->assertEquals($data['name'], $channelType->name);
        $this->assertEquals(null, $channelType->description);
    }

    public function test_service_channel_type_create_without_required_field_name(): void
    {
        // arrange
        /** @var ChannelTypeService $service */
        $service = $this->app->make(ChannelTypeService::class);

        // act
        // assert
        $this->assertThrows(function() use ($service) {
            $service
                ->createChannelType([]);
        }, QueryException::class);
    }
}
