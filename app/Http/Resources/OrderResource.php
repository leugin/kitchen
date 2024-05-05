<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Leugin\KitchenCore\Models\Order\Order;

/**
 * @mixin Order
 */
class OrderResource extends JsonResource
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
            'status'=>$this->status,
            'created'=>$this->created_at,
            'recipe'=>new RecipeResource($this->recipe),
            'ingredients'=>BasicResource::collection($this->whenLoaded('ingredients'))
        ];
    }
}
