
@extends('layouts.front-master')


@section('content')

@if($cartItems->count() > 0 )
    <div class="container">
        <div class="row">

            <div class="col-lg-8">
                <span id="status"></span>
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
                           

                               @include('front.include.cart_item')
                             

                              
                            @endforeach
                           
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="4" class="clearfix">
                                    {{-- <div class="float-left">
                                        <a href="{{route('home')}}" class="btn btn-outline-secondary">Continue Shopping</a>
                                    </div> --}}
                                    <div class="float-right">
                                        <a href="{{route('cart.empty')}}" class="btn btn-outline-secondary btn-clear-cart">Clear Shopping Cart</a>
                                        <a href="{{route('home')}}" class="btn btn-outline-secondary btn-update-cart">Continue Shopping</a>
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

            <div class="col-lg-4" id="cart_summary">
               @include('front.include.cart_summary')
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

@section('script')

    <script type="text/javascript">
        
        // Cart Update 

         $(".cart-update").click(function (e) {
            e.preventDefault();

            var ele = $(this);
            ele.siblings('.btn-loading').show();
            quantity = ele.closest('tr').find('.vertical-quantity').first().val()

            $.ajax({
                url: '/cart/'+ ele.data('rowid'),
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity
                },
                dataType: "json",
                success: function (response) {

                    ele.siblings('.btn-loading').hide();

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                    $("#header-bar").html(response.cartdata);
                    $("#cart_summary").html(response.cartsummary);
                    td  = ele.closest('td').siblings('.subtitla');
                    console.log(response);
                    td.text('TK '+response.subtotal);
                    // alert(response.subtotal);
                }
            });
        });
    </script>
@endsection