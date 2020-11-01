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
		$cartItems = Cart::content();
        $total = Cart::total();
        $subTotal = Cart::subtotal();
		return view('front.cart.index',compact('cartItems','total','subTotal'));
	}

    public function store(Request $request)
    {

    	Cart::add(Product::findOrFail($request->id),$request->quantity);

        $htmlCart = view('front.include.header_cart')->render();

        return response()->json(['msg' => 'Product added to cart successfully!', 'data' => $htmlCart]);


        // return redirect()->route('cart.index')->with('message', 'Add to cart successful');
    }

    public function update(Request $request,$rowId)
    {

        Cart::update($rowId,$request->quantity);
        $htmlCart = view('front.include.header_cart')->render();
        $htmlCartSummary = view('front.include.cart_summary')->render();
        $item  = Cart::get($rowId);
        return response()->json([
            'msg' => 'Cart updated!',
            'cartdata' => $htmlCart,
            'cartsummary' => $htmlCartSummary,
            'subtotal' => $item->price * $item->qty,
        ]);
    }

    public function empty()
    {
        Cart::destroy();
        return redirect()->route('cart.index');

    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('cart.index')->with('message', 'Removed to cart successful');

    }

    public function showLoginForm()
    {
        return view('front.cart.login');
    }
}
