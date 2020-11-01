<a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
    <span class="cart-count">{{\Gloudemans\Shoppingcart\Facades\Cart::count()}}</span>
</a>

<div class="dropdown-menu" >
    <div class="dropdownmenu-wrapper">
        <div class="dropdown-cart-products">
            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $cartItem )
            <div class="product">
                <div class="product-details">
                    <h4 class="product-title">
                        <a href="{{$cartItem->model->path()}}">{{$cartItem->name}}</a>
                    </h4>

                    <span class="cart-product-info">
                        <span class="cart-product-qty">{{$cartItem->qty}}</span>
                        x ${{$cartItem->price}}
                    </span>
                </div><!-- End .product-details -->

                <figure class="product-image-container">
                    <a href="product.html" class="product-image">
                        <img src="{{$cartItem->model->coverImagePath()}}" alt="product">
                    </a>
                    <a href="#" class="btn-remove" title="Remove Product"><i class="icon-cancel"></i></a>
                </figure>
            </div><!-- End .product -->
            @endforeach

            
            
        </div><!-- End .cart-product -->

        <div class="dropdown-cart-total">
            <span>Total</span>

            <span class="cart-total-price">${{\Gloudemans\Shoppingcart\Facades\Cart::total()}}</span>
        </div><!-- End .dropdown-cart-total -->

        <div class="dropdown-cart-action">
            <a href="{{route('cart.index')}}" class="btn">View Cart</a>
            @if(auth()->check())

            <a class="btn" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>    
            @endif
            {{-- <a href="checkout-shipping.html" class="btn">Checkout</a> --}}
        </div><!-- End .dropdown-cart-total -->
    </div><!-- End .dropdownmenu-wrapper -->
</div><!-- End .dropdown-menu -->
