@extends('front.layout.layout')
@section('title') user register @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant')
<section id="hero" class="hero d-flex align-items-center ">
    <div class="container">
    @if(session()->has('error'))
	<div class="alert alert-danger alert-dismissible" role="alert" x>
		<span><i class="fa fa-wronge"></i>{{ session('error') }}</span>
	</div>
    @endif 
    
  <div class="row">
	<div class="col-lg-3 col-md-1"></div>
	<div class="col-lg-6">
        <div style="margin-top: 20px; border:1px solid #ddd; box-shadow: 1px 1px 5px #ddd; padding: 15px;background-color: #f7f7f7;">
			<div class="rightarea" style="padding: 15px;">
				<ul>
					<li class="{{'login' == request()->path() ? 'active' : ''}}"><a href="{{ route('login')}}" class="login" data-action="login1" style="color: #000;" id="s1">lOGIN</a></li>
					<li class="{{'register' == request()->path() ? 'active' : ''}}"><a href="{{ route('register') }}" class="signup " style="color: #fff;" id="s">SIGNUP</a></li>
				</ul>
			    <div id="signup">
					<form method="post" action="{{ route('register') }}" id="register_form">
					@csrf
					<div class="form-group" style="    margin-top: 15px;">
						<label>Full Name<sup>*</sup></label>
						<input id="nname" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                        @error('name')
			                <span class="invalid-feedback" role="alert">
			                    <strong>{{ $message }}</strong>
			                </span>
			             @enderror
		            </div>
		            <div class="form-group" style="    margin-top: 15px;">  
						<label>Email<sup>*</sup> <span style="    color: #8b8b8b;font-size: 12px;">Ex.John@domain.com</span></label>
						<input id="eemail" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  >
		            
			            @error('email')
			                <span class="invalid-feedback" role="alert">
			                    <strong>{!! $message !!}</strong>
			                </span>
			            @enderror
		            </div> 
		            <div class="form-group" style="    margin-top: 15px;">       
			            <label>Phone<sup>*</sup> <span style="    color: #8b8b8b;font-size: 12px;">Ex.03243123456</span></label>
					    <input id="pphone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"  value="{{ old('phone') }}" >
		  
			            @error('phone')
			                <span class="invalid-feedback" role="alert">
			                    <strong>{!! $message !!}</strong>
			                </span>
			             @enderror 
		            </div>    
		            <div class="form-group" style="margin-top: 15px;">   
						<label>Password<sup>*</sup></label>
		                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="password">
		                <span toggle="#password" class="d-flex bi bi-eye-fill field-icon toggle-userpassword"></span>
		                @error('password')
		                    <span class="invalid-feedback" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror 
		            </div>
		            <div class="form-group" style="    margin-top: 15px;">     
						<label>Confirm Password<sup>*</sup></label>
		                <input id="passwordconfirm" type="password" class="form-control" name="password_confirmation"  autocomplete="password_confirmation">
		                <span toggle="#passwordconfirm" class="d-flex bi bi-eye-fill field-icon toggle-confirmpassword"></span>               
		            </div>    
					<P>by sign-in, you agree to our <a href="#">Terms</a> and <a href="#"> Privacy Policy</a></P>
				    <input type="submit" value="Sign Up" id="submitbtn">
				    </form>
					               
				</div>
			</div>  
		</div>
	</div>
	<div class="col-lg-3 col-md-1"></div>
	</div>	
</div>
</section>
@endsection
