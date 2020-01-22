<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{general_setting()->title}} - @yield('title')</title>

    <!-- site favicon -->

    <link rel="icon" type="image/png" href="{{asset('assets/favicon.png')}}" sizes="16x16">

    <!-- fontawesome css file -->

    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/fontawesome.min.css">

    <!-- flaticon css file -->

    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/flaticon.css">

    <!-- bootstrap css file -->

    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('assets/plugin/jquery-ui-1.12.1/jquery-ui.min.css')}}">

    <!-- animate css file -->

    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/animate.css">

    <!-- lightcase css file -->

    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/lightcase.css">

    <!-- owl carousel css file -->

    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/owl.carousel.min.css">

    <!-- main style css file -->

    <link rel="stylesheet" href="{{asset('assets/frontend')}}/css/style.css">

    <link rel="stylesheet" href="{{asset('assets/frontend/css/select2.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugin/iziToast/dist/css/iziToast.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugin/bootstrap-toggle/css/bootstrap2-toggle.min.css')}}">

    @yield('style')

    <link href="{{asset('assets/frontend/')}}/css/color.php?color={{general_setting()->color}}&color_2={{general_setting()->color_2}}" rel="stylesheet">

</head>

<body>



<!-- preloader start -->

{{-- <div id="preloader"></div> --}}

<!-- preloader end -->



@include('frontend.partials.header')



<div id="main-content">

@yield('content')

</div>



@include('frontend.partials.footer')



<!-- scroll-to-top start -->

<div class="scroll-to-top">

    <span class="scroll-icon">

      <i class="fa fa-angle-up"></i>

    </span>

</div>

<!-- scroll-to-top end -->



<!-- jquery library js file -->

<script src="{{asset('assets/frontend')}}/js/jquery-3.3.1.min.js"></script>

<!-- jquery migrate js file -->

<script src="{{asset('assets/frontend')}}/js/jquery-migrate-3.0.0.js"></script>

<script src="{{asset('assets/plugin/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>

<!-- bootstrap js file -->

<script src="{{asset('assets/frontend')}}/js/bootstrap.min.js"></script>

<!-- jquery waypoints js file -->

<script src="{{asset('assets/frontend')}}/js/jquery.waypoints.min.js"></script>

<!-- js file -->

<script src="{{asset('assets/frontend')}}/js/jquery.countup.min.js"></script>

<!-- jquery countup js file -->

<script src="{{asset('assets/frontend')}}/js/lightcase.js"></script>

<!-- js owl carousel file -->

<script src="{{asset('assets/frontend')}}/js/owl.carousel.js"></script>

<!-- wow js file -->

<script src="{{asset('assets/frontend')}}/js/wow.min.js"></script>

<!-- main js file -->

<script src="{{asset('assets/frontend')}}/js/main.js"></script>

<script src="{{asset('assets/plugin/select2/dist/js/select2.min.js')}}"></script>

<script src="{{asset('assets/plugin/bootstrap-toggle/js/bootstrap-toggle.min.js')}}"></script>



<script>

    $('.select2').select2({

        width:'100%',

    });

    function increaseAdView(id){

        $.ajax({

            method:'get',

            url:'{{url('/')}}/ad-click/'+id,

            success:function (data) {

                console.log(data);

            }

        })

    }

</script>

@include('frontend.partials.izi_msg')

@yield('script')



</body>

</html>