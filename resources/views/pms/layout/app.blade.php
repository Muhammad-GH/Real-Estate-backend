<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

        @stack('before-styles')


        {{ style('css/system_messages.css') }} 
        {{ style('pms_content/css/bootstrap.min.css') }}
        
        {{ style('pms_content/css/icomoon.css') }}
        {{ style('pms_content/css/style.css') }}
        {{ style('toastr/toastr.css') }}
        
        {{ style('http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') }}
        <style>
        .main-content .sidebar .nav .nav-item .sub-nav {
            margin-top: 0;
        }
        .loader-parent{
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            background: black;
            z-index: 999;
            opacity: 0.4;
        }
        .loader {
            margin: 0 auto;
            top: 40%;
            position: relative;
            border: 16px solid #f3f3f3; /* Light grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        </style>

        @stack('after-styles')
    </head>
    <body>
        <?php
            if(!function_exists('translateText')){
                $langtextarr = Session::get('langtext');
                 function translateText($langtextarr1,$text){
                     return $text;
                     foreach($langtextarr1 as $key => $value){

                        if(in_array($text, $value)){
                            
                            if(Session::get('locale') == 'en'){
                                return $langtextarr1[$key][1];
                            }
                            else{
                                return $langtextarr1[$key][0];    
                            }
                            break;
                        }
                    } 
                }
            }
        ?>
        
        <div id="app">
            @include('pms.layout.partials.header')
            @include('pms.layout.partials.breadcrumb')
            @php if(isset($chat)){ @endphp
            @include('pms.layout.partials.chatgroup')
            @php }else{ @endphp    
            @include('pms.layout.partials.nav')
            @php } @endphp    
            
            <!-- <div class="container"> -->
            <div class="page-content">
            @include('pms.layout.partials.messages')
            @yield('content')
            </div>
            <!-- </div> -->
            <!-- container -->
            @include('pms.layout.partials.footer')
            <div class="loader-parent">
                <div class="loader"></div>
            </div>

        </div><!-- #app -->

        <!-- Scripts -->
        @stack('before-scripts')

        
        {!! script('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') !!}
        {!! script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js') !!}

        {!! script('https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js') !!}
        {!! script('https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js') !!}

        {!! script('pms_content/js/jquery.min.js') !!}     
        
        <!-- custom js file -->
        {!! script('pms_content/js/custom.js') !!}     
        
        <!-- bootstrap js -->
        {!! script('pms_content/js/popper.min.js') !!}     
        {!! script('pms_content/js/bootstrap.min.js') !!}     
        {!! script('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js') !!}
        {!! script('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js') !!}
    
        <script>
            function showLoader(){
                $(document).find('.loader-parent').show();
            }
            function hideLoader(){
                $(document).find('.loader-parent').hide();
            }

            showLoader();
            setTimeout(function(){
                hideLoader();
            },1500);
        </script>
        @stack('after-scripts')

        @include('sweetalert::alert')


    </body>
</html>

