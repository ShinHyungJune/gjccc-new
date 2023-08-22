<?php

namespace Database\Factories;

use App\Enums\Sex;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $men = User::where("sex", Sex::MEN)->first() ?? User::factory()->create(["sex" => Sex::MEN]);
        $women = User::where("sex", Sex::WOMEN)->first() ?? User::factory()->create(["sex" => Sex::WOMEN]);

        return [
            "men_id" => $men->id,
            "women_id" => $women->id,
        ];
    }
}
