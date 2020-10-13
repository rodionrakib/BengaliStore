<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function shipping()
    {
    	if(Cart::count() == 0 )
    	{
    		return redirect()->route('home');
    	}

    	$cartItems = Cart::content();
    	$itemCount = Cart::count();

    	return view('front.checkout.shipping',compact('cartItems','itemCount'));

    }


    // store shipping data to session for further user 
    public function shippingStore(Request $request)
    {
        // validate data 
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'zip' => 'required',
        ]);
        // put shipping address in session 
        $request->session()->put('shipping',$request->only(['name','mobile','address','zip']));
        // redirect to next payment step

        return redirect()->route('checkout.payment');


    }


    public function payment(Request $request)
    {
        if(!$request->session()->has('shipping'))
        {
            return redirect()->route('checkout.shipping');

        }

        return view('front.checkout.payment');
    }
}
