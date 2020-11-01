
@extends('layouts.front-master')


@section('content')

@if($products->count() > 0 )
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                                        
                            @foreach($products as $product)
                           

                                <tr class="product-row" data-row = "{{$product->id}}" >
                                    <td class="product-col">
                                        <figure class="product-image-container">
                                            <a href="{{$product->path()}}" class="product-image">
                                                <img src="{{$product->coverImagePath()}}" alt="product">
                                            </a>
                                        </figure>
                                        <h2 class="product-title">
                                            <a href="product.html">{{$product->name}}</a>
                                        </h2>
                                    </td>
                                    <td>TK {{$product->price}}</td>
                                    
                                    {{-- <td>{{$item->options->has('size') ? $item->options->size : ''}}</td> --}}
                                    
                                    <td>  
                                           
                                    
                                    
                                    

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

            
        </div><!-- End .row -->
    </div><!-- End .container -->
@else
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-warning">No products in wishlist yet. <a href="{{ route('home') }}">Shop now!</a></p>
            </div>
        </div>
    </div>
@endif
@endsection