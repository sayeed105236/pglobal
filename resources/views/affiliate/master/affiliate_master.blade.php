<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL('resources/backend/assets/images/favicon.png')}}">
    <title>@yield('title')</title>
    <link href="{{asset('resources/backend/assets/libs/flot/css/float-chart.css')}}" rel="stylesheet">
    <link href="{{asset('resources/backend/dist/css/style.min.css')}}" rel="stylesheet">
    <link href="{{asset('resources/backend/css.css')}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7e9cbdcf79.js" crossorigin="anonymous"></script>
    <link href="{{asset('resources/views/backend/master/css.css')}}" rel="stylesheet">

    @yield('css')
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-sidebartype="mini-sidebar">

@include('affiliate.master.header')
@include('affiliate.master.sidebar')
        
    @yield('body')

    </div>
@include('affiliate.master.footer')
@include('sweetalert::alert')


    @yield('script')
</body>
</html>