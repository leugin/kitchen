<?php

namespace Api\Kitchen\Orders;

use App\Jobs\OrderCreated;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Leugin\RemoteAuth\HttpUserProvider;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Tests\TestCase;

class PostApiKitchenOrdersTest extends TestCase
{
    const URL = 'api/kitchen/orders';
    /**
     * A basic test example.
     */
    public function test_store_order_feature_returns_a_successful_response(): void
    {
        Queue::fake(
            [
            OrderCreated::class,
            ]
        );
        $user= User::factory()->create();

        HttpUserProvider::fake($user);

        $data = [
            'quantity'=>1
        ];

        $response = $this->actingAs($user)->postJson(self::URL, $data);

        $response->assertOk();

    }

    public function test_store_failed_order_feature_returns_a_successful_response(): void
    {

        $user= User::factory()->create();

        HttpUserProvider::fake($user);

        $data = [ ];

        $response = $this->actingAs($user)->postJson(self::URL, $data);

        $response
            ->assertStatus(ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);

    }
}
