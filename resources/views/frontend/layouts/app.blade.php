<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
    <head>
        <!-- Required meta tags -->

    
    
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
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:site_name" content="Flipkoti" />
        <meta property="og:locale" content="fi_FI" />
        <meta property="og:locale:alternate" content="en_US" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="@yield('title', app_name())" />
        <meta property="og:description" content="@yield('meta_description', 'Flipkoti')" />
        <meta property="og:image" content="@yield('meta_image', 'https://www.flipkoti.fi/images/meta/home.jpg')" />
        <meta property="og:image:secure_url" content="@yield('meta_image', 'https://www.flipkoti.fi/images/meta/home.jpg')" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="628" />
        <meta property="og:image:alt" content="creative web agency" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="@yield('title', app_name())" />
        <meta name="twitter:description" content="@yield('meta_description', 'Flipkoti')" />
        <meta name="twitter:image" content="@yield('meta_image', 'https://www.flipkoti.fi/images/meta/home.jpg')" />

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


        @stack('after-styles')
        <style>
            select.cust-select {
                float: right;
                margin-left: 30px;
            }
        </style>
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
        @include('includes.partials.read-only')

        <div id="app">
            @include('includes.partials.logged-in-as')
            @include('frontend.includes.nav')
            
            <!-- <div class="container"> -->
            <!-- @include('includes.partials.messages') -->
            @yield('content')
            <!-- </div> -->
            <!-- container -->
            @include('frontend.includes.footer')
            @include('frontend.includes.gdrp')
            
        </div><!-- #app -->

        <!-- Scripts -->
        @stack('before-scripts')
        <!--{!! script(mix('js/manifest.js')) !!}
        {!! script(mix('js/vendor.js')) !!}
        {!! script(mix('js/frontend.js')) !!}-->

        {!! script('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js') !!}
        {!! script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js') !!}

        {!! script('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js') !!}
        {!! script('https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js') !!}

        {!! script('https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js') !!}
        
        <!--{!! script('js/new/jquery.min.js') !!}-->
        {!! script('js/gsap.min.js') !!}
        {!! script('js/isotope.pkgd.min.js') !!}
        {!! script('js/owl.carousel.min.js') !!}
        {!! script('js/custom.js') !!}
        {!! script('js/popper.min.js') !!}
        {!! script('js/bootstrap.min.js') !!}
        {!! script('toastr/toastr.js') !!}
        {!! script('js/pagesave.js') !!}
        {!! script('ckeditor_4.14.0_full/ckeditor.js') !!}


        @stack('after-scripts')
        
        @include('includes.partials.ga')

        @include('sweetalert::alert')

    <script>
   

        const siteBaseUrl = {!! json_encode(url('/')) !!}
        const currentRoute = window.location.pathname.replace(/^\/|\/$/g, '');
        const loadingText = "{!! __('Lähetetään.') !!}";
        const errorText = "{!! __('Jokin meni pieleen. Yritä uudelleen hetken kuluttua') !!}";

    /*$(document).on('click','.makerenovation li a',function(){
        $('#cust-portion-type').html($(this).find('span').html());
    });*/
    if($("select.selectpicker").length){
        $("select.selectpicker").selectpicker();
    }
    $(document).on('click','.cust-reno-link',function(){
        $(this).closest('form').find('#reno-portion-type').val($(this).find('span').data('ref')); 
        $(this).closest('form').find('#submit-form').trigger('click');
        
    });
    $(document).on('change','.cust-select',function(){
        $('#langform input[type="submit"]').trigger('click');
    });
    $(document).on('click','.lang-link',function(){
        $('#langform input[name="lang"]').val($(this).attr('data-val'));
        $('#langform input[type="submit"]').trigger('click');
    });
</script>
@if(Auth::check() && Session::get('pages_editable'))
    <script>
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.filter.disabled = true;
        CKEDITOR.dtd.$removeEmpty.i = 0;

        if (CKEDITOR.instances['contactHeadline']) {
            CKEDITOR.remove(CKEDITOR.instances['contactHeadline']);
        }
        //  CKEDITOR.replace('contactHeadline', {
        //     fullPage :true
        // });

        // CKEDITOR.replace( 'buybanner h1' );

        var editableDiv = document.getElementById('editable');
        if(editableDiv != undefined){
            editableDiv.setAttribute('contenteditable', true);
        }
        
        CKEDITOR.inline('editable',{
                allowedContent:true,
                autoParagraph: false,
                entities:false,
                extraAllowedContent:['i']
            });

        // var elements = CKEDITOR.document.find( '.inline-editable' ),
        // i = 0,
        // element;
        
        // while ( ( element = elements.getItem( i++ ) ) ) {
        //     element.setAttribute('contenteditable', true);
        //     CKEDITOR.inline( element, {
        //         //startupFocus: true
        //         allowedContent:true,
        //         autoParagraph: false,
        //         entities:false,
        //         extraAllowedContent:['i']
        //     } );
        // }

    
            function saveContent() {
                // body...
                var htmlContent = CKEDITOR.instances.editable.getData();
                savePageContent(htmlContent);
            }

        </script>
    @else

    @endif
    <script type="text/javascript">


</script>



    </body>
</html>

