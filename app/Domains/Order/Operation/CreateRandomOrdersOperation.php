<?php

namespace App\Domains\Order\Operation;

use App\Domains\Order\UseCase\CreateOrderByRecipeIdUseCase;
use App\Domains\Order\UseCase\SyncIngredientByRecipeUseCase;
use App\Jobs\OrderCreated;
use Illuminate\Support\Facades\DB;
use Leugin\KitchenCore\Helper\Response;
use Leugin\KitchenCore\Models\Order\Order;
use Leugin\KitchenCore\Models\Recipe\Recipe;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
            return response()->json(Response::success());
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json(Response::failed($exception->getMessage()), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
