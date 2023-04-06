<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'name' => $this->faker->name(),
            'quantity' => random_int(1, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
