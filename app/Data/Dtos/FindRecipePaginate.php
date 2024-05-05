<?php

namespace App\Data\Dtos;


use Leugin\KitchenCore\Data\Dto\FindRecipe;
use Leugin\KitchenCore\Traits\PaginationDto;

class FindRecipePaginate extends FindRecipe
{
    use PaginationDto;

}
