<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	public function home()
	{
		$featuredProducts = Product::featured()->limit(4)->get();
        $menCategory =  ProductCategory::find(2);
        $womanCategory =  ProductCategory::find(1);

        $popularMen = $menCategory->popularProducts(4);
        $popularWomen = $womanCategory->popularProducts(4);


        return view('front.products.index',compact('featuredProducts',
            'menCategory','womanCategory',
            'popularMen','popularWomen',
        ));
        
	}
    public function show($slug)
    {
        $product = Product::whereSlug($slug)->firstOrFail();
        
        $product->increaseViewCount();
        
        $breadCrumb = $product->getBreadcrumb();
    	
        $cover  = $product->getCoverImage();
        
        $images = $product->getMedia('thumb');
    	
        $images->prepend($cover);
        
        $popularProducts = $product->getRootCategory()->popularProducts(6);
    	$featuredProducts = Product::where('featured',true)->take(8)->get();

        return view('front.products.show',compact('product','images','cover','breadCrumb','popularProducts','featuredProducts')); 
    }

}
