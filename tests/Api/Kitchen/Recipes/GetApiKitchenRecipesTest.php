<?php

namespace Api\Kitchen\Recipes;

use App\Models\User;
use Leugin\RemoteAuth\HttpUserProvider;
use Tests\TestCase;

class GetApiKitchenRecipesTest extends TestCase
{
    const URL = 'kitchen/api/recipes';
    /**
     * A basic test example.
     */
    public function test_find_recipes_feature_returns_a_successful_response(): void
    {
        $user= User::factory()->create();

        HttpUserProvider::fake($user);

        $response = $this->actingAs($user)->getJson(self::URL);

        $response->assertOk()
            ->assertJsonStructure(
                [
                'data'=>[
                    'data',
                    'paginate'=>[
                        'current_page',
                        'from',
                        'last_page',
                        'per_page',
                        'to',
                        'total'
                    ]
                ],
                ]
            );

    }
}
