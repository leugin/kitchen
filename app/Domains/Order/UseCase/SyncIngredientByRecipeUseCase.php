<?php

namespace App\Domains\Order\UseCase;

use Leugin\KitchenCore\Models\Order\Order;
use Leugin\KitchenCore\Models\Recipe\Recipe;

class SyncIngredientByRecipeUseCase
{

    public function __invoke(
        Order $order,
        Recipe $recipe
    ) {
        $ingredientes = [];
        foreach ($recipe->ingredients as $ingredient) {
            $ingredientes[$ingredient->id] = [
                'required' => $ingredient->pivot->quantity,
            ];
        }
        return $order->ingredients()->sync($ingredientes);
    }
}
