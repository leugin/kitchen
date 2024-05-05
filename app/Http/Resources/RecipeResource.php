<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Leugin\KitchenCore\Models\Recipe\Recipe;

/**
 * @mixin Recipe
 */
class RecipeResource extends JsonResource
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
            'label'=>$this->label,
            'image'=>$this->image_url,
            'ingredients'=>$this->whenLoaded('ingredients', IngredientResource::collection($this->ingredients))
        ];
    }
}
