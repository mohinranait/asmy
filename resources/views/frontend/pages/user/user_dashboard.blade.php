
@extends('frontend.layout.template')
@section('title')
    <title>user dashboard page</title>
@endsection

@section('css')
<style>

</style>
@endsection

@section('content')


        <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
        			<h1 class="page-title">My Account<span>Shop</span></h1>
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Account</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
            	<div class="dashboard">
	                <div class="container">
	                	<div class="row">
	                		<aside class="col-md-4 col-lg-3">
	                			<ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
								    <li class="nav-item">
								        <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
								    </li>
								  
								   
								    <li class="nav-item">
								        <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
								    </li>
								    <li class="nav-item">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
								        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Sign Out</a> 
                                    </form>
								    </li>
								</ul>
	                		</aside><!-- End .col-lg-3 -->

	                		<div class="col-md-8 col-lg-9">
	                			<div class="tab-content">
								    <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
								    	<!-- <p>Hello <span class="font-weight-normal text-dark">{{ Auth::user()->name  }}</span> -->
								    	<br>

                                        <div class="row">
                                            <div class="col-lg-8">
                                                <p> <span class="text-dark " style="width:100px; display:inline-block">Name </span> : {{Auth::user()->name}} </p>
                                                <p> <span class="text-dark " style="width:100px; display:inline-block">Email </span> : {{Auth::user()->email}} </p>
                                                <p> <span class="text-dark " style="width:100px; display:inline-block">Phone </span> : {{Auth::user()->phone ? Auth::user()->phone : '--'}} </p>
                                                <p> <span class="text-dark " style="width:100px; display:inline-block">Address </span> : 
                                                @if( Auth::user()->address )
                                                    {{Auth::user()->address}} , {{ Auth::user()->districts->name }} , {{Auth::user()->upzilas->name }}
                                                @else
                                                    '--' 
                                                @endif </p>
                                                <p> <span class="text-dark " style="width:100px; display:inline-block">Active Status </span> : {{ Auth::user()->status == 0 ? 'Off' : 'On'  }} </p>
                                                <p> <span class="text-dark " style="width:100px; display:inline-block">Join </span> : {{ Auth::user()->created_at->format(' d M , Y') }} </p>
                                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Edit <i class="icon-edit"></i></a>
                                            </div>
                                            <div class="col-lg-4">
                                                <img  src="{{ Auth::user()->profile ? asset('image/' . Auth::user()->profile )  :  asset('frontend/images/demo-user.png')}}" alt="">
                                            </div>
                                        </div>
								    	
								    </div><!-- .End .tab-pane -->

								    <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
								    	<p>No order has been made yet.</p>
								    	<a href="category.html" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
								    </div><!-- .End .tab-pane -->

								   

								    <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
								    	<form action="{{route('myaccount.update' , Auth::user()->id )}}" method="POST" enctype="multipart/form-data">
                                            @csrf 
			                				<div class="row">
			                					<div class="col-sm-6">
			                						<label>Full Name *</label>
			                						<input  type="text" name="name" class="form-control" value="{{Auth::user()->name ?Auth::user()->name : old('name') }}" required>
			                					</div><!-- End .col-sm-6 -->

			                					<div class="col-sm-6">
			                						<label>Email </label>
			                						<input type="text" value="{{ Auth::user()->email }}" disabled class="form-control mb-0">
                                                    <span style="font-size:11px">If you want to change email. Then contact the support team.</span>
			                					</div><!-- End .col-sm-6 -->
			                				</div><!-- End .row -->
			                				<div class="row">
			                					<div class="col-sm-6">
			                						<label>Phone *</label>
			                						<input type="number" name="phone" value="{{Auth::user()->phone ? Auth::user()->phone : old('phone') }}" class="form-control" required>
			                					</div><!-- End .col-sm-6 -->
			                					<div class="col-sm-6">
                                                <label>Address *</label>
		            						<input type="text" name="address" class="form-control" value="{{ Auth::user()->address ? Auth::user()->address : old('address') }}" required>
			                					</div><!-- End .col-sm-6 -->
			                				</div><!-- End .row -->
		            						

                                            <div class="row">
			                					<div class="col-sm-6">
                                                    <label for="">District *</label>
                                                    <select name="district" id="updateProfileDistrict" required class="form-control">
                                                        <option value="">select district</option>
                                                        @foreach( $districts as $key)
                                                        <option value="{{$key->id}}" @if( $key->id == Auth::user()->district ) selected @endif>{{$key->name}}</option>
                                                        @endforeach
                                                    </select>
			                					</div><!-- End .col-sm-6 -->
			                					<div class="col-sm-6">
                                                    <label for="">Upzila *</label>
                                                    <select name="upzila" id="updateProfileUpzila" required class="form-control">
                                                        <option value="">select Upzila</option>
                                                        @foreach( $upzilas as $key)
                                                        <option value="{{$key->id}}" @if( $key->id == Auth::user()->upzila ) selected @endif >{{$key->name}}</option>
                                                        @endforeach
                                                    </select>
			                					</div><!-- End .col-sm-6 -->			                					
			                				</div><!-- End .row -->

                                            <label for="">Profile image *</label>
                                            <br>
                                            <input type="file" name="profile" class="form-file-control"  style="width:100px;" required onchange="updateUserProfile(this);">
                                                <img class="input_display" src="{{ Auth::user()->profile ? asset('image/' . Auth::user()->profile )  :  asset('frontend/images/demo-user.png')}}" style="display:inline-block; margin-left:30px; width:50px; height:50px" alt=""> <br> <br>
                                                

		                					<button type="submit" class="btn btn-outline-primary-2">
			                					<span>SAVE CHANGES</span>
			            						<i class="icon-long-arrow-right"></i>
			                				</button>
			                			</form>
								    </div><!-- .End .tab-pane -->
								</div>
	                		</div><!-- End .col-lg-9 -->
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .dashboard -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->


@endsection

@section('js')

<script>

    $(document).ready(function(){
        $('#updateProfileDistrict').on("change" , function(e){
            e.preventDefault();
            var district_find = $('#updateProfileDistrict').val();
            // alert(district_find)
            if( district_find ){
                $.ajax({
                    url: "/user-dashboard/update/" + district_find,
                    type:'GET',
                    dataType:"json",
                    success:function(data){
                        $("#updateProfileUpzila").empty();
                        $('#updateProfileUpzila').html('<option value="">Select your updila</option>');
                        $.each(data, function(key,value){

                            $("#updateProfileUpzila").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                })
            }
        })
    })

</script>

    <script>
         function updateUserProfile(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.input_display')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection