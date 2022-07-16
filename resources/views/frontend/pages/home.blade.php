@extends('frontend.layout.template')

@section('content')

        <main class="main">
            @if( $main_sliders->count() >= 1)
            <div class="intro-slider-container">
                <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
                        "nav": false,
                        "responsive": {
                            "992": {
                                "nav": true
                            }
                        }
                    }'>
                    @foreach( $main_sliders as $slider)
                    <div class="intro-slide" style="background-image: url({{asset('image/' . $slider->banner )}});">
                        <div class="container intro-content">
                            <div class="row">
                                <div class="col-auto offset-lg-3 intro-col">
                                    <h3 class="intro-subtitle">{{$slider->sub_title}}</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title">{!! $slider->main_title !!} 
                                        <span>
                                            <sup class="font-weight-light">from</sup>
                                            <span class="text-primary">৳{{ $slider->price}}<sup></sup></span>
                                        </span>
                                    </h1><!-- End .intro-title -->

                                    <a href="{{ $slider->link }}" class="btn btn-outline-primary-2">
                                        <span>Shop Now</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                </div><!-- End .col-auto offset-lg-3 -->
                            </div><!-- End .row -->
                        </div><!-- End .container intro-content -->
                    </div><!-- End .intro-slide -->
                    @endforeach
                </div><!-- End .owl-carousel owl-simple -->

                <span class="slider-loader"></span><!-- End .slider-loader -->
            </div><!-- End .intro-slider-container -->
            @endif

            <div class="mb-4"></div><!-- End .mb-2 -->

            <div class="container">
                <h2 class="title text-center mb-2">Explore Popular Categories</h2><!-- End .title -->

                <div class="cat-blocks-container">
                    <div class="row">

                        @foreach( $categorys as $category)
                        <div class="col-6 col-sm-4 col-lg-2">
                            <a href="{{route('primary.category.wish.product', $category->slug)}}" class="cat-block">
                                <figure>
                                    <span>
                                        <img src="{{asset('image/'. $category->image)}}" alt="Category image">
                                    </span>
                                </figure>

                                <h3 class="cat-block-title">{{$category->name}}</h3><!-- End .cat-block-title -->
                            </a>
                        </div><!-- End .col-sm-4 col-lg-2 -->
                        @endforeach

                    </div><!-- End .row -->
                </div><!-- End .cat-blocks-container -->
            </div><!-- End .container -->

            <div class="mb-2"></div><!-- End .mb-2 -->

            

            <div class="mb-3"></div><!-- End .mb-3 -->
            
            <div class="bg-light pt-3 pb-5">
                <div class="container">
                    
               
                    <div class="heading heading-flex heading-border mb-3">
                        <div class="heading-left">
                            <h2 class="title">Hot Deals Products</h2><!-- End .title -->
                        </div><!-- End .heading-left -->

                       <div class="heading-right">
                            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="hot-all-link" data-toggle="tab" href="#hot-all-tab" role="tab" aria-controls="hot-all-tab" aria-selected="true">All</a>
                                </li>
                                
                                @foreach($categorys as $key)
                                @foreach( App\Models\Product::where('category_id', $key->id)->where('status',1)->get() as $item)
                                <li class="nav-item">
                                    <a class="nav-link" id="hot-elec-link{{$key->id}}" data-toggle="tab" href="#hot-elec-tab{{$key->id}}" role="tab" aria-controls="hot-elec-tab{{$key->id}}" aria-selected="false">{{$key->name}}</a>
                                </li>
                                @endforeach
                              
                                @endforeach
                                
                               
                            </ul>
                       </div><!-- End .heading-right -->
                    </div><!-- End .heading -->

                    <div class="tab-content tab-content-carousel">
                       
                        <div class="tab-pane p-0 fade show active" id="hot-all-tab" role="tabpanel" aria-labelledby="hot-all-link">
                            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                                data-owl-options='{
                                    "nav": false, 
                                    "dots": true,
                                    "margin": 20,
                                    "loop": false,
                                    "responsive": {
                                        "0": {
                                            "items":2
                                        },
                                        "480": {
                                            "items":2
                                        },
                                        "768": {
                                            "items":3
                                        },
                                        "992": {
                                            "items":4
                                        },
                                        "1280": {
                                            "items":5,
                                            "nav": true
                                        }
                                    }
                                }'>

                                @foreach( $products as $product)
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
                                            <img src="{{asset('image/'.$product->main_image)}}" alt="{{$product->name}}" class="product-image">
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
                                            <a href="{{route('primary.category.wish.product' , $product->primaryCategorys->slug )}}">{{$product->primaryCategorys->name}}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="{{ route('products' , $product->slug)}}">{{$product->name}}</a></h3><!-- End .product-title -->
                                        @if( $product->offer_price)
                                        <div class="product-price">
                                            <span class="new-price" style="color:#007bff">৳ {{$product->offer_price}}</span>
                                            <span class="old-price">Was ৳ {{ $product->regular_price}}</span>
                                        </div><!-- End .product-price -->
                                        @else
                                        <div class="product-price">
                                            <span class="new-price" style="color:#007bff">৳ {{$product->regular_price}}</span>
                                        </div><!-- End .product-price -->
                                        @endif
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                                @endforeach

                                
                            </div><!-- End .owl-carousel -->
                        </div><!-- .End .tab-pane -->

                        @foreach( $categorys as $item )
                        <div class="tab-pane p-0 fade" id="hot-elec-tab{{$item->id}}" role="tabpanel" aria-labelledby="hot-elec-link{{$item->id}}">
                            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                                data-owl-options='{
                                    "nav": false, 
                                    "dots": true,
                                    "margin": 20,
                                    "loop": false,
                                    "responsive": {
                                        "0": {
                                            "items":2
                                        },
                                        "480": {
                                            "items":2
                                        },
                                        "768": {
                                            "items":3
                                        },
                                        "992": {
                                            "items":4
                                        },
                                        "1280": {
                                            "items":5,
                                            "nav": true
                                        }
                                    }
                                }'>
                                @foreach( App\Models\Product::where('category_id' , $item->id)->get() as $product)
                                <div class="product">
                                    <figure class="product-media">
                                        @php
                                            $offer = $product->regular_price - $product->offer_price;
                                            $present = ($offer / $product->regular_price) * 100;
                                        @endphp
                                        @if( $product->offer_price)
                                        <span class="product-label label-sale">{{$present}} % </span>
                                        @endif
                                        <a href="product.html">
                                            <img src="{{asset('image/'. $product->main_image)}}" alt="Product image" class="product-image">
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
                                            <a href="{{route('primary.category.wish.product' , $product->primaryCategorys->slug )}}">{{$product->primaryCategorys->name}}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a href="product.html">{{$product->name }}</a></h3><!-- End .product-title -->
                                        @if( $product->offer_price)
                                        <div class="product-price">
                                            <span class="product-price">৳ {{$product->offer_price}}</span>
                                            <span class="old-price">Was ৳ {{ $product->regular_price}}</span>
                                        </div><!-- End .product-price -->
                                        @else
                                        <div class="product-price">
                                            <span class="product-price">৳ {{$product->regular_price}}</span>
                                        </div><!-- End .product-price -->
                                        @endif
                                       

                                       
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                                @endforeach

                               
                            </div><!-- End .owl-carousel -->
                        </div><!-- .End .tab-pane -->
                        @endforeach 
                       

                        
                    </div><!-- End .tab-content -->
                   
                </div><!-- End .container -->
            </div><!-- End .bg-light pt-5 pb-5 -->





          

            <div class="mb-3"></div><!-- End .mb-3 -->

            <div class="container electronics">
                <div class="heading heading-flex heading-border mb-3">
                    <div class="heading-left">
                        <h2 class="title">Mobile</h2><!-- End .title -->
                    </div><!-- End .heading-left -->

                   <div class="heading-right">
                        <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="elec-new-link" data-toggle="tab" href="#elec-new-tab" role="tab" aria-controls="elec-new-tab" aria-selected="true">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="elec-featured-link" data-toggle="tab" href="#elec-featured-tab" role="tab" aria-controls="elec-featured-tab" aria-selected="false">Featured</a>
                            </li>
                           
                        </ul>
                   </div><!-- End .heading-right -->
                </div><!-- End .heading -->

                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane p-0 fade show active" id="elec-new-tab" role="tabpanel" aria-labelledby="elec-new-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1280": {
                                        "items":5,
                                        "nav": true
                                    }
                                }
                            }'>
                            @foreach( $electronics_products_new as $product)

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
                                        <img src="{{asset('image/'. $product->main_image)}}" alt="Product image" class="product-image">
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
                                        <a href="{{route('primary.category.wish.product' , $product->primaryCategorys->slug )}}">{{$product->primaryCategorys->name}}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="{{ route('products' , $product->slug)}}">{{$product->name }}</a></h3><!-- End .product-title -->
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
                            </div><!-- End .product -->
                           
                            @endforeach

                            
                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane p-0 fade" id="elec-featured-tab" role="tabpanel" aria-labelledby="elec-featured-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1280": {
                                        "items":5,
                                        "nav": true
                                    }
                                }
                            }'>
                            @foreach( App\Models\Product::where('category_id',3)->where('is_fiture',1)->get() as $product)

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
                                        <img src="{{asset('image/'. $product->main_image)}}" alt="Product image" class="product-image">
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
                                        <a href="{{route('primary.category.wish.product' , $product->primaryCategorys->slug )}}">{{$product->primaryCategorys->name}}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="{{ route('products' , $product->slug)}}">{{$product->name }}</a></h3><!-- End .product-title -->
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
                            </div><!-- End .product -->

                            @endforeach
                           
                            
                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->
                    
                </div><!-- End .tab-content -->
            </div><!-- End .container -->

            <div class="mb-3"></div><!-- End .mb-3 -->

            

            <div class="mb-1"></div><!-- End .mb-1 -->

            <div class="container furniture">
                <div class="heading heading-flex heading-border mb-3">
                    <div class="heading-left">
                        <h2 class="title">Camera</h2><!-- End .title -->
                    </div><!-- End .heading-left -->

                   <div class="heading-right">
                        <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="furn-new-link" data-toggle="tab" href="#furn-new-tab" role="tab" aria-controls="furn-new-tab" aria-selected="true">All </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="furn-featured-link" data-toggle="tab" href="#furn-featured-tab" role="tab" aria-controls="furn-featured-tab" aria-selected="false">Featured</a>
                            </li>
                           
                        </ul>
                   </div><!-- End .heading-right -->
                </div><!-- End .heading -->

                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane p-0 fade show active" id="furn-new-tab" role="tabpanel" aria-labelledby="furn-new-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1280": {
                                        "items":5,
                                        "nav": true
                                    }
                                }
                            }'>
                            @foreach( $camera_products_new as $product)
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
                                        <img src="{{asset('image/'. $product->main_image)}}" alt="Product image" class="product-image">
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
                                        <a href="{{route('primary.category.wish.product' , $product->primaryCategorys->slug )}}">{{$product->primaryCategorys->name}}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="{{ route('products' , $product->slug)}}">{{$product->name }}</a></h3><!-- End .product-title -->
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
                            </div><!-- End .product -->
                            @endforeach

                           
                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->
                    <div class="tab-pane p-0 fade" id="furn-featured-tab" role="tabpanel" aria-labelledby="furn-featured-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1280": {
                                        "items":5,
                                        "nav": true
                                    }
                                }
                            }'>
                            @foreach( App\Models\Product::where('category_id',1)->where('is_fiture',1)->get() as $product)
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
                                        <img src="{{asset('image/'. $product->main_image)}}" alt="Product image" class="product-image">
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
                                        <a href="{{route('primary.category.wish.product' , $product->primaryCategorys->slug )}}">{{$product->primaryCategorys->name}}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="{{ route('products' , $product->slug)}}">{{$product->name }}</a></h3><!-- End .product-title -->
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
                            </div><!-- End .product -->
                            @endforeach

                           
                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->
                   
                </div><!-- End .tab-content -->
            </div><!-- End .container -->
        

            <div class="mb-3"></div><!-- End .mb-3 -->

            <div class="container clothing ">
                <div class="heading heading-flex heading-border mb-3">
                    <div class="heading-left">
                        <h2 class="title mb-2">Best Selling</h2><!-- End .title -->
                    </div><!-- End .heading-left -->
                </div><!-- End .heading -->

                <div class="tab-content tab-content-carousel">
                    <div class="tab-pane p-0 fade show active" id="clot-new-tab" role="tabpanel" aria-labelledby="clot-new-link">
                        <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": false, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1280": {
                                        "items":5,
                                        "nav": true
                                    }
                                }
                            }'>

                            @foreach($best_selling as $product)
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
                                        <img src="{{asset('image/'. $product->main_image)}}" alt="Product image" class="product-image">
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
                                        <a href="{{route('primary.category.wish.product' , $product->primaryCategorys->slug )}}">{{$product->primaryCategorys->name}}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="{{ route('products' , $product->slug)}}">{{$product->name }}</a></h3><!-- End .product-title -->
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
                            </div><!-- End .product -->
                            @endforeach

                           
                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->
                   
                </div><!-- End .tab-content -->
            </div><!-- End .container -->

            <div class="mb-3"></div><!-- End .mb-3 -->

            <div class="container">
                <h2 class="title title-border mb-5">Shop by Brands</h2><!-- End .title -->
                <div class="owl-carousel mb-5 owl-simple" data-toggle="owl" 
                    data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "margin": 30,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "420": {
                                "items":3
                            },
                            "600": {
                                "items":4
                            },
                            "900": {
                                "items":5
                            },
                            "1024": {
                                "items":6
                            },
                            "1280": {
                                "items":6,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    <a href="#" class="brand">
                        <img src="{{asset('frontend')}}/images/brands/1.png" alt="Brand Name">
                    </a>

                    <a href="#" class="brand">
                        <img src="{{asset('frontend')}}/images/brands/2.png" alt="Brand Name">
                    </a>

                    <a href="#" class="brand">
                        <img src="{{asset('frontend')}}/images/brands/3.png" alt="Brand Name">
                    </a>

                    <a href="#" class="brand">
                        <img src="{{asset('frontend')}}/images/brands/4.png" alt="Brand Name">
                    </a>

                    <a href="#" class="brand">
                        <img src="{{asset('frontend')}}/images/brands/5.png" alt="Brand Name">
                    </a>

                    <a href="#" class="brand">
                        <img src="{{asset('frontend')}}/images/brands/6.png" alt="Brand Name">
                    </a>

                    <a href="#" class="brand">
                        <img src="{{asset('frontend')}}/images/brands/7.png" alt="Brand Name">
                    </a>
                </div><!-- End .owl-carousel -->
            </div><!-- End .container -->

            <div class="cta cta-horizontal cta-horizontal-box bg-primary">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-2xl-5col">
                            <h3 class="cta-title text-white">Join Our Newsletter</h3><!-- End .cta-title -->
                            <p class="cta-desc text-white">Subcribe to get information about products and coupons</p><!-- End .cta-desc -->
                        </div><!-- End .col-lg-5 -->
                        
                        <div class="col-3xl-5col">
                            <form action="#">
                                <div class="input-group">
                                    <input type="email" class="form-control form-control-white" placeholder="Enter your Email Address" aria-label="Email Adress" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-white-2" type="submit"><span>Subscribe</span><i class="icon-long-arrow-right"></i></button>
                                    </div><!-- .End .input-group-append -->
                                </div><!-- .End .input-group -->
                            </form>
                        </div><!-- End .col-lg-7 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .cta -->

           
        </main><!-- End .main -->


@endsection