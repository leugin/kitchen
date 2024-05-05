<?php

namespace App\Features;

use App\Data\Dtos\FindRecipePaginate;
use App\Domains\Order\UseCase\PaginateRecipeUseCase;
use App\Http\Resources\PaginateResource;
use App\Http\Resources\RecipeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Leugin\KitchenCore\Helper\Response;

class FindRecipesFeature
{
    public function __construct(
        private readonly PaginateRecipeUseCase $operation,
        private readonly Request $request
    ) {
    }
    public function __invoke(): JsonResponse
    {
        $paginate = FindRecipePaginate::from($this->request->toArray());

        $paginateResponse = $this->operation->__invoke($paginate);

        $res = new PaginateResource(
            $paginateResponse,
            fn($item) => new RecipeResource($item)
        );
        $res->additional($paginate->toArray());
        return  response()->json(Response::success($res));
    }
}
