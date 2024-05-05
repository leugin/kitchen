<?php
namespace App\Http\Controllers\Api\Recipe;

use App\Features\FindRecipesFeature;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class RecipeController extends Controller
{

    public function paginate(FindRecipesFeature $feature): JsonResponse
    {
        return $feature->__invoke();
    }


}
