<?php

namespace Tests\Unit;

use App\Models\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_find_its_path()
    {
    	$dada = factory(ProductCategory::class)->create();
    	$baba = factory(ProductCategory::class)->create();
    	$dada->appendNode($baba);
    	$pola = factory(ProductCategory::class)->create();
    	$baba->appendNode($pola);

    	$this->assertEquals("/categories/".$dada->slug."/".$baba->slug."/".$pola->slug,$pola->path());
    }

     /** @test */
    public function it_can_find_its_breadcrumb()
    {
        $dada = factory(ProductCategory::class)->create();
        $baba = factory(ProductCategory::class)->create();
        $dada->appendNode($baba);
        $pola = factory(ProductCategory::class)->create();
        $baba->appendNode($pola);

        dd($pola->getBreadcrumb());

    }



}
