@extends('layouts.front-master')


@section('content')

<div class="container">
    <nav class="toolbox">
        <div class="toolbox-left">
            <div class="toolbox-item toolbox-sort">
                <div class="select-custom">
                    <select name="orderby" class="form-control">
                        <option value="menu_order" selected="selected">Default sorting</option>
                        <option value="popularity">Sort by popularity</option>
                        <option value="rating">Sort by average rating</option>
                        <option value="date">Sort by newness</option>
                        <option value="price">Sort by price: low to high</option>
                        <option value="price-desc">Sort by price: high to low</option>
                    </select>
                </div><!-- End .select-custom -->

                <a href="#" class="sorter-btn" title="Set Ascending Direction"><span class="sr-only">Set Ascending Direction</span></a>
            </div><!-- End .toolbox-item -->
        </div><!-- End .toolbox-left -->

        <div class="toolbox-item toolbox-show">
                <label>Showing 1–9 of 60 results</label>
            </div><!-- End .toolbox-item -->

        <div class="layout-modes">
            <a href="category.html" class="layout-btn btn-grid active" title="Grid">
                <i class="icon-mode-grid"></i>
            </a>
            <a href="category-list.html" class="layout-btn btn-list" title="List">
                <i class="icon-mode-list"></i>
            </a>
        </div><!-- End .layout-modes -->
    </nav>

    <div class="row row-sm">
    	@foreach($products as $product)
        <div class="col-6 col-md-4 col-lg-3 col-xl-5col">
            <div class="product-default">
                <figure>
                    <a href="{{$product->path()}}">
                        <img src="{{$product->coverImagePath()}}">
                    </a>
                </figure>
                <div class="product-details">
                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                        </div><!-- End .product-ratings -->
                    </div><!-- End .product-container -->
                    <h2 class="product-title">
                        <a href="product.html">{{$product->name}}</a>
                    </h2>
                    <div class="price-box">
                        <span class="product-price">${{$product->price}}</span>
                    </div><!-- End .price-box -->
                    <div class="product-action">
                        <button class="btn-icon btn-add-cart" data-toggle="modal" data-target="#addCartModal"><i class="icon-bag"></i>ADD TO CART</button> 
                    </div>
                </div><!-- End .product-details -->
            </div>
        </div><!-- End .col-xl-3 -->
        @endforeach
    </div>

    <nav class="toolbox toolbox-pagination">
        <div class="toolbox-item toolbox-show">
            <label>Showing 1–9 of 60 results</label>
        </div><!-- End .toolbox-item -->

        <ul class="pagination">
            <li class="page-item disabled">
                <a class="page-link page-link-btn" href="#"><i class="icon-angle-left"></i></a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
            </li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><span>...</span></li>
            <li class="page-item"><a class="page-link" href="#">15</a></li>
            <li class="page-item">
                <a class="page-link page-link-btn" href="#"><i class="icon-angle-right"></i></a>
            </li>
        </ul>
    </nav>
</div><!-- End .container -->

@endsection