<?php

namespace App\Domains\Order\UseCase;
use App\Data\Dtos\FindRecipePaginate;
use Leugin\KitchenCore\Models\Recipe\Recipe;

class PaginateRecipeUseCase
{
    public function __invoke(FindRecipePaginate $findOrderPaginate )
    {

        return  Recipe::filter($findOrderPaginate)
            ->with(['ingredients'])
            ->paginate($findOrderPaginate->perPage);
    }
}
