<?php

namespace App\Domains\Order\UseCase;

use Leugin\KitchenCore\Models\Order\Order;

class CreateOrderByRecipeIdUseCase
{
    public function __invoke(
        int $userId,
        int $recipeId
    ) {

        return Order::query()->create(
            [
            'recipe_id' => $recipeId,
            'user_id' => $userId
            ]
        );
    }
}
