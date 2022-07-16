
<!DOCTYPE html>
<html lang="en">


<!-- mohin/index-13.html  22 Nov 2019 09:59:06 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta name="author" content="p-themes">
    @yield('title')
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
    <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
    <meta name="application-name" content="Asmybd.com">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{asset('frontend')}}/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('frontend')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/plugins/owl-carousel/owl.carousel.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('frontend')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/skins/skin-demo-13.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/css/demos/demo-13.css">
    @yield('css')
</head>

<body>
    <div class="page-wrapper">
        <header class="header header-10 header-intro-clearance">
            <div class="header-top">
                <div class="container ">
                    <div class="header-left  ">
                        <a href="tel:#" style="padding: 9px 0;" class=""><i class="icon-phone"></i>Call: +0123 456 789</a>
                    </div><!-- End .header-left -->

                    <div class="header-right">

                        <ul class="top-menu">
                            <li>
                                <a href="#">Links</a>
                                <ul>
                                    @if( Auth::check())
                                        <li>
                                            <div class="header-dropdown pb-0" >
                                                <a href="#">
                                                    @if( Auth::user()->profile )
                                                    <img src="{{asset('image/' . Auth::user()->profile )}}" style="width:25px;height:25px; border-radius:50%; display:inline-block;margin-right:5px;border:1px solid #ddd; padding:1px;" alt="">
                                                    @endif
                                                     My Account
                                                </a>
                                                <div class="header-menu">
                                                    <ul>
                                                        @if( Auth::user()->role == 1)
                                                        <li><a href="{{route('admin.dashboard')}}">Admin Dashboard</a></li>
                                                        @endif
                                                        <li><a href="{{route('my.account')}}">Dashboard</a></li>
                                                        <form method="POST" action="{{ route('logout') }}">
                                                            @csrf
                                                            <li>
                                                                <a href="#" onclick="event.preventDefault();
                                                                this.closest('form').submit();">Log Out</a>
                                                            </li>
                                                        </form>
                                                    </ul>
                                                </div><!-- End .header-menu -->
                                            </div><!-- End .header-dropdown -->
                                        </li>
                                    @else
                                        <li class="login">
                                            <a href="#signin-modal" data-toggle="modal">Sign in / Sign up</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        </ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->

            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>
                        
                        <a href="{{url('/')}}" class="logo">
                            <!-- <img src="" alt=" Logo" width="105" height="25"> -->
                            <h1 class="m-0 text-bold">ASMY<span class="text-primary ">BD</span></h1>
                        </a>
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                            <form action="#" method="get">
                                <div class="header-search-wrapper search-wrapper-wide">
                                    <div class="select-custom">
                                        <select id="cat" name="cat">
                                            <option value="">All Departments</option>
                                            <option value="1">Fashion</option>
                                            <option value="2">- Women</option>
                                            <option value="3">- Men</option>
                                            <option value="4">- Jewellery</option>
                                            <option value="5">- Kids Fashion</option>
                                            <option value="6">Electronics</option>
                                            <option value="7">- Smart TVs</option>
                                            <option value="8">- Cameras</option>
                                            <option value="9">- Games</option>
                                            <option value="10">Home &amp; Garden</option>
                                            <option value="11">Motors</option>
                                            <option value="12">- Cars and Trucks</option>
                                            <option value="15">- Boats</option>
                                            <option value="16">- Auto Tools &amp; Supplies</option>
                                        </select>
                                    </div><!-- End .select-custom -->
                                    <label for="q" class="sr-only">Search</label>
                                    <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..." required>
                                    <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                                </div><!-- End .header-search-wrapper -->
                            </form>
                        </div><!-- End .header-search -->
                    </div>

                    <div class="header-right">
                        <div class="header-dropdown-link">
                            <div class="dropdown compare-dropdown">
                                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Compare Products" aria-label="Compare Products">
                                    <i class="icon-random"></i>
                                    <span class="compare-txt">Compare</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="compare-products">
                                        <li class="compare-product">
                                            <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                            <h4 class="compare-product-title"><a href="product.html">Blue Night Dress</a></h4>
                                        </li>
                                        <li class="compare-product">
                                            <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                            <h4 class="compare-product-title"><a href="product.html">White Long Skirt</a></h4>
                                        </li>
                                    </ul>

                                    <div class="compare-actions">
                                        <a href="#" class="action-link">Clear All</a>
                                        <a href="#" class="btn btn-outline-primary-2"><span>Compare</span><i class="icon-long-arrow-right"></i></a>
                                    </div>
                                </div><!-- End .dropdown-menu -->
                            </div><!-- End .compare-dropdown -->

                            <a href="wishlist.html" class="wishlist-link">
                                <i class="icon-heart-o"></i>
                                <span class="wishlist-count">3</span>
                                <span class="wishlist-txt">Wishlist</span>
                            </a>

                            <div class="dropdown cart-dropdown">
                                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                                    <i class="icon-shopping-cart"></i>
                                    <span class="cart-count">{{ App\Models\Cart::totalCartItemCount()}}</span>
                                    <span class="cart-txt">Cart</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-cart-products">
                                        @foreach(App\Models\Cart::userCartItems() as $key)
                                        <div class="product">
                                            <div class="product-cart-details">
                                                <h4 class="product-title">
                                                    <a href="{{route('products' , $key->products->slug)}}">{{$key->products->name}}</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">{{$key->cart_qty}}</span>
                                                    x   @if( $key->products->offer_price)
                                                            {{ $key->products->offer_price}} BDT
                                                        @else
                                                            {{ $key->products->regular_price}} BDT
                                                        @endif
                                                </span>
                                            </div><!-- End .product-cart-details -->

                                            <figure class="product-image-container">
                                                <a href="{{route('products' , $key->products->slug)}}" class="product-image">
                                                    <img src="{{asset('image/' . $key->products->main_image)}}" alt="product">
                                                </a>
                                            </figure>
                                           
                                        </div><!-- End .product -->
                                        @endforeach

                                       
                                    </div><!-- End .cart-product -->

                                    <div class="dropdown-cart-total">
                                        <span>Total</span>

                                        <span class="cart-total-price">BDT {{ App\Models\Cart::totalPrice() }}</span>
                                    </div><!-- End .dropdown-cart-total -->

                                    <div class="dropdown-cart-action">
                                        <a href="{{route('cart.page')}}" class="btn btn-primary">View Cart</a>
                                        <a href="{{route('checkout')}}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                                    </div><!-- End .dropdown-cart-total -->
                                </div><!-- End .dropdown-menu -->
                            </div><!-- End .cart-dropdown -->
                        </div>
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container">
                    <div class="header-left">
                        <div class="dropdown category-dropdown show is-on" data-visible="true">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-display="static" title="Browse Categories">
                                Browse Categories
                            </a>

                            <div class="dropdown-menu show">
                                <nav class="side-nav">
                                    <ul class="menu-vertical sf-arrows">
                                     
                                        @foreach( $primary_categorys as $key)
                                        <li class="megamenu-container">
                                            <a 
                                            @if( App\Models\SubCategory::where('primary_category_id', $key->id)->where('status',1)->count() > 0)
                                            class="sf-with-ul"
                                            @endif
                                             href="{{route('primary.category.wish.product' , $key->slug )}}">{{$key->name}}</a>
                                           @if( App\Models\SubCategory::where('primary_category_id', $key->id)->where('status',1)->count() > 0)
                                            <div class="megamenu">
                                                <div class="menu-col">
                                                    <div class="row">
                                                        @foreach( App\Models\SubCategory::where('primary_category_id', $key->id)->where('status',1)->get() as $subKey)
                                                        <div class="col-md-4">
                                                            <div class="menu-title">
                                                                <a href="{{route('sub.category.wish.product' , $subKey->slug )}}">{{$subKey->name}}</a>
                                                            </div><!-- End .menu-title -->
                                                           
                                                        </div><!-- End .col-md-4 -->
                                                        @endforeach

                                                    </div><!-- End .row -->
                                                </div><!-- End .menu-col -->
                                            </div><!-- End .megamenu -->
                                            @endif
                                        </li>
                                        @endforeach
                                       
                                    </ul><!-- End .menu-vertical -->
                                </nav><!-- End .side-nav -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .category-dropdown -->
                    </div><!-- End .col-lg-3 -->
                    <div class="header-center">
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li class="megamenu-container active">
                                    <a href="{{url('/')}}" class="">Home</a>
                                </li>
                                <li>
                                    <a href="{{route('shop.one')}}" >Shop</a>
                                </li>
                               
                               
                                <li>
                                    <a href="#" class="sf-with-ul">Elements</a>

                                    <ul>
                                        <li><a href="#">Products</a></li>
                                        <li><a href="#">Typography</a></li>
                                        <li><a href="#">Titles</a></li>
                                        <li><a href="#">Banners</a></li>
                                        <li><a href="#">Product Category</a></li>
                                        <li><a href="#">Video Banners</a></li>
                                     
                                    </ul>
                                </li>
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .col-lg-9 -->
                    <div class="header-right">
                        <i class="la la-lightbulb-o"></i><p><a href="{{route('offer.selling')}}">Offer Selling</a></p>
                    </div>
                </div><!-- End .container -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->

        @yield('content')

        <footer class="footer footer-2">
            <div class="footer-middle border-0">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="widget widget-about">
                                <!-- <img src="" class="footer-logo" alt="Footer Logo" width="105" height="25"> -->
                                <h1 class="m-0 text-bold" style="font-size:35px">ASMY<span class="text-primary ">BD</span></h1>
                                <p>Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus. </p>
                                
                                <div class="widget-about-info">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-4">
                                            <span class="widget-about-title">Got Question? Call us 24/7</span>
                                            <a href="tel:123456789">+0123 456 789</a>
                                        </div><!-- End .col-sm-6 -->
                                        <div class="col-sm-6 col-md-8">
                                            <span class="widget-about-title">Payment Method</span>
                                            <figure class="footer-payments">
                                                <img src="{{asset('frontend')}}/images/payments.png" alt="Payment methods" width="272" height="20">
                                            </figure><!-- End .footer-payments -->
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .widget-about-info -->
                            </div><!-- End .widget about-widget -->
                        </div><!-- End .col-sm-12 col-lg-3 -->

                        <div class="col-sm-4 col-lg-2">
                            <div class="widget">
                                <h4 class="widget-title">Information</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="about.html">About mohin</a></li>
                                    <li><a href="#">How to shop on mohin</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="contact.html">Contact us</a></li>
                                    <li><a href="login.html">Log in</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-4 col-lg-3 -->

                        <div class="col-sm-4 col-lg-2">
                            <div class="widget">
                                <h4 class="widget-title">Customer Service</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="#">Payment Methods</a></li>
                                    <li><a href="#">Money-back guarantee!</a></li>
                                    <li><a href="#">Returns</a></li>
                                    <li><a href="#">Shipping</a></li>
                                    <li><a href="#">Terms and conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-4 col-lg-3 -->

                        <div class="col-sm-4 col-lg-2">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4><!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="#">Sign In</a></li>
                                    <li><a href="cart.html">View Cart</a></li>
                                    <li><a href="#">My Wishlist</a></li>
                                    <li><a href="#">Track My Order</a></li>
                                    <li><a href="#">Help</a></li>
                                </ul><!-- End .widget-list -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-sm-64 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .footer-middle -->

            <div class="footer-bottom">
                <div class="container">
                    <p class="footer-copyright">Copyright © 2019 mohin Store. All Rights Reserved.</p><!-- End .footer-copyright -->
                    <ul class="footer-menu">
                        <li><a href="#">Terms Of Use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul><!-- End .footer-menu -->

                    <div class="social-icons social-icons-color">
                        <span class="social-label">Social Media</span>
                        <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                        <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                        <a href="#" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                        <a href="#" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                        <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                    </div><!-- End .soial-icons -->
                </div><!-- End .container -->
            </div><!-- End .footer-bottom -->
        </footer><!-- End .footer -->
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>
            
            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="active">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li>
                                <a href="{{route('shop.one')}}">Shop</a>
                                <ul>
                                    <li><a href="#">Shop List</a></li>
                                    <li><a href="#">Shop Grid 2 Columns</a></li>
                                    
                                </ul>
                            </li>
                           
                          
                            <li>
                                <a href="#">Elements</a>
                                <ul>
                                    <li><a href="#">Products</a></li>
                                    <li><a href="#">Typography</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav><!-- End .mobile-nav -->
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-cats-nav">
                        <ul class="mobile-cats-menu">
                            <li><a class="mobile-cats-lead" href="#">Daily offers</a></li>
                            <li><a class="mobile-cats-lead" href="#">Gift Ideas</a></li>
                            @foreach( App\Models\PrimaryCategory::where('status',1)->get() as $item)
                            <li><a href="{{route('primary.category.wish.product', $item->slug)}}">{{$item->name}}</a></li>
                            @endforeach
                        </ul><!-- End .mobile-cats-menu -->
                    </nav><!-- End .mobile-cats-nav -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4 text-danger m-0" :status="session('status')" />
                                    <x-auth-validation-errors class="mb-4 text-danger m-0" :errors="$errors" />
							    	<form  method="POST" action="{{ route('login') }}">
                                        @csrf 
							    		<div class="form-group">
							    			<label for="singin-email-2">Email address *</label>
							    			 <input id="email" class="form-control" type="email" name="email" value="{{old('email')}}" required autofocus />
							    		</div><!-- End .form-group -->

							    		<div class="form-group">
							    			<label for="singin-password-2">Password *</label>
                                            <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
							    		</div><!-- End .form-group -->

							    		<div class="form-footer">
							    			<button type="submit" class="btn btn-outline-primary-2">
			                					<span>LOG IN</span>
			            						<i class="icon-long-arrow-right"></i>
			                				</button>

			                				<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"  name="remember" id="signin-remember-2">
												<label class="custom-control-label" for="signin-remember-2">Remember Me</label>
											</div><!-- End .custom-checkbox -->

                               

											<a href="{{ route('password.request') }}" class="forgot-link">Forgot Your Password?</a>
							    		</div><!-- End .form-footer -->
							    	</form>
							    	<div class="form-choice">
								    	<p class="text-center">or sign in with</p>
								    	<div class="row">
								    		<div class="col-sm-6">
								    			<a href="#" class="btn btn-login btn-g">
								    				<i class="icon-google"></i>
								    				Login With Google
								    			</a>
								    		</div><!-- End .col-6 -->
								    		<div class="col-sm-6">
								    			<a href="#" class="btn btn-login btn-f">
								    				<i class="icon-facebook-f"></i>
								    				Login With Facebook
								    			</a>
								    		</div><!-- End .col-6 -->
								    	</div><!-- End .row -->
							    	</div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <x-auth-validation-errors class="mb-4 m-0 text-danger" :errors="$errors" />	
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf 
							    		<div class="form-group">
							    			<label for="register-email-2">Full Name *</label>
                                            <input id="name" class="form-control" type="text" name="name" value="{{old('name')}}" required autofocus />
							    		</div><!-- End .form-group -->
							    		<div class="form-group">
							    			<label for="register-email-2">Your email address *</label>
                                            <input id="email" class="form-control" type="email" name="email" value="{{old('email')}}" required />
                                           
							    		</div><!-- End .form-group -->
							    		<div class="form-group">
							    			<label for="register-email-2">Password *</label>
                                            <input id="password" class="form-control" type="password"  name="password"  required autocomplete="new-password" />
                                           
							    		</div><!-- End .form-group -->

							    		<div class="form-group">
							    			<label for="register-password-2">Confirm Password *</label>
                                            <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
							    		</div><!-- End .form-group -->

							    		<div class="form-footer">
							    			<button type="submit" class="btn btn-outline-primary-2">
			                					<span>SIGN UP</span>
			            						<i class="icon-long-arrow-right"></i>
			                				</button>

			                				<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="register-policy-2" required>
												<label class="custom-control-label" for="register-policy-2">I agree to the <a href="#">privacy policy</a> *</label>
											</div><!-- End .custom-checkbox -->
							    		</div><!-- End .form-footer -->
							    	</form>
							    	<div class="form-choice">
								    	<p class="text-center">or sign in with</p>
								    	<div class="row">
								    		<div class="col-sm-6">
								    			<a href="#" class="btn btn-login btn-g">
								    				<i class="icon-google"></i>
								    				Login With Google
								    			</a>
								    		</div><!-- End .col-6 -->
								    		<div class="col-sm-6">
								    			<a href="#" class="btn btn-login  btn-f">
								    				<i class="icon-facebook-f"></i>
								    				Login With Facebook
								    			</a>
								    		</div><!-- End .col-6 -->
								    	</div><!-- End .row -->
							    	</div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->

    <!-- Plugins JS File -->
    <script src="{{asset('frontend')}}/js/jquery.min.js"></script>
    <script src="{{asset('frontend')}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('frontend')}}/js/jquery.hoverIntent.min.js"></script>
    <script src="{{asset('frontend')}}/js/jquery.waypoints.min.js"></script>
    <script src="{{asset('frontend')}}/js/superfish.min.js"></script>
    <script src="{{asset('frontend')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('frontend')}}/js/bootstrap-input-spinner.js"></script>
    <script src="{{asset('frontend')}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('frontend')}}/js/jquery.plugin.min.js"></script>
    <script src="{{asset('frontend')}}/js/jquery.countdown.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
    <!-- Main JS File -->
    <script src="{{asset('frontend')}}/js/main.js"></script>
    <script src="{{asset('frontend')}}/js/demos/demo-13.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if( Session('success'))
        <script>
            swal({
                title: "Success",
                text: "{{ Session('success') }}",
                icon: "success",
                button: "Ok",
            });
        </script>
    @elseif( Session('warning'))
        <script>
            swal({
                title: "Warning",
                text: "{{ Session('warning') }}",
                icon: "warning",
                button: "Ok",
            });
        </script>
    @endif
    @yield('js')

    <script>
         $('.try').click(function(e){
            var category = [];
            $('.try').each(function(e){
                if( $(this).is(":checked")){
                    category.push($(this).val());
                }
            })

            Finalcategory = category.toString();
            $.ajax({
                type:'GET',
                dataType:'html',
                url:'/ajax-cat',
                data: "category="+ Finalcategory,
                success: function(res){
                    // console.log(res);
                    $('.fatch-product').html(res);
                }
            })
        })
    </script>
</body>


</html>