<header>
    <div class="container">
        <nav class="navbar navbar-inverse">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('frontend.index') }}" ><img src="{{url('/img/frontend/logo-white.png')}}"></a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown {{ active_class(Route::is('frontend.buying')) }}  {{ active_class(Route::is('frontend.sale')) }} ">
                        <a class="dropdown-toggle " data-toggle="dropdown" href="javascript:void(0);">@lang('navs.frontend.sale')<i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('frontend.sale') }}">@lang('navs.frontend.leave_note')</a></li>
                            <li><a href="{{ route('frontend.buying') }}">@lang('navs.frontend.apartment_sale')</a></li>

                        </ul>
                    </li>
                    <li class="dropdown {{ active_class(Route::is('frontend.sell')) }} {{ active_class(Route::is('frontend.sell_ad'))  }}   ">
                        <a class="dropdown-toggle " data-toggle="dropdown" href="javascript:void(0);">@lang('navs.frontend.sell')<i class="fa fa-caret-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('frontend.sell') }}">@lang('navs.frontend.sell_ad')</a></li>
                            <li><a href="{{ route('frontend.sell_ad') }}">@lang('navs.frontend.sell_flipkod')</a></li>
                            <li><a href="{{ route('frontend.sell_property') }}">Osto-Ilmoitukset</a></li>
                        </ul>
                    </li>
                    <li class="{{ active_class(Route::is('frontend.stationing')) }}" ><a href="{{ route('frontend.stationing') }}" >@lang('navs.frontend.stationing')</a></li>
                    <li class="{{ active_class(Route::is('frontend.about_us')) }}" ><a href="{{ route('frontend.about_us') }}" >@lang('navs.frontend.about_us')</a></li>
                    @guest
                    <li class="{{ active_class(Route::is('frontend.auth.login')) }}" ><a href="{{ route('frontend.auth.login') }}" >@lang('labels.frontend.auth.login_box_title')</a></li>
                    @else
                        <li class="dropdown loggedin {{ active_class(Route::is('frontend.user')) }} {{ active_class(Route::is('frontend.user'))  }}   ">
                            <a class="dropdown-toggle " data-toggle="dropdown" href="javascript:void(0);"><i class="fa fa-user-circle-o"></i> {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}<i class="fa fa-caret-down"></i></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('frontend.user.account') }}" class="dropdown-item {{ active_class(Route::is('frontend.user.account')) }}">@lang('navs.frontend.user.account')</a>
                                </li>
                                @can('view backend')
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item">@lang('navs.frontend.user.administration')</a>
                                    </li>
                                @endcan
                                <li>
                                    <a href="{{ route('frontend.auth.logout') }}" class="dropdown-item">@lang('navs.general.logout')</a>
                                </li>
                            </ul>
                        </li>

                    @endguest
                    <!--
                    @if(config('locale.status') && count(config('locale.languages')) > 1)
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLanguageLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.language-picker.language') ({{ strtoupper(app()->getLocale()) }})</a>

                            @include('includes.partials.lang')
                                </li>
@endif
                            -->
                </ul>
            </div>
        </nav>
    </div>
</header>