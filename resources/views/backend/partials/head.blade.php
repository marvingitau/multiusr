<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{general_setting()->title}} | @yield('title','admin')</title>

    <link rel="shortcut icon" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="shortcut icon" href="{{asset('assets/favicon.png')}}">

    <link rel="stylesheet" href="{{asset('assets/plugin/bootstrap-4.0.0/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugin/jquery-ui-1.12.1/jquery-ui.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugin/font-awesome/css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{asset('assets/backend/css/select2.css')}}">

    <link rel="stylesheet" href="{{asset('assets/backend/css/bootadmin.css')}}">

    <link rel="stylesheet" href="{{asset('assets/backend/css/custom.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugin/toastr/build/toastr.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugin/iziToast/dist/css/iziToast.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/plugin/bootstrap-toggle/css/bootstrap2-toggle.min.css')}}">

    <link href="{{url('/')}}/assets/backend/css/color.php?color={{general_setting()->color}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&display=swap" rel="stylesheet"> 
    @yield('style')

</head>