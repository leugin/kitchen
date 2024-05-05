<?php
namespace App\Http\Controllers\Api\Order;

use App\Features\CreateOrdersFeature;
use App\Features\FindOrdersFeature;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{

    public function paginate(FindOrdersFeature $feature): JsonResponse
    {
        return $feature->__invoke();
    }

    public function store(CreateOrdersFeature $feature): JsonResponse
    {
        return $feature->__invoke();
    }


}
