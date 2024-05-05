<?php

namespace App\Domains\Order\UseCase;
use App\Data\Dtos\FindOrderPaginate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Leugin\KitchenCore\Models\Order\Order;

class PaginateOrderUseCase
{
    public function __invoke(FindOrderPaginate $findOrderPaginate ): LengthAwarePaginator
    {

        return  Order::filter($findOrderPaginate)
            ->with(['recipe'])
            ->paginate($findOrderPaginate->perPage);
    }
}
