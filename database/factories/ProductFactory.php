<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productName = $this->faker->unique()->words(2, true); 
        $slug = Str::slug($productName); 

        return [
            'name' => $productName,
            'slug' => $slug,
            'short_description' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'regular_price' => $this->faker->randomFloat(2, 10, 100), // Random price between 10 and 100
            'sale_price' => $this->faker->randomFloat(2, 5, 50), // Random sale price
            'SKU' => $this->faker->unique()->word . '-' . $this->faker->unique()->numberBetween(1000, 9999), // Unique SKU
            'stock_status' => $this->faker->randomElement(['instock', 'outofstock']), // Random stock status
            'quantity' => $this->faker->numberBetween(1, 100), // Random quantity between 1 and 100
            'featured' => $this->faker->boolean, // Random boolean for featured
            'image' => $this->faker->numberBetween(1,6).'.jpg' ,
            'category_id' => Category::factory(), // Automatically create a category
            'brand_id' => Brand::factory(), // Automatically create a brand
        ];
    }
}
