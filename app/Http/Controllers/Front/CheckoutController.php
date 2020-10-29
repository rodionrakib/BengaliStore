<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $isCartEmpty = Cart::count() == 0 ;

        $customer = auth()->user();
        $billingAddress = $customer->addresses()->first();
        $addresses = $customer->addresses()->get();
        $products = Cart::content();
        $subtotal = Cart::subtotal();
        $tax = Cart::tax();
       

        // $cartItems = $this->getCartItemsTransformed();
        $paymentGateways = collect(['Bkash','Cash On Delevery']);

         return view('front.checkout.index', [
            'customer' => $customer,
            'billingAddress' => $billingAddress,
            'addresses' => $addresses,
            'products' => $products,
            'subtotal' => $subtotal,
            'tax' => Cart::tax(),
            'total' => Cart::totalFloat(),
            'cartItems' => Cart::content(),
            'payments' => $paymentGateways,

        ]);
        
    }

    /**
     * @return Collection
     */
    public function getCartItemsTransformed($cartItems) : Collection
    {
        return $cartItems->map(function ($item) {
            $productRepo = new ProductRepository(new Product());
            $product = $productRepo->findProductById($item->id);
            $item->product = $product;
            $item->cover = $product->cover;
            $item->description = $product->description;
            return $item;
        });
    }
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
