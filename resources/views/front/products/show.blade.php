@extends('layouts.front-master')


@section('content')

@section('breadcrumb')
{!! $breadCrumb !!}
@endsection
<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <span id="status"></span>
            <div class="product-single-container product-single-default">
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="product-single-gallery">
                            <div class="product-slider-container product-item">
                                <div class="product-single-carousel owl-carousel owl-theme">

                                    @foreach($images as $image)
                                    <div class="product-item">
                                        <img class="product-single-image" src="{{$image->getFullUrl()}}" data-zoom-image="{{$image->getFullUrl()}}"/>
                                    </div>
                                    @endforeach
                                   {{--  <div class="product-item">
                                        <img class="product-single-image" src="assets/images/products/zoom/product-1.jpg" data-zoom-image="assets/images/products/zoom/product-1-big.jpg"/>
                                    </div> --}}
                                    
                                </div>
                                <!-- End .product-single-carousel -->
                                <span class="prod-full-screen">
                                    <i class="icon-plus"></i>
                                </span>
                            </div>
                            <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
                                @foreach($images as $image)
                                <div class="col-3 owl-dot">
                                    <img src="{{$image->getFullUrl()}}"/>
                                </div>
                                @endforeach
                                
                            </div>
                        </div><!-- End .product-single-gallery -->
                    </div><!-- End .col-lg-7 -->

                    <div class="col-lg-5 col-md-6">
                        <div class="product-single-details">
                            <h1 class="product-title">{{$product->name}}</h1>

                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                                </div><!-- End .product-ratings -->

                                <a href="#" class="rating-link">( 6 Reviews )</a>
                            </div><!-- End .product-container -->

                            <div class="price-box">
                                {{-- <span class="old-price">$81.00</span> --}}
                                <span class="product-price">Tk {{$product->price}}</span>
                            </div><!-- End .price-box -->

                            <div class="product-desc">
                                <p>{{$product->short_description}}</p>
                            </div><!-- End .product-desc -->
                            <form method="POST" action="{{route('cart.store')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}">
                                
                                <div class="product-action">
                                    <div class="product-single-qty">
                                        <input class="horizontal-quantity form-control" id="quantity" name="quantity" type="text">
                                    </div><!-- End .product-single-qty -->


                                    <button data-id = "{{$product->id}}" class="paction add-cart" id="add-cart-btn" title="Add to Cart">
                                        <span>Add to Cart</span>
                                    </button>
                                    
                                    <a href="#" class="paction add-wishlist" title="Add to Wishlist">
                                        <span>Add to Wishlist</span>
                                    </a>
                                </div><!-- End .product-action -->

                                <div class="product-single-share">
                                    <label>Share:</label>
                                    <!-- www.addthis.com share plugin-->
                                    <div class="addthis_inline_share_toolbox"></div>
                                </div><!-- End .product single-share -->
                            </form>
                        </div><!-- End .product-single-details -->
                    </div><!-- End .col-lg-5 -->
                </div><!-- End .row -->
            </div><!-- End .product-single-container -->

            <div class="product-single-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-desc" data-toggle="tab" href="#product-desc-content" role="tab" aria-controls="product-desc-content" aria-selected="false">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="product-tab-size" data-toggle="tab" href="#product-size-content" role="tab" aria-controls="product-size-content" aria-selected="true">Size Guide</a>
                    </li>
                  
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade" id="product-desc-content" role="tabpanel" aria-labelledby="product-tab-desc">
                        <div class="product-desc-content">
                            {{$product->long_description}}
                        </div><!-- End .product-desc-content -->
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade show active" id="product-size-content" role="tabpanel" aria-labelledby="product-tab-size">
                        <div class="product-size-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="assets/images/products/single/body-shape.png" alt="body shape">
                                </div><!-- End .col-md-4 -->

                                <div class="col-md-8">
                                    <table class="table table-size">
                                        <thead>
                                            <tr>
                                                <th>SIZE</th>
                                                <th>CHEST (in.)</th>
                                                <th>WAIST (in.)</th>
                                                <th>HIPS (in.)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>XS</td>
                                                <td>34-36</td>
                                                <td>27-29</td>
                                                <td>34.5-36.5</td>
                                            </tr>
                                            <tr>
                                                <td>S</td>
                                                <td>36-38</td>
                                                <td>29-31</td>
                                                <td>36.5-38.5</td>
                                            </tr>
                                            <tr>
                                                <td>M</td>
                                                <td>38-40</td>
                                                <td>31-33</td>
                                                <td>38.5-40.5</td>
                                            </tr>
                                            <tr>
                                                <td>L</td>
                                                <td>40-42</td>
                                                <td>33-36</td>
                                                <td>40.5-43.5</td>
                                            </tr>
                                            <tr>
                                                <td>XL</td>
                                                <td>42-45</td>
                                                <td>36-40</td>
                                                <td>43.5-47.5</td>
                                            </tr>
                                            <tr>
                                                <td>XLL</td>
                                                <td>45-48</td>
                                                <td>40-44</td>
                                                <td>47.5-51.5</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- End .row -->
                        </div><!-- End .product-size-content -->
                    </div><!-- End .tab-pane -->

                    
                </div><!-- End .tab-content -->
            </div><!-- End .product-single-tabs -->
        </div><!-- End .col-lg-9 -->

        <div class="sidebar-overlay"></div>
        <div class="sidebar-toggle"><i class="icon-sliders"></i></div>
        <aside class="sidebar-product col-lg-3 padding-left-lg mobile-sidebar">
            <div class="sidebar-wrapper">
                <div class="widget widget-collapse">
                    <h3 class="widget-title">
                        <a data-toggle="collapse" href="{{$product->getRootCategory()->path()}}" role="button" aria-expanded="true" aria-controls="widget-body-1">{{$product->getRootCategory()->name}}</a>
                    </h3>

                    <div class="collapse show" id="widget-body-1">
                        <div class="widget-body">
                            <ul class="cat-list">
                                @foreach($product->getRootCategory()->children as $category)
                                <li><a href="{{$category->path()}}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- End .widget-body -->
                    </div><!-- End .collapse -->
                </div><!-- End .widget -->

                <div class="widget widget-banner">
                    <div class="banner banner-image">
                        <a href="#">
                            <img src="assets/images/banners/banner-sidebar.jpg" alt="Banner Desc">
                        </a>
                    </div><!-- End .banner -->
                </div><!-- End .widget -->

                <div class="widget widget-featured">
                    <h3 class="widget-title">Featured Products</h3>
                    
                    <div class="widget-body">
                        <div class="owl-carousel widget-featured-products">
                            <div class="featured-col">
                                <div class="product-default left-details product-widget">
                                    <figure>
                                        <a href="product.html">
                                            <img src="assets/images/products/small/product-1.jpg">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="product.html">Product Short Name</a>
                                        </h2>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">$49.00</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                                <div class="product-default left-details product-widget">
                                    <figure>
                                        <a href="product.html">
                                            <img src="assets/images/products/small/product-2.jpg">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="product.html">Product Short Name</a>
                                        </h2>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">$49.00</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                                <div class="product-default left-details product-widget">
                                    <figure>
                                        <a href="product.html">
                                            <img src="assets/images/products/small/product-3.jpg">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="product.html">Product Short Name</a>
                                        </h2>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">$49.00</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            </div><!-- End .featured-col -->

                            <div class="featured-col">
                                <div class="product-default left-details product-widget">
                                    <figure>
                                        <a href="product.html">
                                            <img src="assets/images/products/small/product-4.jpg">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="product.html">Product Short Name</a>
                                        </h2>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">$49.00</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                                <div class="product-default left-details product-widget">
                                    <figure>
                                        <a href="product.html">
                                            <img src="assets/images/products/small/product-5.jpg">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="product.html">Product Short Name</a>
                                        </h2>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">$49.00</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                                <div class="product-default left-details product-widget">
                                    <figure>
                                        <a href="product.html">
                                            <img src="assets/images/products/small/product-6.jpg">
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h2 class="product-title">
                                            <a href="product.html">Product Short Name</a>
                                        </h2>
                                        <div class="ratings-container">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            <span class="product-price">$49.00</span>
                                        </div><!-- End .price-box -->
                                    </div><!-- End .product-details -->
                                </div>
                            </div><!-- End .featured-col -->
                        </div><!-- End .widget-featured-slider -->
                    </div><!-- End .widget-body -->
                </div><!-- End .widget -->
            </div>
        </aside><!-- End .col-md-3 -->
    </div><!-- End .row -->

    <div class="featured-section pt-sm bg-white">
        <h2 class="carousel-title">Featured Products</h2>
        
            <div class="featured-products owl-carousel owl-theme owl-dots-top">
                <div class="product-default left-details mb-4">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/product-1.jpg">
                        </a>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="category.html" class="product-category">category</a>
                        </div>
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:0%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <span class="product-price">$88.00</span>
                        </div><!-- End .price-box -->
                        <div class="product-action">
                            <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>ADD TO CART</button>
                            <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                        </div>
                    </div><!-- End .product-details -->
                </div>
                <div class="product-default left-details mb-4">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/product-2.jpg">
                        </a>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="category.html" class="product-category">category</a>
                        </div>
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:0%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <span class="product-price">$88.00</span>
                        </div><!-- End .price-box -->
                        <div class="product-action">
                            <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>ADD TO CART</button>
                            <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                        </div>
                    </div><!-- End .product-details -->
                </div>
                <div class="product-default left-details mb-4">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/product-3.jpg">
                        </a>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="category.html" class="product-category">category</a>
                        </div>
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:0%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <span class="product-price">$88.00</span>
                        </div><!-- End .price-box -->
                        <div class="product-action">
                            <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>ADD TO CART</button>
                            <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                        </div>
                    </div><!-- End .product-details -->
                </div>
                <div class="product-default left-details mb-4">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/product-4.jpg">
                        </a>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="category.html" class="product-category">category</a>
                        </div>
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:0%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <span class="product-price">$88.00</span>
                        </div><!-- End .price-box -->
                        <div class="product-action">
                            <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>ADD TO CART</button>
                            <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                        </div>
                    </div><!-- End .product-details -->
                </div>
                <div class="product-default left-details mb-4">
                    <figure>
                        <a href="product.html">
                            <img src="assets/images/products/product-5.jpg">
                        </a>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="category.html" class="product-category">category</a>
                        </div>
                        <h2 class="product-title">
                            <a href="product.html">Product Short Name</a>
                        </h2>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:0%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <span class="product-price">$88.00</span>
                        </div><!-- End .price-box -->
                        <div class="product-action">
                            <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>ADD TO CART</button>
                            <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                        </div>
                    </div><!-- End .product-details -->
                </div>
            </div><!-- End .featured-proucts -->
    </div><!-- End .featured-section -->

    <div class="mb-lg-4"></div><!-- margin -->
</div><!-- End .container -->

@endsection


@section('script')

    <script type="text/javascript">
        $("#add-cart-btn").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            ele.siblings('.btn-loading').show();

            $.ajax({
                url: '{{ route('cart.store') }}',
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.attr("data-id"),
                    quantity: $('#quantity').val()
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