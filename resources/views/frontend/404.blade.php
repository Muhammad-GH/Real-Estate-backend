<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
    <head>
        <!-- Required meta tags -->

    <title>Flipkoti</title>
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'Flipkoti')">
        <link rel="icon" href="{{ url('images/favicon.ico') }}">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

         
        {{ style('css/system_messages.css') }} 
        {{ style('css/bootstrap.min.css') }}
        {{ style('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css') }}
        {{ style('css/icomoon.css') }}
        {{ style('css/owl.carousel.min.css') }} 
        {{ style('css/owl.theme.default.css') }} 
        {{ style('css/style.css') }}
        {{ style('toastr/toastr.css') }}
        
        {{ style('http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') }}


        @stack('after-styles')
        <style>
            select.cust-select {
                float: right;
                margin-left: 30px;
            }
        </style>
    </head>
    <body>
        
    <div class="not-found">
        <div class="content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-7">
                        <h2>OOPS!</h2>
                        <p>Etsimääsi sivua ei löytynyt</p>
                    </div>
                    <div class="col-sm-5">
                        <img src="{{ url('images/door.png') }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <a href="/" class="btn-back">Takaisin etusivulle</a>
        </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery.min.js"></script>
    <!-- gsap animation js -->
    <script src="js/gsap.min.js"></script>
    <!-- isotop grid js file -->
    <script src="js/isotope.pkgd.min.js"></script>

    <!-- owl carousel js-->
    <script src="js/owl.carousel.min.js"></script>

	<!-- custom js file -->
    <script src="js/custom.js"></script>

	<!-- bootstrap js -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>