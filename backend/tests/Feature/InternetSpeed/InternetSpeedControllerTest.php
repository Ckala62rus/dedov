<?php

namespace Tests\Feature\InternetSpeed;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InternetSpeedControllerTest extends TestCase
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
     * clear && vendor/bin/phpunit --filter=InternetSpeedControllerTest
     *
     * @return void
     */
    public function test_example()
    {
        // arrange
        $data = ['name' => '100mb/c'];
        $this->withExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        // act
        $response = $this->post('admin/internet-speed', $data);
        $res = $response->decodeResponseJson();
//dd($res);
        // assert
        $response->assertStatus(201);
        $response->assertJson(['status' => true]);
        $response->assertJson([
            'data' => [
                'internet-speed' => [
                    'name' => $data['name'],
                    'description' => null
                ]
            ]
        ]);
    }
}
