                             
                            @foreach( $products as $product)
                            <div class="col-6 col-md-4 col-lg-4">
                                <div class="product">
                                    <figure class="product-media">
                                            @php
                                                $offer = $product->regular_price - $product->offer_price;
                                                $present = ($offer / $product->regular_price) * 100;
                                            @endphp
                                            @if( $product->offer_price)
                                            <span class="product-label label-sale">{{$present}} % </span>
                                            @endif
                                        <a href="{{ route('products' , $product->slug)}}">
                                            <img src="{{asset('image/' . $product->main_image)}}" alt="Product image" class="product-image">
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                           
                                        </div><!-- End .product-action-vertical -->

                                        <form action="{{route('added.to.cart')}}" method="POST" >
                                            @csrf 
                                            <div class="product-action">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                @if( Auth::check())
                                                <input type="hidden" name="user_id"  value="{{ Auth::user()->id }}">
                                                @endif
                                                <button type="submit" class="btn-product btn-cart" style="background:#39f; color:white" title="Add to cart"><span class="text-white">add to cart</span></button>
                                            </div><!-- End .product-action -->
                                        </form>
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">Furniture</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('products' , $product->slug)}}">{{$product->name}}</a></h3><!-- End .product-title -->
                                        @if( $product->offer_price)
                                        <div class="product-price">
                                            <span class="new-price">৳ {{$product->offer_price}}</span>
                                            <span class="old-price">Was ৳ {{ $product->regular_price}}</span>
                                        </div><!-- End .product-price -->
                                        @else
                                        <div class="product-price">
                                            <span class="product-price">৳ {{$product->regular_price}}</span>
                                        </div><!-- End .product-price -->
                                        @endif
                                        

                                    </div><!-- End .product-body -->
                                </div>
                            </div><!-- End .col-sm-6 col-lg-4 -->
                            @endforeach