<?php use App\Models\Cart; ?>
@extends('frontend.layout.template')
@section('title')
    <title>checkout page</title>
@endsection

@section('css')
<style>

</style>
@endsection

@section('content')


        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Checkout<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="checkout">
	                <div class="container">
            			<div class="checkout-discount">
            				<form action="#">
        						<input type="text" class="form-control" required id="checkout-discount-input">
            					<label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
            				</form>
            			</div><!-- End .checkout-discount -->
            			<form action="{{route('order.store')}}" method="POST">
							@csrf 

							<input type="hidden" name="total_price" value="{{ Cart::totalPrice() }}">
		                	<div class="row">
		                		<div class="col-lg-8">
		                			<h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
		                				<div class="row">
		                					<div class="col-sm-12">
		                						<label>First Name *</label>
		                						<input type="text" name="name" value="{{ Auth::user()->name ? Auth::user()->name : old('name') }}" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->
		                					<div class="col-sm-12">
		                						<label>Email *</label>
		                						<input type="text" name="email"  value="{{ Auth::user()->email ? Auth::user()->email : old('email') }}"  class="form-control" required>
		                					</div><!-- End .col-sm-6 -->
		                					<div class="col-sm-12">
		                						<label>Phone *</label>
		                						<input type="text" name="phone"  value="{{ Auth::user()->phone ? Auth::user()->phone : old('phone') }}" class="form-control" required>
		                					</div><!-- End .col-sm-6 -->
		                					<div class="col-sm-12">
		                						<label>District *</label>
		                						<select name="district_id" class="form-control" id="checkoutDistrict" required>
                                                    <option value="">District</option>
													@foreach($districts as $key)
                                                    <option value="{{$key->id}}" @if( $key->id == Auth::user()->district ) selected @endif >{{$key->name}}</option>
													@endforeach
                                                </select>
		                					</div><!-- End .col-sm-6 -->
		                					<div class="col-sm-12">
		                						<label>City *</label>
		                						<select name="upzila_id" class="form-control" id="checkoutUpzila" required>
                                                    <option value="">City</option>
													@foreach( $upzilas as $key)
                                                    <option value="{{$key->id}}" @if( $key->id == Auth::user()->upzila ) selected @endif>{{$key->name}}</option>
													@endforeach
                                                </select>
		                					</div><!-- End .col-sm-6 -->
		                					<div class="col-sm-12">
		                						<label>Address *</label>
		                						<textarea name="address" id=""  class="form-control" cols="30" rows="3"> {{ Auth::user()->address ? Auth::user()->address : old('address') }}</textarea>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->
	                					
		                		</div><!-- End .col-lg-9 -->
		                		<aside class="col-lg-4">
		                			<div class="summary">
		                				<h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

		                				<table class="table table-summary">
		                					<thead>
		                						<tr>
		                							<th>Product</th>
		                							<th>Total</th>
		                						</tr>
		                					</thead>

		                					<tbody>
                                                @foreach( Cart::userCartItems() as $key)
		                						<tr>
		                							<td><a href="{{route('products', $key->products->slug)}}">{{$key->products->name}}</a> X {{$key->cart_qty}}</td>
		                							<td>
                                                        @if( $key->products->offer_price)
                                                        {{ $key->products->offer_price * $key->cart_qty}} BDT
                                                        @else
                                                        {{ $key->products->regular_price * $key->cart_qty}} BDT
                                                        @endif
                                                    </td>
		                						</tr>
                                                @endforeach

		                						
		                						<tr class="summary-subtotal">
		                							<td>Subtotal:</td>
		                							<td>{{ Cart::totalPrice() }} BDT</td>
		                						</tr><!-- End .summary-subtotal -->
		                						<tr>
		                							<td>Shipping:</td>
		                							<td>Free shipping</td>
		                						</tr>
		                						<tr class="summary-total">
		                							<td>Total:</td>
		                							<td>{{ Cart::totalPrice() }} BDT</td>
		                						</tr><!-- End .summary-total -->
		                					</tbody>
		                				</table><!-- End .table table-summary -->

		                				<div class="accordion-summary" id="accordion-payment">
										    <div class="card">
										        <div class="card-header" id="heading-1">
										            <h2 class="card-title">
										                <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
										                    Direct bank transfer
										                </a>
										            </h2>
										        </div><!-- End .card-header -->
										        <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-payment">
										            <div class="card-body">
										                Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
										            </div><!-- End .card-body -->
										        </div><!-- End .collapse -->
										    </div><!-- End .card -->

										    <div class="card">
										        <div class="card-header" id="heading-2">
										            <h2 class="card-title">
										                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
										                    Check payments
										                </a>
										            </h2>
										        </div><!-- End .card-header -->
										        <div id="collapse-2" class="collapse" aria-labelledby="heading-2" data-parent="#accordion-payment">
										            <div class="card-body">
										                Ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. 
										            </div><!-- End .card-body -->
										        </div><!-- End .collapse -->
										    </div><!-- End .card -->

										    <div class="card">
										        <div class="card-header" id="heading-3">
										            <h2 class="card-title">
										                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
										                    Cash on delivery
										                </a>
										            </h2>
										        </div><!-- End .card-header -->
										        <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordion-payment">
										            <div class="card-body">Quisque volutpat mattis eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. 
										            </div><!-- End .card-body -->
										        </div><!-- End .collapse -->
										    </div><!-- End .card -->

										    <div class="card">
										        <div class="card-header" id="heading-4">
										            <h2 class="card-title">
										                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
										                    PayPal <small class="float-right paypal-link">What is PayPal?</small>
										                </a>
										            </h2>
										        </div><!-- End .card-header -->
										        <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordion-payment">
										            <div class="card-body">
										                Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum.
										            </div><!-- End .card-body -->
										        </div><!-- End .collapse -->
										    </div><!-- End .card -->

										    <div class="card">
										        <div class="card-header" id="heading-5">
										            <h2 class="card-title">
										                <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
										                    Credit Card (Stripe)
										                    <img src="{{asset('frontend')}}/images/payments-summary.png" alt="payments cards">
										                </a>
										            </h2>
										        </div><!-- End .card-header -->
										        <div id="collapse-5" class="collapse" aria-labelledby="heading-5" data-parent="#accordion-payment">
										            <div class="card-body"> Donec nec justo eget felis facilisis fermentum.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Lorem ipsum dolor sit ame.
										            </div><!-- End .card-body -->
										        </div><!-- End .collapse -->
										    </div><!-- End .card -->
										</div><!-- End .accordion -->



		                				<button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
		                					<span class="btn-text">Place Order</span>
		                					<span class="btn-hover-text">Proceed to Checkout</span>
		                				</button>
		                			</div><!-- End .summary -->
		                		</aside><!-- End .col-lg-3 -->
		                	</div><!-- End .row -->
            			</form>
	                </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->



@endsection

@section('js')

<script>

    $(document).ready(function(){
        $('#checkoutDistrict').on("change" , function(e){
            e.preventDefault();
            var checkoutDistrict = $('#checkoutDistrict').val();
            // alert(district_find)
            if( checkoutDistrict ){
                $.ajax({
                    url: "/checkout/district/" + checkoutDistrict,
                    type:'GET',
                    dataType:"json",
                    success:function(data){
                        $("#checkoutUpzila").empty();
                        $('#checkoutUpzila').html('<option value="">Select your updila</option>');
                        $.each(data, function(key,value){

                            $("#checkoutUpzila").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                })
            }
        })
    })

</script>

@endsection
