<?php

namespace App\Data\Dtos;


use Leugin\KitchenCore\Data\Dto\FindOrder;
use Leugin\KitchenCore\Traits\PaginationDto;

class FindOrderPaginate extends FindOrder
{
    use PaginationDto;

}
