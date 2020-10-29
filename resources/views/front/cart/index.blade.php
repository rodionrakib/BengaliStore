
@extends('layouts.front-master')


@section('content')

@if($cartItems->count() > 0 )
    <div class="container">
        <div class="row">

            <div class="col-lg-8">
                @include('layouts.errors-and-messages')
                <div class="cart-table-container">
                    <table class="table table-cart">
                        <thead>
                            <tr>
                                <th class="product-col">Product</th>
                                <th class="price-col">Price</th>
                                <th class="qty-col">Qty</th>
                               {{--  <th class="qty-col">Size</th> --}}
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                                        
                            @foreach($cartItems as $item)
                           

                                <tr class="product-row" data-row = {{$item->rowId}}>
                                    <td class="product-col">
                                        <figure class="product-image-container">
                                            <a href="{{$item->model->path()}}" class="product-image">
                                                <img src="{{$item->model->coverImagePath()}}" alt="product">
                                            </a>
                                        </figure>
                                        <h2 class="product-title">
                                            <a href="product.html">{{$item->name}}</a>
                                        </h2>
                                    </td>
                                    <td>TK {{$item->price}}</td>
                                    <form action="{{ route('cart.update', $item->rowId) }}" class="form-inline" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <td>
                                        <input style="width: 60px" 

                                        class="form-control" type="number" id="quantity" name="quantity" min="1" value="{{$item->qty}}">
                                    </td>
                                    {{-- <td>{{$item->options->has('size') ? $item->options->size : ''}}</td> --}}
                                    
                                    <td>TK {{$item->total}}</td>
                                    <td>  
                                           
                                    <button  type="submit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Update</button>
                                    </form>

                                    <form method="POST" action="{{route('cart.destroy',$item->rowId)}}" >
                                        @csrf
                                        @method('DELETE')
                                        <button  type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i>Remove</button>
                                    </form>
                                    
                                    
                                    

                                    </td>
                                     
                                </tr>  
                             

                              
                            @endforeach
                           
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="4" class="clearfix">
                                    <div class="float-left">
                                        <a href="{{route('home')}}" class="btn btn-outline-secondary">Continue Shopping</a>
                                    </div><!-- End .float-left -->

                                    <div class="float-right">
                                        <a href="{{route('cart.empty')}}" class="btn btn-outline-secondary btn-clear-cart">Clear Shopping Cart</a>
                                        <a href="#" class="btn btn-outline-secondary btn-update-cart">Update Shopping Cart</a>
                                    </div><!-- End .float-right -->
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- End .cart-table-container -->

                <div class="cart-discount">
                    <h4>Apply Discount Code</h4>
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Enter discount code"  required>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="submit">Apply Discount</button>
                            </div>
                        </div><!-- End .input-group -->
                    </form>
                </div><!-- End .cart-discount -->
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>Summary</h3>

                    <h4>
                        <a data-toggle="collapse" href="#total-estimate-section" class="collapsed" role="button" aria-expanded="false" aria-controls="total-estimate-section">Estimate Shipping and Tax</a>
                    </h4>

                    <div class="collapse" id="total-estimate-section">
                        <form action="#">
                            <div class="form-group form-group-sm">
                                <label>Country</label>
                                <div class="select-custom">
                                    <select class="form-control form-control-sm">
                                        <option value="USA">United States</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="China">China</option>
                                        <option value="Germany">Germany</option>
                                    </select>
                                </div><!-- End .select-custom -->
                            </div><!-- End .form-group -->

                            <div class="form-group form-group-sm">
                                <label>State/Province</label>
                                <div class="select-custom">
                                    <select class="form-control form-control-sm">
                                        <option value="CA">California</option>
                                        <option value="TX">Texas</option>
                                    </select>
                                </div><!-- End .select-custom -->
                            </div><!-- End .form-group -->

                            <div class="form-group form-group-sm">
                                <label>Zip/Postal Code</label>
                                <input type="text" class="form-control form-control-sm">
                            </div><!-- End .form-group -->

                            <div class="form-group form-group-custom-control">
                                <label>Flat Way</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="flat-rate">
                                    <label class="custom-control-label" for="flat-rate">Fixed $5.00</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .form-group -->

                            <div class="form-group form-group-custom-control">
                                <label>Best Rate</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="best-rate">
                                    <label class="custom-control-label" for="best-rate">Table Rate $15.00</label>
                                </div><!-- End .custom-checkbox -->
                            </div><!-- End .form-group -->
                        </form>
                    </div><!-- End #total-estimate-section -->

                    <table class="table table-totals">
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td>{{$subTotal}}</td>
                            </tr>

                            <tr>
                                <td>Tax</td>
                                <td>$0.00</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Order Total</td>
                                <td>{{$total}}</td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="checkout-methods">
                        <a href="{{route('checkout.index')}}" class="btn btn-block btn-sm btn-primary">Go to Checkout</a>
                        <a href="#" class="btn btn-link btn-block">Check Out with Multiple Addresses</a>
                    </div><!-- End .checkout-methods -->
                </div><!-- End .cart-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
@else
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-warning">No products in cart yet. <a href="{{ route('home') }}">Shop now!</a></p>
            </div>
        </div>
    </div>
@endif
@endsection