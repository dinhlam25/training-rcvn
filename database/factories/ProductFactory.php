<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        return [
            'product_id' => self::getProductId($name),
            'product_name' => $name,
            'product_price' => fake()->randomDigit,
            'description' => fake()->text(),
            'is_sales'   => fake()->randomElement(['-1','0','1']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    private static function getProductId($name)
    {
        return  Product::convertIdByProductName($name);
    }
}
