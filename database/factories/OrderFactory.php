<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'ordered_at' => Carbon::now(),
            'complete' => $this->faker->boolean(),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
