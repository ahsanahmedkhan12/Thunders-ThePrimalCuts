   <div style="color: #ffffff;background: #262626;display: flex;     height: 24px;">
     <div class="container">  <marquee onmouseover="stop()" onmouseout="start()"><strong>Welcome to The Primal Cuts - Get 15% OFF on your first order.</strong></marquee></div>
   </div>
  <div class="top-header  d-flex align-items-center">
      <div class="container d-flex align-items-center justify-content-between justify-content-centr-important">
      <div class="top-header-left-area">
        <span>Contact : </span>
        <select class="">
          @forelse($branch as $key => $brancdata)
          <option>{{ Str::limit($brancdata->name, 19) }} : {{$brancdata->phone}}</option>
          @empty
          <option>No Contact</option>
          @endforelse
        </select>

      </div>
      <div class="socialarea">
            <span>Social Icon :</span>
              <ul class="socialicon">
               
                <li><a href="{{url('https://www.facebook.com')}}"  target="_blank" tooltip="Facebook" flow="down"><i class="bi bi-facebook"></i></a></li>

                <li><a href="{{url('https://www.linkedin.com')}}"  target="_blank" tooltip="Twitter" flow="down"><i class="bi bi-twitter"></i></a></li>

                <li><a href="{{url('https://www.linkedin.com')}}"  target="_blank" tooltip="Linkedin" flow="down"><i class="bi bi-linkedin"></i></a></li>

                <li><a href="{{url('https://www.instagram.com')}}" target="_blank" tooltip="Instagram" flow="down"><i class="bi bi-instagram"></i></a></li>

               
              </ul>
            </div>  
          </div> 
    </div>
  </div>
  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center">
    
   
    <div class="container d-flex align-items-center justify-content-between">

      <a href="{{url('')}}" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <img src="{{asset('assets/img/main-logo.png')}}">
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="#hero">Home</a></li>
          <li><a href="#about">About</a></li>
          <li class="dropdown"><a href=""><span>Branch</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              @forelse($branch as $key => $brancdata)
              <li><a href="{{ url('/branch/'.$brancdata->slug) }}">{{Str::title($brancdata->name)}}</a></li>
              @empty
              <li><a href="#">No Data</a></li>
              @endforelse
            </ul>
          </li>
          <li><a href="#menu">Menu</a></li>
          <li><a href="#ourfood">Our Meat</a></li>
          <li><a href="#gallery">Gallery</a></li>
          <li><a href="#catering">Booking</a></li> 
          <li><a href="#contact">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->
      <div class="d-flex">
          <div class="d-flex header-right-area">
        <div class="search p-x">
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
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      </div>
    
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  @livewire('cart-show')