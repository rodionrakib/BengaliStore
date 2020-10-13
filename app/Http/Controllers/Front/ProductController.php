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
        $cat1 =  ProductCategory::find(1);
        $cat2 =  ProductCategory::find(2);
		return view('front.products.index',compact('featuredProducts','cat1','cat2'));
        
	}
    public function show($slug)
    {
        $product = Product::whereSlug($slug)->firstOrFail();
    	$cover  = $product->getCoverImage();
        $images = $product->getMedia('thumb');
    	$images->prepend($cover);
    	return view('front.products.show',compact('product','images','cover')); 
    }
}
