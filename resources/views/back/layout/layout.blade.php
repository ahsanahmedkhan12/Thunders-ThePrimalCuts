<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   @include( 'back.common.head' )
<body id="body" class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		@include( 'back.common.header' )

		@yield('contant')

		@include( 'back.common.footer' )
    </div>
    <script type="text/javascript">
    	window.setTimeout(function() {$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 30000);
	
	
    </script>
</body>
</html>