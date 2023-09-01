<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
    <meta property="og:title" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
    <meta property="og:description" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
    <meta property="og:image" content="https://davur.dexignzone.com/dashboard/social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <title>Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <link href="{{asset('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendor/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
	<link href="{{asset('assets/vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">
	 <link rel="stylesheet" href="{{asset('assets/vendor/swiper/css/swiper-bundle.css')}}">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
	<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

    @yield('css')
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->

    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper" class="overflow-unset">

        @include('admin.layout.header')
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-wrapper">
            <!-- row -->
            <div class="container-fluid">
                @include('admin.layout.errors')
                @include('admin.layout.status')
                @yield('content')
            </div>
        </div>



    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->

    @yield('modal')
    <script src="{{asset('assets/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
	
	<!-- Counter Up -->
    <script src="{{asset('assets/vendor/waypoints/jquery.waypoints.min.j')}}"></script>
    <script src="{{asset('assets/vendor/jquery.counterup/jquery.counterup.min.js')}}"></script>	
	
	<script src="{{asset('assets/vendor/owl-carousel/owl.carousel.js')}}"></script>
	<script src="{{asset('assets/vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>

    <script src="{{asset('assets/js/custom.js')}}"></script>
	<script src="{{asset('assets/js/deznav-init.js')}}"></script>

    @yield('script')



</body>

</html>
