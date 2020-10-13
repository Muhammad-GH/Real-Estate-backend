<header class="header">
    <div class="logo">
        <img src="{{url('/images/flipkoti-pro.png')}}">
    </div>
    <nav class="navbar navbar-expand-md">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-down"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="javascript:void(0);">My Business</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);">
                        Marketplace 
                        <!-- <span class="badge badge-danger">2</span> -->
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="right-buttons">
        <div class="dropdown">
            @if(Session::get('locale') == 'fi')
                <a href="{{ route('lang',['lang'=>'en']) }}"  >
                    EN
                </a>
            @else
                <a href="{{ route('lang',['lang'=>'fi']) }}"  >
                    FI
                </a>
            @endif
        </div>
        <div class="dropdown">
            <a class="dropdown-toggle no-arrow" type="button" id="alert-messages" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-bell"></i>
                <span class="badge badge-danger"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alert-messages">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
        <div class="dropdown">
            <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar">
                    @php
                        $image = url('/images/dummy-user.png');
                        if(auth()->guard('pro')->check()){

                        } elseif(auth()->guard('proresource')->check() && auth()->guard('proresource')->user()->photo){
                            $image = url('/images/resources/'.auth()->guard('proresource')->user()->id.'/'.auth()->guard('proresource')->user()->photo);
                        }
                    @endphp
                    <img class="rounded-circle" src="{{ $image }}" alt="">
                </div>
                <span>
                @if(auth()->guard('pro')->check())
                    {{ auth()->guard('pro')->user()->first_name }} {{ auth()->guard('pro')->user()->last_name }}
                @elseif(auth()->guard('proresource')->check())
                    {{ auth()->guard('proresource')->user()->first_name }} {{ auth()->guard('proresource')->user()->last_name }}
                @endif
                
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                @if(auth()->guard('proresource')->check())
                    <a class="dropdown-item" href="{{ route('frontend.pms.my-account') }}">My Account</a>
                    <a class="dropdown-item" href="{{ route('frontend.pms.change-password') }}">Change Password</a>
                @endif
                <a class="dropdown-item" href="{{ route('frontend.pms.logout') }}">Logout</a>
            </div>
        </div>
    </div>
</header>
<div class="sidebar-toggle"></div>