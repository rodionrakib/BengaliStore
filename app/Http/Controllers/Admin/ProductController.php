<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
	public function __construct()
	{
    	$this->middleware(['role:super_admin|admin']);
	}


	public function store(Request $request)
	{


		$request->validate([
			'sku' => 'required',
			'name' => 'required',
			'slug' => 'required|unique:products,slug',
			'short_description' => 'required',
			'price' => 'required|numeric',
			
		]);

		$data = $request->except(['cover','categories','image','sizes']);



		$request->has('featured') ? $data['featured'] = true : $data['featured'] = false ; 
				

		$product = Product::create($data);

		
		
		if($request->has('sizes'))
		{
			$product->sizes()->attach($request->get('sizes'));
		}
		

		if($request->has('categories'))
		{
			$product->categories()->attach($request->get('categories'));
		}

		if($request->hasFile('image'))
		{
			foreach ($request->file('image') as $file) 
			{
				$product->addMedia($file)->toMediaCollection('thumb');

			}
		}

		if($request->hasFile('cover'))
		{
            $product->addCover($request->file('cover'));
		}

		
		return redirect()->route('admin.products.edit',['product'=> $product->id])->with('message','Create successful');

	}


	public function update(Request $request,Product $product)
	{	
		

        $request->validate([
            'slug' => Rule::unique('products')->ignore($product->id),
        ]);
 		

        $data = $request->only(['name', 'slug','sku','short_description','long_description','quantity','price','status']);
        

 		$data['featured'] = $request->has('featured') ? true:false;


        if (request()->hasFile('cover'))
        {
            if($product->hasMedia('cover'))
            {
                $product->removeCover();
                
            }
            $product->addCover($request->file('cover'));

        }

        if($request->hasFile('image'))
		{
			foreach ($request->file('image') as $file) 
			{
				$product->addMedia($file)->toMediaCollection('thumb');

			}
		}
		
       	if ($request->has('categories')) {
            $product->categories()->sync($request->input('categories'));
        } else {
            $product->categories()->detach();
        }

        $product->update($data);

        return redirect()->route('admin.products.edit',['product' => $product->id])
            ->with('message', 'Update successful');
	}



	public function edit(Product $product)
	{
		$categories = ProductCategory::whereIsRoot()->get();
		return view('admin.products.edit',compact('product','categories'));
	}

    public function create()
    {
    	
    	$availableSizes = Size::all();
    	$categories = ProductCategory::whereIsRoot()->get();
    	return view ('admin.products.create',compact('availableSizes','categories'));
    }

    public function index()
    {	
    	$products = Product::latest()->paginate(15);
    	return view ('admin.products.index',compact('products'));
    }

    public function destroy(Product $product)
    {
    	$product->delete();

        return redirect()->route('admin.products.index')
            ->with('message', 'Update successful');

    }
}
