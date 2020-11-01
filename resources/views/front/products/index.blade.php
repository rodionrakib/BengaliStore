@extends('layouts.front-master')


@section('content')

<div class="container">
    <span id="status"></span>
    <div class="row">
        <div class="col-lg-9 offset-lg-3">
            <div class="home-slider owl-carousel owl-carousel-lazy owl-theme">
                <div class="home-slide">
                    <div class="owl-lazy slide-bg" src="assets/images/slider/slide-1.jpg" data-src="assets/images/slider/slide-1.jpg"></div>
                    <a href="category.html">
                    </a>
                </div><!-- End .home-slide -->

                <div class="home-slide">
                    <div class="owl-lazy slide-bg" src="assets/images/slider/slide-2.jpg" data-src="assets/images/slider/slide-2.jpg"></div>
                    <a href="category.html">
                    </a>
                </div><!-- End .home-slide -->
            </div><!-- End .home-slider -->
        </div><!-- End .col-lg-9 -->
    </div><!-- End .row -->

    <div class="info-boxes-container">
        <div class="container-fluid">
            <div class="info-box">
                <i class="icon-shipping"></i>

                <div class="info-box-content">
                    <h4>FREE SHIPPING & RETURN</h4>
                    <p>Free shipping on all orders over $99.</p>
                </div><!-- End .info-box-content -->
            </div><!-- End .info-box -->

            <div class="info-box">
                <i class="icon-us-dollar"></i>

                <div class="info-box-content">
                    <h4>MONEY BACK GUARANTEE</h4>
                    <p>100% money back guarantee</p>
                </div><!-- End .info-box-content -->
            </div><!-- End .info-box -->

            <div class="info-box">
                <i class="icon-support"></i>

                <div class="info-box-content">
                    <h4>ONLINE SUPPORT 24/7</h4>
                    <p>Lorem ipsum dolor sit amet.</p>
                </div><!-- End .info-box-content -->
            </div><!-- End .info-box -->
        </div><!-- End .container-fluid -->
    </div><!-- End .info-boxes-container -->
    
    <h2 class="title text-center">Featured Products</h2>
    <div class="row justify-content-center">
        @foreach($featuredProducts as $fp)
            <div class="col-6 col-md-4 col-lg-3">
                @include('front.include.product_thumb',['product' => $fp])
            </div><!-- End .col-lg-3 -->
        @endforeach
    </div><!-- End .row -->
    <div class="mb-3"></div><!-- margin -->

    <h2 class="title text-center">Popular {{$womanCategory->name}}</h2>

    <div class="products-carousel owl-carousel owl-theme owl-nav-top">
        @foreach($popularWomen as $product)
         @include('front.include.product_thumb',['category' => $womanCategory])
        @endforeach
     
    </div><!-- End .featured-proucts -->


    <div class="mb-6"></div><!-- margin -->


    <h2 class="title text-center">Popular {{$menCategory->name}}</h2>

    <div class="products-carousel owl-carousel owl-theme owl-nav-top">
        @foreach($popularMen as $product)
        @include('front.include.product_thumb',['category' => $menCategory])
        @endforeach
     
    </div><!-- End .featured-proucts -->
    

    <div class="mb-6"></div><!-- margin -->
</div><!-- End .container -->

@endsection

@section('script')

    <script type="text/javascript">
        $(".add-to-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            ele.siblings('.btn-loading').show();

            $.ajax({
                url: '{{ route('cart.store') }}',
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id")
                },
                dataType: "json",
                success: function (response) {

                    ele.siblings('.btn-loading').hide();

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                    $("#header-bar").html(response.data);
                }
            });
        });


        // WISHLIST 

         $(".add-to-wishlist").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            ele.siblings('.btn-loading').show();

            $.ajax({
                url: '{{ route('wishlist.store') }}',
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-productid")
                },
                dataType: "json",
                success: function (response) {

                    ele.siblings('.btn-loading').hide();

                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                    // $("#header-bar").html(response.data);
                }
            });
        });
    </script>

@endsection