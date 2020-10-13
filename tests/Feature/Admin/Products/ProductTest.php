<?php

namespace Tests\Feature\Admin\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public $sizes;

    protected function setUp():void
    {
        parent::setUp();
        factory(Size::class)->create(['name' => 'small','short_name' => 'S']);
        factory(Size::class)->create(['name' => 'medium','short_name' => 'M']);
        factory(Size::class)->create(['name' => 'large','short_name' => 'L']);
        factory(Size::class)->create(['name' => 'extra large','short_name' => 'XL']);
        $this->sizes = Size::all()->random(3); 

    }

    /** @test */
    public function can_visit_product_create_page()
    {
        $this->signInAsSuperAdmin();
        $this->get(route('admin.products.create'))->assertStatus(200)->assertSee("Add Product");
    }

     /** @test */
    public function can_visit_product_list_page()
    {
        $this->signInAsSuperAdmin();
        $this->get(route('admin.products.index'))->assertStatus(200)->assertSee("Product List");
    }

    /** @test */
    public function admin_can_create_product()
    {
        

        $this->withoutExceptionHandling();

        $product = 'apple';
        $cover = UploadedFile::fake()->image('file.png', 600, 600);

        $thumbnails = [
            UploadedFile::fake()->image('cover.jpg', 600, 600),
            UploadedFile::fake()->image('cover.jpg', 600, 600),
            UploadedFile::fake()->image('cover.jpg', 600, 600)
        ];

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
            'image' => $thumbnails,
            'featured' => true,
        ];

        $this
            ->actingAs($this->employee, 'employee')
            ->post(route('admin.products.store'), $params)
            ->assertStatus(302)
            ->assertRedirect(route('admin.products.edit', 2))
            ->assertSessionHas('message', 'Create successful');

        $productCreated = Product::find(2);
        $this->assertEquals(1,$productCreated->getMedia('cover')->count());
        $this->assertEquals(3,$productCreated->getMedia('thumb')->count());
        
        $collection = collect($params);
        $productsTableData = $collection->except(['image','cover']);

        $this->assertDatabaseHas('products',$productsTableData->toArray());

    }

    /** @test */
    public function it_can_remove_the_thumbnail()
    {
        $this->withoutExceptionHandling();
        $product = 'apple';
        $cover = UploadedFile::fake()->image('file.png', 600, 600);

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
            'image' => [
                UploadedFile::fake()->image('file.png', 200, 200),
                UploadedFile::fake()->image('file1.png', 200, 200),
                UploadedFile::fake()->image('file2.png', 200, 200)
            ]
        ];

         $this
            ->actingAs($this->employee, 'employee')
            ->post(route('admin.products.store'), $params);

        $created = Product::first();
        $this->assertCount(3,$created->getThumbImages());
        dd($created->getThumbImages());
        $imageIdToRemove = $created->getThumbImages()->first()->id;

        $this
            ->actingAs($this->employee, 'employee')
            ->get(route('admin.product.remove.thumb', ['id' => $imageIdToRemove]))
            ->assertStatus(302)
            // ->assertRedirect(url('/'))
            ->assertSessionHas('message', 'Image delete successful');

        $created = $created->fresh();
        $this->assertCount(2,$created->getThumbImages());
    }



     /** @test */
    public function it_can_detach_the_categories_associated_with_the_product()
    {
        $product = 'apple';

        $data = [
            'sku' => $this->faker->numberBetween(1111111, 999999),
            'name' => $product,
            'slug' => Str::slug($product),
            'short_description' => $this->faker->paragraph,
            'short_description' => $this->faker->paragraph,
            'cover' => UploadedFile::fake()->image('file.png', 200, 200),
            'quantity' => 10,
            'price' => 9.95,
            'status' => 1
        ];

        $response = $this->actingAs($this->employee, 'employee')
            ->patch(route('admin.products.update', $this->product->id), $data);

        $this->assertCount(0,$this->product->categories);

        // $response->assertSessionHas(['message' => 'Update successful'])
        //     ->assertRedirect(route('admin.products.edit', $this->product->id));
            
    }

    /** @test */
    public function it_can_sync_the_categories_associated_with_the_product()
    {
        $categories = [];

        $cats = factory(ProductCategory::class,2)->create();

        foreach ($cats as $cat) {
            $categories[] = $cat['id'];
        }

        $product = 'apple';

        $params = [
            'sku' => $this->faker->numberBetween(1111111, 999999),
            'name' => $product,
            'slug' => Str::slug($product),
            'short_description' => $this->faker->paragraph,
            'short_description' => $this->faker->paragraph,
            'cover' => UploadedFile::fake()->image('file.png', 200, 200),
            'quantity' => 10,
            'price' => 9.95,
            'status' => 1,
            'categories' => $categories
        ];

        $response = $this->actingAs($this->employee, 'employee')
            ->put(route('admin.products.update', $this->product->id), $params);
           
        $fresh = $this->product->fresh();
        $this->assertCount(2,$fresh->categories);
        $response->assertStatus(302)
            ->assertRedirect(route('admin.products.edit', $this->product->id))
            ->assertSessionHas('message', 'Update successful');
    }


     /** @test */
    public function it_can_update_a_product_as_featured()
    {
       
       $params = [
        'featured' => 'on'
       ];
       
       $this->assertFalse($this->product->featured);
       
       $response = $this->actingAs($this->employee, 'employee')
            ->put(route('admin.products.update', $this->product->id), $params);

        $fresh = $this->product->fresh();
        $this->assertTrue((boolean)$fresh->featured);
            
    }






}
