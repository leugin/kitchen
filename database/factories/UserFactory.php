<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends Factory<User>
 */
class UserFactory extends \Leugin\KitchenCore\database\factories\UserFactory
{
   protected $model = User::class;
}
