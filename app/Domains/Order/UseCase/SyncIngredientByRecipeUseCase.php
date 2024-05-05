<?php

namespace App\Domains\Order\UseCase;
use Leugin\AlegraLaravel\Framework\Model\Order;
use Leugin\AlegraLaravel\Framework\Model\Recipe;

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
