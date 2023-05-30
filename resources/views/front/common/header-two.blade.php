   <div style="color: #ffffff;background: #262626;display: flex;     height: 24px;">
     <div class="container">  <marquee onmouseover="stop()" onmouseout="start()"><strong>Welcome to  The Primal Cuts - Get 15% OFF on your first order.</strong></marquee></div>
   </div>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center">
    
   
    <div class="container d-flex align-items-center justify-content-between">

      <a href="{{url('')}}" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <img src="{{asset('assets/img/main-logo.png')}}">
      </a>


      <div class="d-flex header-right-area">
        <div class="s p-x">
          <a tooltip="Search" flow="down">
             <i class="bi bi-search" ></i>
          </a>
       
        </div>
        <div class="account-area p-x">
          @if(Auth::guest())
            <a href="{{url('login')}}"  tooltip="Account" flow="down"><i class="bi bi-person-circle"></i></a>   
          @else
            @can('isUser')
            <a href="{{url('/user/dashboard')}}"  tooltip="Account" flow="down"><i class="bi bi-person-circle"></i></a>
            @endcan
            @can('isAllowAdminManager')
              <a href="{{url('/control-area/dashboard')}}"  tooltip="Account" flow="down"><i class="bi bi-person-circle"></i></a>
            @endcan
          @endif 
        </div>
        @livewire('cart-count')
      
      </div>
   

    </div>
  </header><!-- End Header -->

  @livewire('cart-show')