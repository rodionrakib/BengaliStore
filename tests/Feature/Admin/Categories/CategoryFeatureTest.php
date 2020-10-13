<?php

namespace Tests\Feature\Admin\Categories;

use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CategoryFeatureTest extends TestCase
{
    use RefreshDatabase;



    /** @test */
    public function it_can_show_the_create_category_page()
    {
        $category = factory(ProductCategory::class)->create();

        $this
            ->actingAs($this->employee, 'employee')
            ->get(route('admin.categories.create'))
            ->assertStatus(200)
            ->assertSee($category->name);
    }

        /** @test */
    
    public function can_not_create_category_with_non_existing_parent()
    {
        // $this->withoutExceptionHandling();
        $cover = UploadedFile::fake()->image('file.png', 600, 600);

        $params = [
            'name' => 'Boys',
            'slug' => 'boys',
            'cover' => $cover,
            'status' => 1,
            'parent' => 999
        ];

        $response = $this
            ->actingAs($this->employee, 'employee')
            ->post(route('admin.categories.store'), $params);
        
        $response->assertSessionHasErrors('parent');

    }
    /** @test */
    public function it_can_create_category()
    {
        $this->withoutExceptionHandling();
        $cover = UploadedFile::fake()->image('file.png', 600, 600);
        $parent = factory(ProductCategory::class)->create();

        $params = [
            'name' => 'Boys',
            'slug' => 'boys',
            'cover' => $cover,
            'status' => 1,
            'parent' => $parent->id
        ];

        $this
            ->actingAs($this->employee, 'employee')
            ->post(route('admin.categories.store'), $params)
            ->assertStatus(302)
            ->assertRedirect(route('admin.categories.index'))
            ->assertSessionHas('message', 'Category created');

        $data = collect($params)->except('cover','parent')->toArray();
        $this->assertDatabaseHas('product_categories',$data);
        $created = ProductCategory::whereSlug('boys')->first();
        $this->assertCount(1,$created->getMedia('cover'));
        $this->assertTrue($parent->children->contains($created));

    }
}
