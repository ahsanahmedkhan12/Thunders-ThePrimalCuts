<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   @include( 'front.common.head-two' )
<body id="body">
	@include( 'front.common.header-two' )

	@yield('contant')

	@include( 'front.common.footer' )
	 <script type="text/javascript">
    	window.setTimeout(function() {$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 30000);
      window.livewire.on('closemodal', () => {
         $(".closemodal").modal('hide');  
      });
      window.livewire.on('cartOpen', () => {
            cartOpen = true;
            $('body').addClass('open'); 
      });
    
    </script>
</body>
</html>