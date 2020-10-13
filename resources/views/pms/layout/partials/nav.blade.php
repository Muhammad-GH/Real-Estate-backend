@php 
$pro_site_url = config('global_configurations.admin.pro_site_url');
@endphp
<div class="main-content">
    <div class="sidebar">
        <div class="wraper">
            <div class="scroll"></div>
            <ul class="nav flex-column">
                @if(auth()->guard('pro')->check())
                <li class="nav-item @if(isset($page) && $page == 'dashboard') active @endif ">
                    <a class="nav-link"  href="{{ $pro_site_url }}">
                        <i class="icon-dashboard"></i>Prodesk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ $pro_site_url }}#/customers-list">
                        <i class="icon-fillter"></i>Customers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ $pro_site_url }}#/proposal-listing"><i class="icon-edit-file"></i>Proposal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ $pro_site_url }}#/agreement-listing">
                        <i class="icon-materials"></i>Agreement
                    </a>
                </li>
                @endif

                @if( auth()->guard('pro')->check() )
                <li class="nav-item @if(isset($page) && $page == 'project') active open @endif ">
                    <a class="nav-link" href="javascript:void(0);">
                        <i class="icon-work"></i>Project
                    </a>
                    <ul class="sub-nav">
                        <li><a href="{{ route('frontend.pms.project.create') }}">Create Project</a></li>
                        <li><a href="{{ route('frontend.pms.project') }}">See listings</a></li>
                    </ul>
                </li>
                @endif

                @if( auth()->guard('proresource')->check() && $user_permissions && $user_permissions->view_project )
                    <li class="nav-item @if(isset($page) && $page == 'project') active open @endif ">
                        <a class="nav-link" href="javascript:void(0);">
                            <i class="icon-work"></i>Project
                        </a>
                        <ul class="sub-nav">
                            @if($user_permissions && $user_permissions->edit_project)
                                <li><a href="{{ route('frontend.pms.project.create') }}">Create Project</a></li>
                            @endif
                            @if($user_permissions && $user_permissions->view_project)
                                <li><a href="{{ route('frontend.pms.project') }}">See listings</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(auth()->guard('pro')->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ $pro_site_url }}#/invoice-list">
                        <i class="icon-jobs"></i>Invoice
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.pms.chat.index') }}">
                        <i class="icon-chat"></i>Messaging
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ $pro_site_url }}#/resource-list">
                        <i class="icon-work"></i>Resources
                    </a>
                </li>
                <li class="nav-item @if(isset($page) && $page == 'permission') active @endif ">
                    <a class="nav-link" href="{{ route('frontend.pms.permission') }}" >
                        <i class="icon-paperclip"></i>Permission
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>