<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\OptionProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OptionProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OptionProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = Product::first() ? Product::first() : Product::factory()->create();

        return [
            "product_id" => $product->id,
            "title" => $this->faker->unique()->name,
            "price" => rand(100, 10000),
        ];
    }
}
