<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>CalTex Music</title>
    <link rel="stylesheet" href="{{ URL::asset('public/web/assets/css/global.css') }}">
    @yield('css') <!-- We can append new page specific css here -->
</head>

<body>
<input type="hidden" id="baseUrl" name ="baseUrl" value="{{url('/')}}"> 
    <div class="bodyWrapper">
        <!-- sidebar menu  start -->
        @include('web.includes.sidebar')
        <!-- sidebar menu end-->
        <!-- header  start-->
        @if(Auth::guard('customers')->check())
       @include('web.includes.header')
       @else
         @include('web.includes.outer-header')
       @endif
        <!-- header  end-->
        
        <!--- Here all pages render dynamically-->
         @yield('body')
       
      
        <!-- center Wrapper end-->
    </div>
    <!-- body Wrapper closed-->
</body>
    

<script src="{{ URL::asset('public/web/assets/js/plugins/jquery.min.js') }}"></script>
<script src="{{ URL::asset('public/web/assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('public/web/assets/js/plugins/owl.carousel.min.js') }}"></script>
<script src="{{ URL::asset('public/web/assets/js/plugins/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ URL::asset('public/web/assets/js/plugins/jquery.validate.min.js') }}"></script>

<!-- pages js-->
<script src="{{ URL::asset('public/web/assets/js/pages/ripple.js') }}"></script>
<script src="{{ URL::asset('public/web/assets/js/pages/header.js') }}"></script>
<script src="{{ URL::asset('public/web/assets/js/pages/login.js') }}"></script>
<script src="{{ URL::asset('public/web/assets/js/pages/scroll.js') }}"></script>
<script src="{{ URL::asset('public/web/assets/js/pages/custom-slider.js') }}"></script>

<script src="{{ URL::asset('public/web/assets/js/pages/common-validation.js') }}"></script>
<script src="{{ URL::asset('public/web/assets/js/language/lang.js') }}"></script>
 
@yield('js') <!-- We can append new page specific jss here -->

 @if(!Auth::guard('customers')->check())
       @include('web.includes.signupModels')
       @endif
       @include('web.includes.contentModal')
</html>