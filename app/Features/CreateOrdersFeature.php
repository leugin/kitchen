<?php

namespace App\Features;

use App\Domains\Order\Operation\CreateRandomOrdersOperation;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Leugin\KitchenCore\Helper\Response;

class CreateOrdersFeature
{
    public function __construct(
        private readonly CreateRandomOrdersOperation $operation,
        private readonly StoreOrderRequest $request
    ) {
    }
    public function __invoke(): JsonResponse
    {
        try {
            DB::beginTransaction();
            $quantity = $this->request->get('quantity');
            $user = $this->request->user('http');
            $this->operation->__invoke($quantity, $user->id);
            DB::commit();
            return response()->json(Response::success());
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json(Response::failed($exception->getMessage()));
        }
    }
}
