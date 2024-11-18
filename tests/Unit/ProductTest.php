<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    //fillable
    /** @test */
    public function it_has_fillable_attributes()
    {
        $product = new Product();
        $this->assertEquals([
            'name',
            'slug',
            'short_description',
            'description',
            'regular_price',
            'sale_price',
            'SKU',
            'stock_status',
            'quantity',
            'featured',
            'image',
            'category_id',
            'brand_id',
        ], $product->getFillable());
    }

    //create
    /** @test */
    public function it_can_create_a_product()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        $product = Product::factory()->create([
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
        ]);
    }

    //read
    /** @test */
    public function it_can_read_a_product()
    {
        $product = Product::factory()->create();

        $fetchedProduct = Product::find($product->id);

        $this->assertEquals($product->name, $fetchedProduct->name);
        $this->assertEquals($product->slug, $fetchedProduct->slug);
    }

    //update
    /** @test */
    public function it_can_update_a_product()
    {
    $product = Product::factory()->create();
    $product->update([
        'name' => 'Updated Product',
        'regular_price' => '150.00', 
    ]);
        $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Updated Product',
        'regular_price' => '150.00', 
        ]);
    }

    //Delete
    /** @test */
    public function it_can_delete_a_product()
    {
        $product = Product::factory()->create();

        $product->delete();
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
