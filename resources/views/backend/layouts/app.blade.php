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
    <meta name="author" content="@yield('meta_author', 'Flipkoti')">
    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css')) }}
    {{ style('css/developer.css') }}
    {{ style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css') }}
    {{ style('https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css') }}
    {{ style('https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dropdown.min.css') }}
    

    @stack('after-styles')

    <script src="https://cdn.ckeditor.com/4.14.0/full-all/ckeditor.js"></script> 


</head>

{{--
     * CoreUI BODY options, add following classes to body to change options
     * // Header options
     * 1. '.header-fixed'					- Fixed Header
     *
     * // Sidebar options
     * 1. '.sidebar-fixed'					- Fixed Sidebar
     * 2. '.sidebar-hidden'				- Hidden Sidebar
     * 3. '.sidebar-off-canvas'		    - Off Canvas Sidebar
     * 4. '.sidebar-minimized'			    - Minimized Sidebar (Only icons)
     * 5. '.sidebar-compact'			    - Compact Sidebar
     *
     * // Aside options
     * 1. '.aside-menu-fixed'			    - Fixed Aside Menu
     * 2. ''			    - Hidden Aside Menu
     * 3. '.aside-menu-off-canvas'	        - Off Canvas Aside Menu
     *
     * // Breadcrumb options
     * 1. '.breadcrumb-fixed'			    - Fixed Breadcrumb
     *
     * // Footer options
     * 1. '.footer-fixed'					- Fixed footer
--}}
<body class="app header-fixed sidebar-fixed aside-menu-off-canvas sidebar-lg-show">
    @include('backend.includes.header')

    <div class="app-body">
@if ($logged_in_user->isAdmin())
    @include('backend.includes.sidebar')
@else
    @include('backend.includes.sidebar_user')
@endif

        <main class="main">
            @include('includes.partials.read-only')
            @include('includes.partials.logged-in-as')
            {!! Breadcrumbs::render() !!}

            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div><!--content-header-->

                    @include('includes.partials.messages')
                    @yield('content')
                </div><!--animated-->
            </div><!--container-fluid-->
        </main><!--main-->

        @include('backend.includes.aside')
    </div><!--app-body-->

    @include('backend.includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    {!! script('https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js') !!}
    {!! script('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js') !!}
    {!! script('https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular.min.js') !!}
    {!! script('http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js') !!}
    
   
    {!! script('https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js') !!}
    {!! script('https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/components/dropdown.min.js') !!}
   
    @stack('after-scripts')
    <script>
        $(document).ready(function () {
            $('#multi_rights').parent().hide()
            $('input[name="permissions[]"]').click(function () {
                if ($('#permission-1,#permission-3').is(':checked')) {
                    $('#multi_rights').parent().show()
                } else {
                    $('#multi_rights').parent().hide()
                }
            });
        });
        $('.ui.fluid.dropdown').dropdown();
    
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.config.height = 700;
        CKEDITOR.config.width = 750;
    
</script>
@stack('scripts')
</body>
</html>
