<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                @lang('menus.backend.sidebar.general')
            </li>
            <li class="nav-item">
                <a class="nav-link {{
                    active_class(Route::is('admin/dashboard'))
                }}" href="{{ route('admin.dashboard') }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    @lang('menus.backend.sidebar.dashboard')
                </a>
            </li>
@foreach (json_decode($logged_in_user->rights) as $right)
    <!-- <p>This is user {{ $right }}</p> -->

        @if ($right == 'property')
            <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/property*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/property*')) }}" href="#">
                    <i class="nav-icon far fa fa-archway"></i>
                    Property

                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/property/index*')) }}" href="{{ route('admin.property.index') }}">
                            Property Management
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/property/index*')) }}" href="{{ route('admin.property.deleted') }}">
                            Deleted Property
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/property/contact*')) }}" href="{{ route('admin.property.contact') }}">
                            Buy Property Request
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/property/myymassa*')) }}" href="{{ route('admin.property.myymassa') }}">
                            Sell Property Request
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/property/ostamassa*')) }}" href="{{ route('admin.property.ostamassa') }}">
                            Ostamassa Property
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/property/ostamassa_request*')) }}" href="{{ route('admin.property.ostamassa_request') }}">
                            Ostamassa Property Request
                        </a>
                    </li>
                </ul>
            </li>

            @elseif ($right == 'invest property')
            <li class="divider"></li>
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/investproperty*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/investproperty*')) }}" href="#">
                        <i class="nav-icon far fa fa-dungeon"></i>
                        Invest Property
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/investproperty/index*')) }}" href="{{ route('admin.investproperty.index') }}">
                                Invest Property Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/investproperty/index*')) }}" href="{{ route('admin.investproperty.deleted') }}">
                                Deleted Invest Property
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/investproperty/invest_request*')) }}" href="{{ route('admin.investproperty.invest_request') }}">
                                Investment Request
                            </a>
                        </li>
                    </ul>
                </li>

                @elseif ($right == 'blog')
                <li class="divider"></li>
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/blog*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/blog*')) }}" href="#">
                        <i class="nav-icon far fa fa-blog"></i>
                        Blog
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/blog/category*')) }}" href="{{ route('admin.blog.category.index') }}">
                                Blog Category Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/blog/category/deleted*')) }}" href="{{ route('admin.blog.category.deleted') }}">
                                Deleted Blog Category
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/blog/index*')) }}" href="{{ route('admin.blog.index') }}">
                                Blogs Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/blog/index*')) }}" href="{{ route('admin.blog.deleted') }}">
                                Deleted Blogs
                            </a>
                        </li>
                    </ul>
                </li>

                @elseif ($right == 'cms')
                <li class="divider"></li>
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/blog*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/blog*')) }}" href="#">
                        <i class="nav-icon far fa fa-atlas"></i>
                        CMS
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/blog/category*')) }}" href="{{ route('admin.blog.category.index') }}">
                                CMS Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/blog/category/deleted*')) }}" href="{{ route('admin.blog.category.deleted') }}">
                                Deleted CMS
                            </a>
                        </li>
                    </ul>
                </li>

                @elseif ($right == 'request')
                <li class="divider"></li>
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/request*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/request*')) }}" href="#">
                        <i class="nav-icon far fa fa-wrench"></i>
                        Requests
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/request/contact*')) }}" href="{{ route('admin.request.contact') }}">
                                Contact Request
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/request/classified*')) }}" href="{{ route('admin.request.classified') }}">
                                Classified Request
                            </a>
                        </li>
                    </ul>
                </li>

                @elseif ($right == 'page management')
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/pages*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/pages*')) }}" href="#">
                        <i class="nav-icon far fa fa-wrench"></i>
                        Page Management
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/pages/index*')) }}" href="{{ route('admin.pages.index') }}">
                                All Pages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/pages/editPage*')) }}" href="{{ route('admin.pages.editPage') }}">
                                Edit Page
                            </a>
                        </li>
                    </ul>
                </li>

                @elseif ($right == 'job management')
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/jobs*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/jobs*')) }}" href="#">
                        <i class="nav-icon far fa fa-wrench"></i>
                        Jobs Management
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/departments/index*')) }}" href="{{ route('admin.departments.index') }}">
                                All Departments
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/jobs/index*')) }}" href="{{ route('admin.jobs.index') }}">
                                All Jobs
                            </a>
                        </li>
                    </ul>
                </li>

                @elseif ($right == 'setting')
                <li class="divider"></li>
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/setting*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/setting*')) }}" href="#">
                        <i class="nav-icon far fa fa-wrench"></i>
                        Settings
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/setting/pdf*')) }}" href="{{ route('admin.setting.pdf.index') }}">
                                Form PDF Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/blog/category/deleted*')) }}" href="{{ route('admin.setting.pdf.deleted') }}">
                                Deleted Form PDF
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/blog/index*')) }}" href="{{ route('admin.blog.index') }}">
                                Profile
                            </a>
                        </li> -->
                    </ul>
                </li>

                @elseif ($right == 'calculator')
                <li class="divider"></li>
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/calculator*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/calculator*')) }}" href="#">
                        <i class="nav-icon far fa fa-wrench"></i>
                        Calculator
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/calculator/renovation-submissions*')) }}" href="{{ route('admin.calculator.renovation-submissions') }}">
                                Renovation Submissions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/calculator/flip-submissions*')) }}" href="{{ route('admin.calculator.flip-submissions') }}">
                                Flio Submissions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/calculator/index*')) }}" href="{{ route('admin.calculator.index') }}">
                                Flip Calc
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/calculator/flip-calc*')) }}" href="{{ route('admin.calculator.flip-calc') }}">
                                Renovation Calc
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/calculator/result-percentage*')) }}" href="{{ route('admin.calculator.result-percentage') }}">
                                Renovation Calc Result Percentage
                            </a>
                        </li>
                    </ul>
                </li>

                @elseif ($right == 'frontend management')
                <li class="divider"></li>
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/calculator*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/calculator*')) }}" href="#">
                        <i class="nav-icon far fa fa-wrench"></i>
                        Frontend Management
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/frontendmanagement/index*')) }}" href="{{ route('admin.frontendmanagement.index') }}">
                                Language
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/frontendmanagement/index*')) }}" href="{{ route('admin.frontendmanagement.alltext') }}">
                                Text Management
                            </a>
                        </li>
                    </ul>
                </li>

                @elseif ($right == 'market place')
                <li class="divider"></li>
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/marketplace*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/marketplace*')) }}" href="#">
                        <i class="nav-icon far fa fa-store"></i>
                        Marketplace 
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/marketplace/material-requests*')) }}" href="{{ route('admin.marketplace.MaterialRequests') }}">
                                Material Requests
                            </a>
                        </li>      
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/marketplace/index*')) }}" href="{{ route('admin.marketplace.index') }}">
                            Work offer
                            </a>
                        </li>
                    </ul>
                </li>
        @endif

@endforeach




        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
