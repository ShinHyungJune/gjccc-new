<?php

namespace Database\Factories;

use App\Enums\ProductType;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "product_id" => null,
            "title" => $this->faker->unique()->name,
            "price" => rand(100, 10000),
            "opened_at" => Carbon::now()->addDay(),

            "type" => ProductType::DATING,
            "count_dating" => rand(1,10),
            "place" => $this->faker->address,
            "age" => "10대",
            "max_women" => rand(1,10),
            "max_men" => rand(1,10),
            "must_do" => "테스트",
        ];
    }
}
