<?php

namespace Tests\Feature\Front\Categories;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryFeatureTest extends TestCase
{
    use RefreshDatabase;
   /** @test */
    public function it_can_show_the_categories_and_products_associated_with_it()
    {
        $this->withoutExceptionHandling();
        $category = factory(ProductCategory::class)->create();
        $product = factory(Product::class)->create();

        $product->categories()->attach([$category->id]);

        $this
            ->get(route('front.categories.show',['slug' => $category->slug]))
            ->assertStatus(200)
            ->assertSee($category->name)
            ->assertSee($product->name)
            ->assertSee($product->description)
            ->assertSee("$product->quantity")
            ->assertSee("$product->price");
    }
}
