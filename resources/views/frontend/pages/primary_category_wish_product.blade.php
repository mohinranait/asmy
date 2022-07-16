@extends('frontend.layout.template')
@section('title')
    <title>Asmy BD - Soop</title>
    <meta name="keywords" content="Shop">
    <meta name="description" content="asmy BD Shop page">
@endsection

@section('content')


        <main class="main">
            
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Grid 3 Columns</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="toolbox">
                                <div class="toolbox-left">
                                    <div class="toolbox-info">
                                        Showing <span>9 of 56</span> Products
                                    </div><!-- End .toolbox-info -->
                                </div><!-- End .toolbox-left -->

                                <div class="toolbox-right">
                                    <div class="toolbox-sort">
                                        <label for="sortby">Sort by:</label>
                                        <div class="select-custom">
                                            <select name="sortby" id="sortby" class="form-control">
                                                <option value="popularity" selected="selected">Most Popular</option>
                                                <option value="rating">Most Rated</option>
                                                <option value="date">Date</option>
                                            </select>
                                        </div>
                                    </div><!-- End .toolbox-sort -->
                                    <div class="toolbox-layout">
                                        

                                        <a href="category.html" class="btn-layout active">
                                            <svg width="16" height="10">
                                                <rect x="0" y="0" width="4" height="4" />
                                                <rect x="6" y="0" width="4" height="4" />
                                                <rect x="12" y="0" width="4" height="4" />
                                                <rect x="0" y="6" width="4" height="4" />
                                                <rect x="6" y="6" width="4" height="4" />
                                                <rect x="12" y="6" width="4" height="4" />
                                            </svg>
                                        </a>

                                        <a href="{{route('shop.two')}}" class="btn-layout">
                                            <svg width="22" height="10">
                                                <rect x="0" y="0" width="4" height="4" />
                                                <rect x="6" y="0" width="4" height="4" />
                                                <rect x="12" y="0" width="4" height="4" />
                                                <rect x="18" y="0" width="4" height="4" />
                                                <rect x="0" y="6" width="4" height="4" />
                                                <rect x="6" y="6" width="4" height="4" />
                                                <rect x="12" y="6" width="4" height="4" />
                                                <rect x="18" y="6" width="4" height="4" />
                                            </svg>
                                        </a>
                                    </div><!-- End .toolbox-layout -->
                                </div><!-- End .toolbox-right -->
                            </div><!-- End .toolbox -->

                            <div class="products mb-3">
                                <div class="row justify-content-center fatch-product">

                                    @foreach( $products as $product)
                                    <div class="col-6 col-md-4 col-lg-4">
                                        <div class="product product-7 text-center">
                                            <figure class="product-media">
                                                @php
                                                    $offer = $product->regular_price - $product->offer_price;
                                                    $present = ($offer / $product->regular_price) * 100;
                                                @endphp
                                                @if( $product->offer_price)
                                                <span class="product-label label-sale">{{$present}} % </span>
                                                @endif
                                                <a href="{{ route('products' , $product->slug)}}">
                                                    <img src="{{asset('image/'.$product->main_image)}}" alt="Product image" class="product-image">
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
                                                    <a href="{{route('sub.category.wish.product' , $product->subCategorys->slug)}}"> {{$product->subCategorys->name}} </a>
                                                </div><!-- End .product-cat -->
                                                <h3 class="product-title"><a href="{{ route('products' , $product->slug)}}">{{$product->name}}</a></h3><!-- End .product-title -->
                                                <div class="product-price">
                                                    $60.00
                                                </div><!-- End .product-price -->
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                                    </div><!-- End .ratings -->
                                                    <span class="ratings-text">( 2 Reviews )</span>
                                                </div><!-- End .rating-container -->

                                            </div><!-- End .product-body -->
                                        </div><!-- End .product -->
                                    </div><!-- End .col-sm-6 col-lg-4 -->
                                    @endforeach

                                 
                                </div><!-- End .row -->
                            </div><!-- End .products -->

                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                {{ $products->links() }}
                                </ul>
                            </nav>
                        </div><!-- End .col-lg-9 -->
                        @include('frontend.inc.shop_left_bar')
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

@endsection