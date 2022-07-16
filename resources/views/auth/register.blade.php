@extends('frontend.layout.template')

@section('title')
    <title>Asmy BD - Register</title>
    <meta name="keywords" content="register">
    <meta name="description" content="asmy BD Register page">
@endsection
@section('content')

        <main class="main">

            <div class="login-page pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17">
            	<div class="container">
            		<div class="form-box">
            			<div class="form-tab">
	            			<ul class="nav nav-pills nav-fill" role="tablist">
							    <li class="nav-item">
							        <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Sign In</a>
							    </li>
							    <li class="nav-item">
							        <a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
							    </li>
							</ul>
							<div class="tab-content">



							    <div class="tab-pane fade" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
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

							    <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
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
            	</div><!-- End .container -->
            </div><!-- End .login-page section-bg -->
        </main><!-- End .main -->





      

     


@endsection
