<?php

namespace Tests\Feature\Admin\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_can_create_product_category()
    {
        $this->withoutExceptionHandling();
        $this->signInAsSuperAdmin();
        $attr = [
            'name' => 'Electronics',
            'slug' => 'electronics',
            'status' => 1,
        ]; 

        $this->post(route('admin.categories.store'),$attr);

        $this->assertDatabaseHas('product_categories',$attr);
    }

     /** @test */
    public function child_can_be_added_to_parent()
    {
        $root = factory(ProductCategory::class)->create();

        $children = factory(ProductCategory::class)->create();

        $root->appendNode($children);

        $this->assertTrue($children->isChildOf($root));

    }

    /** @test */
    public function it_can_create_the_product_with_categories()
    {
        $product = 'apple';
        $cover = UploadedFile::fake()->image('file.png', 600, 600);

        $thumbnails = [
            UploadedFile::fake()->image('cover.jpg', 600, 600),
            UploadedFile::fake()->image('cover.jpg', 600, 600),
            UploadedFile::fake()->image('cover.jpg', 600, 600)
        ];

        $categories = factory(ProductCategory::class, 2)->create();

        $categoryIds = $categories->transform(function (ProductCategory $category) {
            return $category->id;
        })->all();

        $params = [
            'sku' => $this->faker->numberBetween(1111111, 999999),
            'name' => $product,
            'slug' => Str::slug($product),
            'short_description' => $this->faker->paragraph,
            'long_description' => $this->faker->paragraph,
            'cover' => $cover,
            'quantity' => 10,
            'price' => 9.95,
            'status' => 1,
            'categories' => $categoryIds,
            'image' => $thumbnails
        ];

        $this
            ->actingAs($this->employee, 'employee')
            ->post(route('admin.products.store'), $params)
            ->assertStatus(302)
            ->assertRedirect(route('admin.products.edit', 1))
            ->assertSessionHas('message', 'Create successful');
        $product = Product::first();
        $this->assertCount(2,$product->categories);
    }
    
}
