@extends('layouts.front-master')


@section('content')

<div class="container">
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
                <div class="product-default left-details mb-4">
                    <figure>
                        <a href="{{$fp->path()}}">
                            <img src="{{$fp->coverImagePath()}}">
                        </a>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="{{route('front.categories.show',['slug' => $fp->categories()->first()->slug])}}" class="product-category">{{$fp->categories()->first()->name}}</a>
                        </div>
                        <h2 class="product-title">
                            <a href="product.html">{{$fp->title}}</a>
                        </h2>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:0%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <span class="product-price">Tk {{$fp->price}}</span>
                        </div><!-- End .price-box -->
                        <div class="product-action">
                            <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>ADD TO CART</button>
                            {{-- <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a> --}}
                            {{-- <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>  --}}
                        </div>
                    </div><!-- End .product-details -->
                </div>
            </div><!-- End .col-lg-3 -->
        @endforeach
    </div><!-- End .row -->
    <div class="mb-3"></div><!-- margin -->

    <h2 class="title text-center">Popular {{$cat1->name}}</h2>

    <div class="products-carousel owl-carousel owl-theme owl-nav-top">
        @foreach($cat1->products as $product)
        <div class="product-default left-details mb-4">
            <figure>
                <a href="{{$product->path()}}">
                    <img src="{{$product->coverImagePath()}}">
                </a>
            </figure>
            <div class="product-details">
                <div class="category-list">
                    <a href="{{route('front.categories.show',['slug' => $cat1->slug])}}" class="product-category">{{$cat1->name}}</a>
                </div>
                <h2 class="product-title">
                    <a href="{{$product->path()}}">{{$product->name}}</a>
                </h2>
                <div class="ratings-container">
                    <div class="product-ratings">
                        <span class="ratings" style="width:0%"></span><!-- End .ratings -->
                        <span class="tooltiptext tooltip-top"></span>
                    </div><!-- End .product-ratings -->
                </div><!-- End .product-container -->
                <div class="price-box">
                    <span class="product-price">${{$product->price}}</span>
                </div><!-- End .price-box -->
                <div class="product-action">
                    <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>ADD TO CART</button>
                    <a href="#" class="btn-icon-wish"><i class="icon-heart"></i></a>
                    <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                </div>
            </div><!-- End .product-details -->
        </div>
        @endforeach
     
    </div><!-- End .featured-proucts -->

    <div class="mb-6"></div><!-- margin -->
</div><!-- End .container -->

@endsection