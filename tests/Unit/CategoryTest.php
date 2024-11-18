<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_fillable_attributes()
    {
        $category = new Category();
        $this->assertEquals([
            'name',
            'slug',
            'image'
        ], $category->getFillable());
    }

    //create
    /** @test */
    public function it_can_create_a_category()
    {
        $category = Category::factory()->create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'image' => 'test-category.jpg',
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
            'slug' => 'test-category',
            'image' => 'test-category.jpg',
        ]);
    }

    /** @test */
    public function it_creates_a_category_with_factory_data()
    {
        $category = Category::factory()->create();
        $this->assertDatabaseHas('categories', [
            'name' => $category->name,
            'slug' => $category->slug,
            'image' => $category->image,
        ]);
    }

    //update
    /** @test */
    public function it_can_update_a_category()
    {
        $category = Category::factory()->create([
            'name' => 'Old Category',
            'slug' => 'old-category',
            'image' => 'old-category.jpg',
        ]);

        //Update the category's attributes
        $category->update([
            'name' => 'Updated Category',
            'slug' => 'updated-category',
            'image' => 'updated-category.jpg',
        ]);
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Category',
            'slug' => 'updated-category',
            'image' => 'updated-category.jpg',
        ]);
    }

    //delete
    /** @test */
    public function it_can_delete_a_category()
    {
        $category = Category::factory()->create();

        //Delete the category
        $category->delete();
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}
