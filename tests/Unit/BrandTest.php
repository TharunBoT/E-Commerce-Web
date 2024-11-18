<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_fillable_attributes()
    {
        $brand = new Brand();
        $this->assertEquals([
            'name',
            'slug',
            'image'
        ], $brand->getFillable());
    }

    //create
    /** @test */
    public function it_can_create_a_brand()
    {
        $brand = Brand::create([
            'name' => 'Test Brand',
            'slug' => 'test-brand',
            'image' => 'test-brand.jpg',
        ]);

        $this->assertDatabaseHas('brands', [
            'name' => 'Test Brand',
            'slug' => 'test-brand',
            'image' => 'test-brand.jpg',
        ]);
    }

    /** @test */
    public function it_creates_a_brand_with_factory_data()
    {
        $brand = Brand::factory()->create();
        $this->assertDatabaseHas('brands', [
            'name' => $brand->name,
            'slug' => $brand->slug,
            'image' => $brand->image,
        ]);
    }

    //update
    /** @test */
    public function it_can_update_a_brand()
    {
        $brand = Brand::factory()->create([
            'name' => 'Old Brand',
            'slug' => 'old-brand',
            'image' => 'old-brand.jpg',
        ]);

        $brand->update([
            'name' => 'Updated Brand',
            'slug' => 'updated-brand',
            'image' => 'updated-brand.jpg',
        ]);

        $this->assertDatabaseHas('brands', [
            'id' => $brand->id,
            'name' => 'Updated Brand',
            'slug' => 'updated-brand',
            'image' => 'updated-brand.jpg',
        ]);
    }

    //delete
    /** @test */
    public function it_can_delete_a_brand()
    {
        $brand = Brand::factory()->create();

        //Delete the brand
        $brand->delete();
        $this->assertDatabaseMissing('brands', [
            'id' => $brand->id,
        ]);
    }

    /** @test */
    public function it_has_many_products()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $this->assertTrue($brand->products->contains($product));
        $this->assertInstanceOf(Product::class, $brand->products->first());
    }
}
