<?php

namespace App\Features;

use App\Data\Dtos\FindOrderPaginate;
use App\Domains\Order\UseCase\PaginateOrderUseCase;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PaginateResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Leugin\KitchenCore\Helper\Response;

class FindOrdersFeature
{
    public function __construct(
        private readonly PaginateOrderUseCase $operation,
        private readonly Request $request
    ) {
    }
    public function __invoke(): JsonResponse
    {
        $paginate = FindOrderPaginate::from($this->request->toArray());

        $paginateResponse = $this->operation->__invoke($paginate);

        $res = new PaginateResource(
            $paginateResponse,
            fn($item) => new OrderResource($item)
        );
        $res->additional($paginate->toArray());
        return  response()->json(Response::success($res));
    }
}
