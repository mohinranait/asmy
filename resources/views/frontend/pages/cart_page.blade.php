
@extends('frontend.layout.template')
@section('title')
    <title>Product page</title>
@endsection

@section('css')
<style>

</style>
@endsection

@section('content')

        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">Shopping Cart<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->
            <div class="page-content">
            	<div class="cart">
	                <div class="container">
	                	<div class="row">
	                		<div class="col-lg-12">
	                			<table class="table table-cart table-mobile reset-table">
                                    <div class="added"></div>
									<thead>
										<tr>
											<th>Product</th>
											<th>Regular Price</th>
											<th>Discount</th>
											<th>Price</th>
											<th>Quantity</th>
											<th>Total</th>
											<th></th>
										</tr>
									</thead>

									<tbody>
                                        @foreach( $cartItems as $key)
										<tr>
											<td class="product-col">
												<div class="product">
													<figure class="product-media">
														<a href="#">
															<img src="{{asset('image/' . $key->products->main_image)}}" alt="Product image">
														</a>
													</figure>

													<h3 class="product-title">
														<a href="{{route('products', $key->products->slug)}}">{{ $key->products->name }}</a>
													</h3><!-- End .product-title -->
												</div><!-- End .product -->
											</td>
											<td>
												{{  $key->products->regular_price  }} BDT
											</td>
											<td class="">
												@if ( $key->products->offer_price)
													{{  $key->products->regular_price - $key->products->offer_price }} BDT
												@else
													00.00
												@endif
											</td>
											<td class="price-col"> 
												@if ( $key->products->offer_price)
													{{ $key->products->offer_price }} BDT
												@else
													{{  $key->products->regular_price  }} BDT
												@endif
											</td>
											<td class="quantity-col">
                                                <div class="cart-product-quantity">
                                                    <input type="number" class="form-control product-qty" data-id="{{ $key->id }}" value="{{$key->cart_qty}}" min="1" max="10" step="1" data-decimals="0" required>
                                                </div><!-- End .cart-product-quantity -->
                                            </td>
											<td class="total-col">
												@if ( $key->products->offer_price)
												{{ $key->cart_qty *  $key->products->offer_price }} BDT
												@else
												{{ $key->cart_qty *  $key->products->regular_price  }} BDT
												@endif
											</td>
											<td class="remove-col">
                                                <form action="{{route('cart.delete' , $key->id )}}" method="POST">
                                                    @csrf 
                                                    <button type="submit" class="btn-remove"  ><i class="icon-close"></i></button>
                                                </form>
                                            </td>
										</tr>
                                        @endforeach
									
									</tbody>
                                </table><!-- End .table table-wishlist -->
                                    @if( $cartItems->count() == 0)
                                        <div class="alert alert-info mb-4 text-center">
                                            Your cart item is empty
                                        </div>
                                    @endif

	                			<div class="cart-bottom d-flex justify-content-between">
			            			<div class="cart-discount">
			            				<form action="#">
			            					<div class="input-group">
				        						<input type="text" class="form-control" required placeholder="coupon code">
				        						<div class="input-group-append">
													<button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
												</div><!-- .End .input-group-append -->
			        						</div><!-- End .input-group -->
			            				</form>
			            			</div><!-- End .cart-discount -->



									<div class="col-lg-3">
										<div class="summary summary-cart">
											<h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

											<table class="table table-summary">
												<tbody>
													<tr class="summary-subtotal">
														<td>Subtotal:</td>
														<td>৳ {{ App\Models\Cart::totalPrice() }}</td>
													</tr><!-- End .summary-subtotal -->
													<tr class="summary-shipping">
														<td>Shipping:</td>
														<td>&nbsp;</td>
													</tr>

													<tr class="summary-shipping-row">
														<td>
															<div class="custom-control custom-radio">
																<input type="radio" id="free-shipping" name="shipping" class="custom-control-input">
																<label class="custom-control-label" for="free-shipping">Free Shipping</label>
															</div><!-- End .custom-control -->
														</td>
														<td>$0.00</td>
													</tr><!-- End .summary-shipping-row -->

													
													

													<tr class="summary-total">
														<td>Total:</td>
														<td>৳ {{ App\Models\Cart::totalPrice() }}</td>
													</tr><!-- End .summary-total -->
												</tbody>
											</table><!-- End .table table-summary -->

											<a href="{{route('checkout')}}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
										</div><!-- End .summary -->

										<a href="{{url('/')}}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
									</div><!-- End .col-lg-3 -->

									

			            			
		            			</div><!-- End .cart-bottom -->
	                		</div><!-- End .col-lg-9 -->
	                		
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

@endsection

@section('js')



    <script>

    // Cart Update js code 
    $(".product-qty").on('change', function(e){
        e.preventDefault();
        let cart_val = $(this).val();
        let cart_id = $(this).data('id');
        $.ajax({
            type:"GET",
            dataType:"JSON",
            url:"{{ route('cart.quintity') }}",
            data:{
                'cart_val' : cart_val,
                'cart_id' : cart_id,
            },
            success:function(res){
                $('.added').html(res);
                if( res.status == "nothing"){
					setTimeout(() => {
						location.reload();	
					}, 2000);

					swal({
						text: "Cart has been updated",
						icon: "success",
						button: "Ok",
					});
									
                }
            }
        })
    })


</script>


@endsection