<!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="container">
      <div class="copyright">
         Copyright &copy; <script>document.write(new Date().getFullYear());</script> <strong><span>The Primal Cuts</span></strong>. All Rights Reserved
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>


<script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
<script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
<script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
<script src="{{asset('assets/dist/js/datatable.js')}}"></script>


<script type="text/javascript">

     window.addEventListener('Swal',function(e){
        Swal.fire(e.detail);
      });

  var cartOpen = false;
var numberOfProducts = 0;

$('body').on('click', '.js-toggle-cart', toggleCart);


function toggleCart(e) {
  e.preventDefault();
  if(cartOpen) {
    closeCart();
    return;
  }
  openCart();
}

function openCart() {
  cartOpen = true;
  $('body').addClass('open');
}

function closeCart() {
  cartOpen = false;
  $('body').removeClass('open');
}


$(document).ready(function() {
     $(".ser-next").hide();
  $(".services-sub-nav").on('scroll', function() {
      $val = $(this).scrollLeft();
    
        
      if($(this).scrollLeft() + $(this).innerWidth()>=$(this)[0].scrollWidth){
          $(".ser-next").hide();
        } else {
        $(".ser-next").show();
      }

      if($val == 0){
        $(".ser-prev").hide();
         $('.ser-prev').removeClass('flex');
      } else {
        $(".ser-prev").show();
         $('.ser-prev').addClass('flex');
      }
    });
  console.log( 'init-scroll: ' + $(".ser-next").scrollLeft() );
  $(".ser-next").on("click", function(){
    $(".services-sub-nav").animate( { scrollLeft: '+=460' }, 200);
    
  });
  $(".ser-prev").on("click", function(){
    $(".services-sub-nav").animate( { scrollLeft: '-=460' }, 200);
  });
});

 $(document).ready(function() {
    $(".toggle-password").click(function() {
      $(this).toggleClass("bi bi-eye-slash-fill");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
     $(".toggle-userpassword").click(function() {
      $(this).toggleClass("bi bi-eye-slash-fill");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password"); 
      }
    });

    $(".toggle-confirmpassword").click(function() {
      $(this).toggleClass("bi bi-eye-slash-fill");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
     
      }
    });
    
      });

</script>
@livewireScripts