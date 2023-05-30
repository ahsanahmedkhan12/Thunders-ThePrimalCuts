@extends('front.layout.layout')
@section('title') Halal Meat Delivery karachi | The Primal Cuts @endsection
@section('keyword')   @endsection
@section('description')   @endsection
@section('contant')
  <!-- ======= Hero Section ======= -->
  <div class="slides-1 swiper" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="{{asset('assets/img/banner-1.jpg')}}" width="100%" data-aos="zoom-out" data-aos-delay="200">
      </div>
      <div class="swiper-slide">
        <img src="{{asset('assets/img/banner-2.jpg')}}" width="100%" data-aos="zoom-out" data-aos-delay="200">
      </div>
     
    </div>
    <div class="swiper-pagination"></div>
  </div>
  <div class="videoarea" >
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mainvideoarea"  data-aos="fade-up" data-aos-delay="100">
        <div class="d-flex titlevideo"><h5 style="margin: 0px;">Quick Video of Menu The Primal Cuts</h5></div>
         <div class="d-flex justify-content-center" > 
           <div class="whatsapparea d-flex">
             <a href="//api.whatsapp.com/send?phone=+923092680223&text=Hi" title="Share on whatsapp" target="_blank"><i class="bi bi-whatsapp"></i> Whatsapp !</a>
           </div>
           <div class="d-flex">
              <a href="#" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
           </div> 
          </div>
      </div>
    </div>
  </div>
  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>About Us</h2>
          <p><strong>Learn More <span> About Us</span></strong> </p>
        </div>

        <div class="row gy-4">
          <div class="col-lg-4 col-md-5 position-relative about-img" style="background-image: url(assets/img/about-img.jpg) ; background-repeat: no-repeat;background-position: top;background-size: contain;" data-aos="fade-up" data-aos-delay="150">
           
          </div>
          <div class="col-lg-8 col-md-7 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="content ps-0 ps-lg-5">
              <h6 class="fst-italic">
                EXPERIENCE THE AWARD WINNING TASTE THAT COMES WITH THE BEST HALAL FOOD IN LONG ISLAND, NEW YORK AND NEW JERSEY!
              </h6>
              <p>After serving New York for so many years we realized that our customers loved us so much, we decided to open up additional locations. That desire to expand has allowed us to bring that same quality Halal food over to our other locations as well. Everything we make at The Primal Cuts is made using only the freshest and highest quality ingredients available. That includes every vegetable we use, halal meat we cook, and every dessert we offer.</p>
              <p>
                At The Primal Cuts we pride ourselves in ensuring that your food is prepared with the utmost care and attention to detail. It is why that The Primal Cuts was voted “The Best Halal Food in Manhattan, “ and that we can also proudly say that we won “The Best meat Category in the Vendy Awards.” We only believe in delivering the finest quality halal food to our customers. The Primal Cuts branch provides customers with more than just a memorable meat experience. We also offer the best Halal booking services around! The Primal Cuts offers Halal meat in karachi.
              </p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->
   
                      
    <!-- ======= resturants Section ======= -->
    <section id="resturants" class="resturants section-bg">
      <div class="container" data-aos="fade-up">
        <div class="row gy-4">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="why-box">
              <h3>Why Choose The Primal Cuts?</h3>
              <p>
                The Primal Cuts is a great choice for those who are looking for delicious, high-quality halal meat. With a commitment to using only the freshest ingredients and preparing each dish with care, The Primal Cuts offers a wide range of flavorful options that are sure to satisfy any appetite. Whether you're in the mood for a classic gyro, juicy chicken over rice, or a tasty falafel wrap, The Primal Cuts has something for everyone.</p>
               <a href="{{url('/branches')}}" class="" style="display: flex;justify-content: center;margin-top: 25px;background: #fff;padding: 5px 0px;border-radius: 50px;color: #000;font-size: 16px;box-shadow: 1px 1px 6px #ccc;"><i class="bi bi-house" style="margin-right:5px"></i> GOTO BRANCH</a>
              </p>
             
            </div>
          </div><!-- End Why Box -->

          <div class="col-lg-8  ">
            <div class="box">
                <h5>WELCOME TO THE PRIMAL CUTS</h5>
                <h6>WE OFFERS MORE THAN JUST THE BEST HALAL MEAT DELIVER IN KARACHI</h6>
                <p>Everything we serve is carefully selected & prepared with care, and that’s just one of the many reasons why The Primal Cuts was voted as “the best Halal meat in Manhattan.</p>

                <p>We’ve also won an award in the “Best Meat category in the Vendy Awards.” The Primal Cuts is proud to serve authentic halal meat through our locations in Long karachi</p>
              </div>
            <div class=" gy-4 d-flex align-items-center">
              <div class="slides-1 swiper " data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper ">
                  @forelse($branch as $key => $branchdata)
                  <div class="swiper-slide  ">
                    <div class="" data-aos="fade-up" data-aos-delay="200">
                        <div class="resturants-box">
                          <div class="row  gy-4">
                            <div class="col-lg-6 col-md-6 col-12 ">
                                <img src="{{$branchdata->imagePath}}" class="img-fluid">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 d-flex align-items-center justify-content-center">
                              <div class="resturants-box-right">
                                <h4 style="padding-top:10px;">{{Str::title($branchdata->name)}}</h4>
                                <p style="margin-bottom: 5px;font-size: 16px;color: #6e6e6e;">{{Str::title($branchdata->address)}}</p>
                                <p style="margin-bottom: 10px;font-size: 14px;font-weight: 600;">Tuesday - Sunday 12:00 pm – 10:00 pm</p> 
                                <div class="d-flex align-items-center justify-content-center" style="    margin: 10px 0px;"> 
                                <a href="{{ url('/branch/'.$branchdata->slug) }}" class="btn-book">Order Now</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                
                  @empty
                    <div class="swiper-slide  ">
                      <div class="" data-aos="fade-up" data-aos-delay="200">
                          <div class="resturants-box">
                             <div style="text-align: center;">
                                <img src="{{asset('assets/img/nodata.svg')}}" width="150px">
                                <div style="font-size: 16px;font-weight: 600;margin: 20px 0px;">No Data</div>
                            </div>
                          </div>
                      </div>
                    </div>
                    
                  @endforelse
                </div>
                <div class="swiper-pagination"></div>
              </div>
            
            </div>
              
          </div>
        </div>
      </div>
    </section><!-- End Why Us Section -->

   
    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Categories</h2>
             <p><strong>Check Our <span>Halal Meat Categories</span><strong></p>
        </div>


        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
         
          <div class="tab-pane fade active show">
            <div class="row gy-5">
              @forelse($category as $key => $cat)
              <div class="col-lg-4 menu-item">
                <a href="{{$cat->imagePath}}" class="glightbox"><img src="{{$cat->imagePath}}" class="menu-img img-fluid" alt=""></a>
                <h4 style="font-weight: 700;"> <a href="{{ url('/branches') }}">{{$cat->name}}</a></h4>
                <p class="ingredients">
                  {{ Str::limit($cat->description, 35) }}
                </p>

            </div>
            @empty
         <div class="tab-pane fade active show">
           No Category Found
         </div>
        @endforelse
   
          </div><!-- End Starter Menu Content -->
        </div>
        
      </div>
    </section><!-- End Menu Section -->

   <!-- ======= ourfood Section ======= -->
    <section id="ourfood" class="why-us section-bg-primary">
      <div class="container" data-aos="fade-up">

         <div class="row gy-4">
           <div class="col-lg-8 col-md-7 d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="content ps-0 ps-lg-5" style="color:#fff;">
              <h6 class="fst-italic">
                RELISH AUTHENTIC HALAL MEAT AT THE PRIMAL CUTS
              </h6>
              <p>At The Primal Cuts, we take immense pride in ensuring that our food is prepared with the utmost care and detail. Our extensive menu consists of platters, gyros, wraps, and more, prepared with 100% halal meat and fresh and locally sourced ingredients. Visit us in Manhattan, NY, Long Island, NY, or Jersey City, New Jersey for a quick bite for lunch or to dine in with your friends or family to indulge in authentic and delicious halal food.</p>
              <p>
                We offer a wide array of signature meals and dishes, from mouthwatering halal chicken served with rice and drizzled with a delicious white sauce to Baba Ghanoush and jumbo smoked and grilled wings. You can also savor the delectable lamb chops, that are marinated and grilled with Rosemary butter to perfection and are served with mashed potatoes or roasted vegetables at our Long Island and Jersey City outlets.
              </p>
              <p>We also have a variety of options for vegetarians, including platters and falafel sandwiches with falafels seasoned and fried to perfection. We also offer takeout and delivery options in addition to dine-in options. Stop by The Primal Cuts to try our delicious halal food options and we guarantee The Primal Cuts will become your next favorite go-to spot.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-5 position-relative about-img" style="background-image: url(assets/img/about-img.jpg) ; background-repeat: no-repeat;     background-position: top; background-size: contain; background-attachment: fixed;" data-aos="fade-up" data-aos-delay="150">
           
          </div>
         
        </div>

      </div>
    </section><!-- End ourfood Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>gallery</h2>
          <p><strong>Check <span>Our Gallery</span></strong></p>
        </div>

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-1.jpg"><img src="assets/img/gallery/gallery-1.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-2.jpg"><img src="assets/img/gallery/gallery-2.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-3.jpg"><img src="assets/img/gallery/gallery-3.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-4.jpg"><img src="assets/img/gallery/gallery-4.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-5.jpg"><img src="assets/img/gallery/gallery-5.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="assets/img/gallery/gallery-6.jpg"><img src="assets/img/gallery/gallery-6.jpg" class="img-fluid" alt=""></a></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Gallery Section -->

       <!-- ======= ourfood Section ======= -->
    <section id="catering" class="catering">
      <div class="container" data-aos="fade-up">

         <div class="row gy-4">
           <div class=" d-flex" data-aos="fade-up" data-aos-delay="300">
            <div class="content ps-0 ps-lg-5" style="color:#fff;">
              <h6 class="fst-italic">
                RELISH AUTHENTIC HALAL MEAT AT THE PRIMAL CUTS
              </h6>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End ourfood Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact</h2>
          <p><strong> Need Help? <span>Contact Us</span> </strong> </p>
        </div>
        @livewire('contact-user')

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
@endsection