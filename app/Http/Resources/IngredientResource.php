<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Leugin\KitchenCore\Models\Ingredient\Ingredient;


/**
 * @mixin         Ingredient
 * @property-read array{quantity:int} $pivot
 */
class IngredientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'label'=>$this->name,
            'quantity'=>$this->pivot['quantity']
        ];
    }
}
