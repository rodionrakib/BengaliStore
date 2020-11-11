 <div class="order-summary">
                <h3>Summary</h3>

                <h4>
                    <a data-toggle="collapse" href="#order-cart-section" class="collapsed" role="button" aria-expanded="false" aria-controls="order-cart-section"> {{ \Gloudemans\Shoppingcart\Facades\Cart::count() }}  {{  

                        Illuminate\Support\Str::plural( 'product',\Gloudemans\Shoppingcart\Facades\Cart::count() )  
                    }}  in Cart</a>
                </h4>

                <div class="collapse" id="order-cart-section">
                    <table class="table table-mini-cart">
                        <tbody>
                            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $item) 
                            <tr>
                                <td class="product-col">
                                    <figure class="product-image-container">
                                        <a href="{{$item->model->path()}}" class="product-image">
                                            <img src="{{$item->model->coverImagePath()}}" alt="product">
                                        </a>
                                    </figure>
                                    <div>
                                        <h2 class="product-title">
                                            <a href="{{$item->model->path()}}">{{$item->name}}</a>
                                        </h2>

                                        <span class="product-qty">Qty: {{$item->qty}}</span>
                                    </div>
                                </td>
                                <td class="price-col">TK{{$item->price}}</td>
                            </tr>
                            @endforeach

                           
                        </tbody>    
                    </table>
                </div><!-- End #order-cart-section -->
            </div><!-- End .order-summary -->