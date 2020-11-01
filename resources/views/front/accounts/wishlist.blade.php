@extends('layouts.front-master')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">
            <h2>Wishlist</h2>
            
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
                                
                                
                                <td>  
                                       
                                
                                <form action="{{route('wishlist.destroy',['product'=> $product->id])}}" method="post" class="form-horizontal">
                                @csrf
                                @method('DELETE')
                                <div class="btn-group">
                                    
                                    <button 
                                     
                                     type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Remove</button>
                                </div>
                                </form>
                                

                                </td>
                                 
                            </tr>  
                         

                          
                        @endforeach
                           
                        </tbody>

                    </table>
                </div><!-- End .cart-table-container -->

               
        </div><!-- End .col-lg-9 -->

       @include('front.include.account-sidebar')
    </div><!-- End .row -->
</div><!-- End .container -->
@endsection