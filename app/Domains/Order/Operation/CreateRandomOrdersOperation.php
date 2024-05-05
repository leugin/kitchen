<?php

namespace App\Domains\Order\Operation;

use App\Domains\Order\UseCase\CreateOrderByRecipeIdUseCase;
use App\Domains\Order\UseCase\SyncIngredientByRecipeUseCase;
use App\Jobs\OrderCreated;
use Illuminate\Support\Facades\DB;
use Leugin\KitchenCore\Models\Recipe\Recipe;

class CreateRandomOrdersOperation
{
    public function __construct(
        private readonly CreateOrderByRecipeIdUseCase $createOrderByRecipeIdUseCase,
        private readonly SyncIngredientByRecipeUseCase $syncIngredientByRecipeUseCase
    ) {
    }
    public function __invoke(int $quantity, int $userId)
    {
        try {
             $recipes = Recipe::with('ingredients')->get();

            for ($i = 0; $i < $quantity; $i++) {
                /**
* @var Recipe $recipe
*/

                $recipe = $recipes->random();
                /**
* @var Order $order
*/
                $order = $this->createOrderByRecipeIdUseCase->__invoke(
                    $userId,
                    $recipe->id
                );
                $this->syncIngredientByRecipeUseCase->__invoke(
                    $order,
                    $recipe,
                );
                OrderCreated::dispatch($order);

            }
            return Response::success();
        }catch (\Exception $exception){
            DB::rollBack();
            return Response::failed($exception->getMessage());
        }
    }
}
