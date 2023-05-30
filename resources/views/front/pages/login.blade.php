@extends('front.layout.layout')
@section('title') Login @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant')
 <section id="hero" class="hero d-flex align-items-center ">
    <div class="container">
    	 @if(session()->has('flash_message_success'))
            <div class="alert alert-success alert-dismissible new" role="alert">
                <span><i class="fa fa-check"></i>{{ session('flash_message_success') }} </span>
            </div>
        @endif
	    <div class="row">
		  <div class="col-lg-3 col-md-3"></div>
	      <div class="col-lg-6 ">
                @if ($errors->any())
               <div class="alert alert-danger alert-dismissible" role="alert" style="margin-top: 20px;">
                    <ul style="list-style: none;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>   
            @endif
		  <div style="margin-top: 20px; border:1px solid #ddd; box-shadow: 1px 1px 5px #ddd; padding: 15px; background-color: #f7f7f7;">
			<div class="rightarea" style="padding: 15px;">
				<ul>
					<li class="{{'login' == request()->path() ? 'active' : ''}}"><a href="{{ route('login')}}" class="login" data-action="login1" id="s1">lOGIN</a></li>
					<li class="{{'register' == request()->path() ? 'active' : ''}}"><a href="{{ route('register') }}" class="signup " style="color: #000;" id="s">SIGNUP</a></li>
					
				</ul>
					<div id="login">
					<form method="post" action="{{ route('login') }}" id="login_form">
						@csrf
					    
                        <div class="form-group" style="    margin-top: 15px;">
                          <label>Email<sup>*</sup></label>
                            <input id="eemail" type="text" class="validationremove1 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group" style=" margin-top: 15px;">
					        <label>Password<sup>*</sup></label>

					      	<input id="password" type="password" class=" form-control @error('password') is-invalid @enderror" name="password" autocomplete="password">
                            <span toggle="#password" class="fa fa-eye field-icon toggle-password"></span>
                                 
                           
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> 
				        <div class="form-group">
		                    <input type="submit" value="Login" id="submitbtn">
						</div>	
					</form>
					<div class="login1">
					<p>
		              @if (Route::has('password.request'))
		                <a href="#">
		                  {{ __('Forgot Your Password?') }}
		                 </a>
		              @endif
		            </p>   
					</div>
				</div>
	       </div>
	       </div>
	    </div>
	    <div class="col-lg-3 col-md-3"></div>
    </div>
</section>
@endsection