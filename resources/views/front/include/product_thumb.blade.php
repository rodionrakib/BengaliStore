<div class="product-default left-details mb-4">
                    <figure>
                        <a href="{{$product->path()}}">
                            <img src="{{$product->coverImagePath()}}">
                        </a>
                    </figure>
                    <div class="product-details">
                        
                        @if(isset($category))
                           <div class="category-list">
                                <a href="{{$category->path()}}" class="product-category">{{$category->name}}</a>
                                </div>
                            @else
                            <div class="category-list">
                            <a href="{{ $product->categories()->first()->path()}}" class="product-category">{{$product->categories()->first()->name}}</a>
                            </div>
                        @endif
                        <h2 class="product-title">
                            <a href="product.html">{{$product->title}}</a>
                        </h2>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:0%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <span class="product-price">Tk {{$product->price}}</span>
                        </div><!-- End .price-box -->
                        <div class="product-action">
                            {{-- <form method="POST" action="{{route('cart.store')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$fp->id}}">
                                <input type="hidden" name="quantity" value="1">
                                <button class="btn-icon btn-add-cart" type="submit" ><i class="icon-bag"></i>ADD TO CART</button>
                            </form> --}}
                            <button class="btn-icon btn-add-cart add-to-cart" data-id="{{ $product->id }}"  ><i class="icon-bag"></i>ADD TO CART</button>
                            @if(auth()->check())
                            <a href="#" class="btn-icon-wish add-to-wishlist" data-productid={{ $product->id }} ><i class="icon-heart"></i></a>
                            @else
                            <a href="{{route('login')}}" class="btn-icon-wish"><i class="icon-heart"></i></a>
                            @endif
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a> 
                            {{-- <form method="POST" action="{{route('wishlist.store')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$fp->id}}">
                                <button type="submit" class="btn" ><i class="icon-bag"></i>ADD TO WISHLIST</button>
                            </form> --}}
                            
                        </div>
                    </div><!-- End .product-details -->
                </div>