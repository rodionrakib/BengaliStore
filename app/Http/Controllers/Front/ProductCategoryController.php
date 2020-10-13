<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function show($slug)
    {
    	$category = ProductCategory::whereSlug($slug)->firstOrFail();
    	$products = $category->products;
    	return view('front.categories.show',compact('category','products'));
    }
}
