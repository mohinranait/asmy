@extends('frontend.layout.template')
@section('title')
    <title>Product page</title>
@endsection

@section('css')
<style>
    .galry-img{
        width:32%
    }
    .product-main-image{

    }
    .attribute{

    }
</style>
@endsection

@section('content')

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container d-flex align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
                    </ol>

                    <nav class="product-pager ml-auto" aria-label="Product">
                        <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                            <i class="icon-angle-left"></i>
                            <span>Prev</span>
                        </a>

                        <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                            <span>Next</span>
                            <i class="icon-angle-right"></i>
                        </a>
                    </nav><!-- End .pager-nav -->
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                    <div class="product-details-top">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-gallery product-gallery-vertical">
                                    <div class="row">
                                             <figure class="product-main-image text-center">
                                                <img  id="bigImg" src="{{asset('image/'. $product->main_image)}}" alt="product image">
                                            </figure><!-- End .product-main-image -->
                                    </div><!-- End .row -->
                                </div><!-- End .product-gallery -->
                            </div><!-- End .col-md-6 -->

                            <div class="col-md-6">
                               
                                <div class="product-details">
                                    <h1 class="product-title">{{$product->name}}</h1><!-- End .product-title -->

                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                    </div><!-- End .rating-container -->
                                    <div class="">
                                        <p><label class="attribute">Brand : </label> <a href="#">{{$product->brands->name}}</a> </p>
                                        <p><label class="attribute">SKU : </label> {{$product->unique_id}} </p>
                                    </div><!-- End .rating-container -->

                                    @if( $product->offer_price)
                                        <div class="product-price">
                                            ৳ {{$product->offer_price}} <span class="text-light px-3" style="font-size:15px; "><del>৳ {{$product->regular_price}}</del></span>
                                        </div><!-- End .product-price -->
                                    @else
                                        <div class="product-price">
                                        ৳ {{$product->regular_price}}
                                        </div><!-- End .product-price -->
                                    @endif
                                    

                                    <div class="product-content">
                                        @if( $product->sort_discription)
                                        <p>{{$product->sort_discription}}</p>
                                        @endif
                                    </div><!-- End .product-content -->

                                    <div class="details-filter-row details-row-size">
                                        <label>Gallary :</label>

                                        <div class="product-nav product-nav-thumbs">
                                            <a href="#" class="active">
                                                <img src="{{asset('image/'. $product->main_image)}}" class="smallImg" alt="product side">
                                            </a>
                                            @if( $product->gallary_one)
                                            <a href="#">
                                                <img src="{{asset('image/'. $product->gallary_one)}}" class="smallImg" alt="product cross">
                                            </a>
                                            @endif
                                            @if($product->gallary_two)
                                            <a href="#">
                                                <img src="{{asset('image/'. $product->gallary_two)}}" class="smallImg" alt="product with model">
                                            </a>
                                            @endif
                                        </div><!-- End .product-nav -->
                                    </div><!-- End .details-filter-row -->

                                   <form action="{{route('cart.store')}}" method="POST">
                                        @csrf 
                                        <div class="d-flex">
                                        @if( $attributes->count() > 0)
                                            <div class="details-filter-row details-row-size">
                                                <div class="select-custom">
                                                    <select name="attribute" id="size" class="form-control" required>
                                                        <option value="" >Color Select</option>
                                                        @foreach( $attributes as $color)
                                                        <option value="{{$color->color}}">{{$color->color}}</option>
                                                        @endforeach
                                                    </select>
                                                </div><!-- End .select-custom -->                                       
                                            </div><!-- End .details-filter-row -->
                                            @endif

                                            <div class="details-filter-row details-row-size">
                                                <div class="product-details-quantity">
                                                    <input type="number" name="cart_qty" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                                </div><!-- End .product-details-quantity -->
                                            </div><!-- End .details-filter-row -->
                                        </div>

                                        <div class="product-details-action">
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                           
                                            @if( Auth::check())
                                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                            @endif
                                            <button type="submit"  class="btn-product btn-cart"><span>add to cart</span></button>
                                        </div><!-- End .product-details-action -->
                                    </form>
                                    <div class="product-details-footer">
                                        <div class="product-cat">
                                            <span>Category:</span>
                                            <a href="#">
                                                @if($product->category_id)
                                                {{$product->primaryCategorys->name}}
                                                @endif
                                            </a>,
                                            <a href="#">
                                                @if( $product->sub_category_id )
                                                {{$product->subCategorys->name}}
                                                @endif
                                            </a>
                                        </div><!-- End .product-cat -->

                                        <div class="social-icons social-icons-sm">
                                            <span class="social-label">Share:</span>
                                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                        </div>
                                    </div><!-- End .product-details-footer -->
                                </div><!-- End .product-details -->
                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .product-details-top -->

                    <div class="product-details-tab">
                        <ul class="nav nav-pills justify-content-start" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                            </li>
                          
                            <li class="nav-item">
                                <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                                <div class="product-desc-content">
                                    <h3>Product Information</h3>
                                    {!! $product->description !!}
                                </div><!-- End .product-desc-content -->
                            </div><!-- .End .tab-pane -->
                            
                            <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                                <div class="reviews">
                                    <h3>Reviews (2)</h3>
                                    <div class="review">
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <h4><a href="#">Samanta J.</a></h4>
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                                    </div><!-- End .ratings -->
                                                </div><!-- End .rating-container -->
                                                <span class="review-date">6 days ago</span>
                                            </div><!-- End .col -->
                                            <div class="col">
                                                <h4>Good, perfect size</h4>

                                                <div class="review-content">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                                </div><!-- End .review-content -->

                                                <div class="review-action">
                                                    <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                    <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                                </div><!-- End .review-action -->
                                            </div><!-- End .col-auto -->
                                        </div><!-- End .row -->
                                    </div><!-- End .review -->

                                    <div class="review">
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <h4><a href="#">John Doe</a></h4>
                                                <div class="ratings-container">
                                                    <div class="ratings">
                                                        <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                                    </div><!-- End .ratings -->
                                                </div><!-- End .rating-container -->
                                                <span class="review-date">5 days ago</span>
                                            </div><!-- End .col -->
                                            <div class="col">
                                                <h4>Very good</h4>

                                                <div class="review-content">
                                                    <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                                </div><!-- End .review-content -->

                                                <div class="review-action">
                                                    <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                                    <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                                </div><!-- End .review-action -->
                                            </div><!-- End .col-auto -->
                                        </div><!-- End .row -->
                                    </div><!-- End .review -->
                                </div><!-- End .reviews -->
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .product-details-tab -->

                    <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->

                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":5
                                },
                                "1200": {
                                    "items":6,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>
                        @foreach( $related_products as $product)
                            <div class="product">
                                <figure class="product-media">
                                    @php
                                        $offer = $product->regular_price - $product->offer_price;
                                        $present = ($offer / $product->regular_price) * 100;
                                    @endphp
                                    @if( $product->offer_price)
                                    <span class="product-label label-sale">{{$present}} % </span>
                                    @endif
                                    <a href="{{route('products', $product->slug )}}">
                                        <img src="{{asset('image/'. $product->main_image)}}" alt="Product image" class="product-image">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                    </div><!-- End .product-action-vertical -->

                                    <div class="product-action">
                                        <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="#">{{$product->subCategorys->name}}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="{{route('products', $product->slug )}}">{{$product->name }}</a></h3><!-- End .product-title -->
                                    @if( $product->offer_price)
                                    <div class="product-price">
                                        <span class="new-price">৳ {{$product->offer_price}}</span>
                                        <span class="old-price">Was ৳ {{ $product->regular_price}}</span>
                                    </div><!-- End .product-price -->
                                    @else
                                    <div class="product-price">
                                        <span class="new-price">৳ {{$product->regular_price}}</span>
                                    </div><!-- End .product-price -->
                                    @endif

                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 2 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-thumbs">
                                    <a href="#" class="active">
                                        <img src="{{asset('image/'. $product->main_image)}}" alt="product desc">
                                    </a>
                                    <a href="#">
                                        <img src="{{asset('image/'. $product->gallary_one)}}" alt="product desc">
                                    </a>

                                    <a href="#">
                                        <img src="{{asset('image/'. $product->gallary_two)}}" alt="product desc">
                                    </a>
                                </div><!-- End .product-nav -->
                                    

                                    
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                        @endforeach

                          

                        
                    </div><!-- End .owl-carousel -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

@endsection

@section('js')

    <script>
        var bigImg = document.getElementById('bigImg');
        var smalImg = document.getElementsByClassName('smallImg');

        smalImg[0].onmouseover = function(){
            bigImg.src =  smalImg[0].src;
        }

        smalImg[1].onmouseover = function(){
            bigImg.src =  smalImg[1].src;
        }

        smalImg[2].onmouseover = function(){
            bigImg.src =  smalImg[2].src;
        }

      console.log(window);
    </script>

@endsection