<head>
   <meta charset="UTF-8" />
   <title>@yield('title') | The Primal Cuts</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="keyword" content="@yield('keyword')">
   <meta name="description" content="@yield('description')">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" type="image/x-icon"/>
    <!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/dist/css/main.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/dist/css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('assets/dist/css/datatable.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
   <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
   <link rel="stylesheet" href="{{asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
	@livewireStyles
	<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
	
</head>