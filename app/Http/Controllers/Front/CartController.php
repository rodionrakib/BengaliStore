<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{

	public function index()
	{
		$items = Cart::content();
        $total = Cart::total();
        $subTotal = Cart::subtotal();
		return view('front.cart.index',compact('items','total','subTotal'));
	}
    public function store(Request $request)
    {

    	$product = Product::findOrFail($request->id);

    	Cart::add($product->id, $product->name, $request->quantity,$product->price, 0, ['size' => $request->size])->associate(Product::class);
    	
        return redirect()->route('cart.index')->with('message', 'Add to cart successful');
    }

    public function empty()
    {
        Cart::destroy();
        return redirect()->route('cart.index');

    }

    public function destroy($id)
    {
        Cart::remove($id);
        return redirect()->route('cart.index');

    }
}
