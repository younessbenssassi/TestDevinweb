<?php

namespace Database\Factories;

use App\Models\Product;
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
            //
            'title'=> $this->faker->sentence(),
            'description'=> $this->faker->text(300),
            'price'=>$this->faker->numberBetween($min = 100,$max = 900),
            'image'=>$this->faker->imageUrl($width=400,$height=200)
        ];
    }
}
