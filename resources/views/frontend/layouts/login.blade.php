<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'Flipkoti')">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        <!-- {{ style(mix('css/frontend.css')) }} -->
        {{ style('css/3bootstrap.min.css') }}
        {{ style('https://fonts.googleapis.com/css?family=Playfair+Display:400,700,700i,900,900i&display=swap') }}
        {{ style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}
        {{ style('https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap') }}
        {{ style('css/style-old.css') }}
        {{ style('css/style.css') }}
        <style>
          a.custom-link {
                color: blue;
            }  
        </style>
        @stack('after-styles')
    </head>
    <body>
        
        @include('includes.partials.read-only')

        <div id="app">
            @include('includes.partials.logged-in-as')
            @include('frontend.includes.nav_login')
            
            <!-- <div class="container"> -->
            <!-- @include('includes.partials.messages') -->
            @yield('content')
            <!-- </div> -->
            <!-- container -->
            
        </div><!-- #app -->

        <!-- Scripts -->
        @stack('before-scripts')
        <!-- {!! script(mix('js/manifest.js')) !!}
        {!! script(mix('js/vendor.js')) !!} -->
        {!! script('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') !!}
        {!! script('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js') !!}
        {!! script(mix('js/frontend.js')) !!}
        @stack('after-scripts')
        
        @include('includes.partials.ga')
    </body>
</html>
