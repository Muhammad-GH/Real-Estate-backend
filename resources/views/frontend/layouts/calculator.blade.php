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
        <!-- <link rel="icon" href="{{ url('images/favicon.ico') }}"> -->
        <link rel="shortcut icon" sizes="16x16 24x24 32x32 48x48 64x64" href="{{ url('images/favicon/favicon.ico') }}">
        <link rel="apple-touch-icon" sizes="57x57" href="{{ url('images/favicon/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ url('images/favicon/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ url('images/favicon/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ url('images/favicon/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ url('images/favicon/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ url('images/favicon/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ url('images/favicon/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ url('images/favicon/apple-icon-180x180.png') }}">
    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
    <!-- {{ style(mix('css/frontend.css')) }} -->
        {{ style('css/3bootstrap.min.css') }}
        {{--{{ style('css/bootstrap.min.css') }}--}}
        {{ style('https://fonts.googleapis.com/css?family=Playfair+Display:400,700,700i,900,900i&display=swap') }}
        {{ style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}
        {{ style('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css') }}
        {{ style('https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap') }}
        {{ style('css/style-old.css') }}
        {{ style('css/style.css') }}
        {{ style('css/icomoon.css') }}
        {{ style('css/system_messages.css') }}
        {{ style('https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css') }}

        @stack('after-styles')
		
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TZBZFDZ');</script>
<!-- End Google Tag Manager -->
    </head>
    <body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TZBZFDZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
       
    @include('frontend.includes.calculator-nav')
    <!-- <div class="container"> -->
    <!-- @include('includes.partials.messages') -->
    @yield('content')
    <!-- </div> -->
        <!-- container -->
        @include('frontend.includes.footer')
        @include('frontend.includes.gdrp')



    <!-- Scripts -->
    @stack('before-scripts')
    <!-- {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!} -->
    {!! script('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') !!}
    {!! script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js') !!}
    {!! script('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js') !!}
    {!! script('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js') !!}
    {!! script('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js') !!}
    {!! script('https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js') !!}
    {!! script(mix('js/frontend.js')) !!}
    @stack('after-scripts')

    @include('includes.partials.ga')

    @include('sweetalert::alert')

<script>
    $(document).on('change','.cust-select',function(){
        $('#langform input[type="submit"]').trigger('click');
    });
</script>
    </body>
    </html>
