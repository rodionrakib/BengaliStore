@extends('layouts.front-master')


@section('content')
@if($products->count() > 0 )
<div class="container">
    <div class="row">
        <div class="col-lg-9 order-lg-last dashboard-content">
            <span id="status"></span>
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
                                       
                                
                               {{--  <form action="{{route('wishlist.destroy',['product'=> $product->id])}}" method="post" class="form-horizontal">
                                @csrf
                                @method('DELETE') --}}
                                <div class="btn-group">
                                    
                                    <button 
                                    class="btn btn-danger btn-sm remove-to-wishlist"  
                                    data-productid = {{$product->id}}
                                    ><i class="fa fa-times"></i> Remove</button>
                                </div>
                                
                                

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


@section('script')

    <script type="text/javascript">
        // WISHLIST  Remove
  $(".remove-to-wishlist").click(function (e) {
            e.preventDefault();

            var ele = $(this);
            ele.siblings('.btn-loading').show();
            var productId = ele.data('productid') ;
           

            $.ajax({
                url: "/customer/wishlists/"+ele.data('productid'),
                method: "delete",
                data: {
                    _token: '{{ csrf_token() }}',
                },
                dataType: "json",
                success: function (response) {
                    
                    ele.closest('tr').hide();
                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                }
            });
        });
    </script>

@endsection