<head>
   <meta charset="UTF-8" />
   <title>@yield('title') | The Primal Cuts</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <meta name="keyword" content="@yield('keyword')">
   <meta name="description" content="@yield('description')">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  
   <link rel="shortcut icon" href="{{asset('logo.png')}}" type="image/x-icon"/>

   <!-- Google Fonts -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

   <!---css-->
   <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
   <!-- Vendor CSS Files -->
  
   <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
   <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
   <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
   <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
   <link href="{{asset('assets/vendor/tooltip/tooltip.css')}}" rel="stylesheet">
   <link rel="stylesheet" href="{{asset('assets/dist/css/datatable.css')}}">
   <!-- Template Main CSS File -->
   <link href="{{asset('assets/css/main.css')}}" rel="stylesheet">
      @livewireStyles
   <!-- Template Main JS File -->
   <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}" type="text/javascript"></script>
   <script src="{{asset('assets/js/main.js')}}"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>