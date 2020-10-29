<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductCategoryController extends Controller
{
	public function create()
	{
    	$categories = ProductCategory::visible()->get();
		return view('admin.products.categories.create',compact('categories'));
	}

    public function store(Request $request)
    {

    	$request->validate(['name' => 'required','slug' => 'required']);

        $data = $request->except(['parent','cover']);
    	
        $category = ProductCategory::create($data);

        if($request->has('parent') && ($request->get('parent') != null))
        {

            $request->validate(['parent' => 'exists:product_categories,id']);
            $parent = ProductCategory::find($request->get('parent'));
            $parent->appendNode($category);
        }  

        if($request->hasFile('cover'))
        {
            $category->addCover($request->file('cover'));
        }

        return redirect()->route('admin.categories.index')->with('message', 'Category created');
    }

    public function index()
    {
    	$categories = ProductCategory::all();
    	return view('admin.products.categories.index',compact('categories'));
    }

    public function edit(Request $request,ProductCategory $category)
    {
        $categories = ProductCategory::all();
        return view('admin.products.categories.edit',compact('category','categories'));
    }
    public function update(Request $request,ProductCategory $category)
    {
        $request->validate([
            'slug' => Rule::unique('product_categories')->ignore($category->id),
        ]);
 
        $data = $request->only(['name', 'slug','status']);
        


        if (request()->hasFile('cover'))
        {
            if($category->hasMedia('cover'))
            {
                $category->removeCover();
                
            }
            $category->addCover($request->file('cover'));

        }

        if ($request->has('parent')) {
            
            $request->validate(['parent' => 'exists:product_categories,id']);

            $parent = ProductCategory::find($request->get('parent'));

            $parent->appendNode($category);

        }
        $category->update($data);

        return redirect()->route('admin.categories.index')->with('message', 'Category updated');

    }


    public function destroy(ProductCategory $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('message', 'Category deleted');
    }
}
