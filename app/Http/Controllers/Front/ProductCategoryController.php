<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function show($slug1,$slug2 = null, $slug3 = null)
    {
    	if($slug3){$slug = $slug3;}
    	elseif ($slug2) {$slug = $slug2;}
    	else{$slug = $slug1;}

    	$category = ProductCategory::whereSlug($slug)->firstOrFail();
    	$breadCrumb = $category->getBreadcrumb();
    	$products = $category->products;
    	return view('front.categories.show',compact('category','products','breadCrumb'));
    }
}
