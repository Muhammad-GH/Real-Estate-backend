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
        <title>Asuntokaupan alusta</title>
        <meta name="description" content="@yield('meta_description', 'Flipkoti')">
        <link rel="icon" href="{{ url('images/favicon.ico') }}">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        <!-- {{ style(mix('css/frontend.css')) }} -->

        <!-- {{ style('css/bootstrap.min.css') }}
        {{ style('https://fonts.googleapis.com/css?family=Playfair+Display:400,700,700i,900,900i&display=swap') }}
        {{ style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}
        {{ style('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css') }}
        {{ style('https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap') }}
        {{ style('css/style.css') }}-->
        {{ style('css/system_messages.css') }} 
        {{ style('css/bootstrap.min.css') }}
        {{ style('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/themes/smoothness/jquery-ui.css') }}
        {{ style('css/icomoon.css') }}
        {{ style('css/owl.carousel.min.css') }} 
        {{ style('css/owl.theme.default.css') }} 
        {{ style('css/style.css') }}
        {{ style('toastr/toastr.css') }}
        
        {{ style('http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') }}

        {{ style('https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css') }}
    {{ style('https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dropdown.min.css') }}

        @stack('after-styles')
        
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400&display=swap" rel="stylesheet">

    <style type="text/css">
    	body {margin: 0; padding: 0}
    .center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%; width:100% 
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%); text-align: center; color:#fff;font-family: 'Montserrat', sans-serif;width: 86%; 
   }
   .center p { margin-top: 0px;
    text-transform: uppercase;
    font-size: 18px;
    font-weight: 300;
    padding: 15px 0;}
   .center span {    text-transform: uppercase;
    letter-spacing: 6.5px }
   .mainbg {background:url({{ url('images/fkbg.jpg') }}) no-repeat; background-size: cover; width: 100%; height: 100%; position: absolute;}
    </style> 
    </head>
<body data-gr-c-s-loaded="true">
    

    <div class="mainbg">
    
    <div class="center">
      <img src="{{ url('images/fkLogo.png') }}" width="188" height="113">
    
      <p>Osta, remontoi tai myy asunto ilman päänsärkyä</p>
      <span>Tulossa pian</span>
    </div>
    </div>
    
    
      
    </body>
    </html>
