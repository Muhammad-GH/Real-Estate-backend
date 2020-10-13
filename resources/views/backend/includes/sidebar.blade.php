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



            @if ($logged_in_user->isAdmin())
                <li class="nav-title">
                    @lang('menus.backend.sidebar.consumer_system')
                </li>

                

                


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
                            <a class="nav-link {{ active_class(Route::is('admin/property/myymassa*')) }}" href="{{ route('admin.SellUs-Service-request.all') }}">
                                SellUs Property Requests
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
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/roomsdata/index*')) }}" href="{{ route('admin.roomsdata.index') }}">
                                Renovation Room messages
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="divider"></li>
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/calculator*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/calculator*')) }}" href="#">
                        <i class="nav-icon far fa fa-wrench"></i>
                        Frontend Management
                    </a>
                    <ul class="nav-dropdown-items">
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/frontendmanagement/index*')) }}" href="{{ route('admin.frontendmanagement.index') }}">
                                Language
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/frontendmanagement/index*')) }}" href="{{ route('admin.frontendmanagement.alltext') }}">
                                Text Management
                            </a>
                        </li> --}}
                    </ul>
                </li>		
                <li class="divider"></li>
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/marketplace*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/marketplace*')) }}" href="#">
                        <i class="nav-icon far fa fa-store"></i>
                        Marketplace 
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/marketplace/material-offers*')) }}" href="{{ route('admin.marketplace.MaterialOffers') }}">
                                Material Offer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/marketplace/material-requests*')) }}" href="{{ route('admin.marketplace.MaterialRequests') }}">
                                Material Request
                            </a>
                        </li>      
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/marketplace/index*')) }}" href="{{ route('admin.marketplace.index') }}">
                            Work Offer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/marketplace/work-request*')) }}" href="{{ route('admin.marketplace.WorkRequests') }}">
                            Work Request
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="divider"></li>
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/professional-enquiries*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/professional-enquiries*')) }}" href="#">
                        <i class="nav-icon far fa fa-store"></i>
                        Professional Enquries 
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/professional-enquiries/service-providers*')) }}" href="{{ route('admin.professional-enquiries.service-providers') }}">
                                Service Provider
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/professional-enquiries/investors*')) }}" href="{{ route('admin.professional-enquiries.investors') }}">
                                Investors
                            </a>
                        </li>      
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/professional-enquiries/real-estate*')) }}" href="{{ route('admin.professional-enquiries.real-estate') }}">
                            For Real Estate & Housing Companies
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/professional-enquiries/marketplace*')) }}" href="{{ route('admin.professional-enquiries.marketplace') }}">
                            MarketPlace Enquries
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_class(Route::is('admin/professional-properties*'), 'open') }}">
                    <a class="nav-link  {{ active_class(Route::is('admin/professional-properties*')) }}" href="{{ route('admin.professional-properties.all') }}">
                        <i class="nav-icon far fa fa-store"></i>
                        Professional Properties 
                    </a>
                </li>

                <li class="divider"></li>
                {{-- <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/emails*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/emails*')) }}" href="#">
                        <i class="nav-icon far fa fa-store"></i>
                        Emails 
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/emails/material-requests*')) }}" href="{{ route('admin.emails.index') }}">
                                Email Templates
                            </a>
                        </li>      
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/emails/send_mail*')) }}" href="{{ route('admin.emails.send_mail') }}">
                            Email sending
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-title">
                    @lang('menus.backend.sidebar.pro_system')
                </li>


                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/auth*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/auth*')) }}" href="#">
                        <i class="nav-icon far fa-user"></i>
                        @lang('menus.backend.access.title')

                        @if ($pending_approval > 0)
                            <span class="badge badge-danger">{{ $pending_approval }}</span>
                        @endif
                    </a>

                    
                    <ul class="nav-dropdown-items">

                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.index') }}">
                                @lang('labels.backend.access.users.management')

                                @if ($pending_approval > 0)
                                    <span class="badge badge-danger">{{ $pending_approval }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/dashboard*'))
                            }}" href="{{ route('admin.users') }}">
                               Pro Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.deactivated') }}">
                                @lang('labels.backend.access.users.deactivated')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/user*'))
                            }}" href="{{ route('admin.auth.user.deleted') }}">
                                @lang('labels.backend.access.users.deleted')
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link {{
                                active_class(Route::is('admin/auth/role*'))
                            }}" href="{{ route('admin.auth.role.index') }}">
                                @lang('labels.backend.access.roles.management')
                                </a>
                            </li> -->
                    </ul>
                </li>

                <li class="divider"></li>
                <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/global*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/global*')) }}" href="#">
                        <i class="nav-icon far fa fa-store"></i>
                        Global Config 
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/global/general*')) }}" href="{{ route('admin.global.general') }}">
                                General Settings
                            </a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/global/translation_index*')) }}" href="{{ route('admin.global.translation_index') }}">
                                Translations
                            </a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/emails/material-requests*')) }}" href="{{ route('admin.emails.index') }}">
                                Email Templates
                            </a>
                        </li>      
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/emails/send_mail*')) }}" href="{{ route('admin.emails.send_mail') }}">
                            Email sending
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/frontendmanagement/index*')) }}" href="{{ route('admin.frontendmanagement.index') }}">
                                Language
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/frontendmanagement/index*')) }}" href="{{ route('admin.frontendmanagement.alltext') }}">
                                Text Management
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="divider"></li>
                {{-- <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/professional-enquiries*'), 'open') }}">
                    <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/professional-enquiries*')) }}" href="#">
                        <i class="nav-icon far fa fa-store"></i>
                        Professional Enquries 
                    </a>

                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/professional-enquiries/service-providers*')) }}" href="{{ route('admin.professional-enquiries.service-providers') }}">
                                Service Provider
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/professional-enquiries/investors*')) }}" href="{{ route('admin.professional-enquiries.investors') }}">
                                Investors
                            </a>
                        </li>      
                        <li class="nav-item">
                            <a class="nav-link {{ active_class(Route::is('admin/professional-enquiries/real-estate*')) }}" href="{{ route('admin.professional-enquiries.real-estate') }}">
                            For Real Estate & Housing Companies
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ active_class(Route::is('admin/professional-properties*'), 'open') }}">
                    <a class="nav-link  {{ active_class(Route::is('admin/professional-properties*')) }}" href="{{ route('admin.professional-properties.all') }}">
                        <i class="nav-icon far fa fa-store"></i>
                        Professional Properties 
                    </a>
                </li> --}}
                <!-- <li class="nav-item nav-dropdown {{
                    active_class(Route::is('admin/log-viewer*'), 'open')
                }}">
                        <a class="nav-link nav-dropdown-toggle {{
                            active_class(Route::is('admin/log-viewer*'))
                        }}" href="#">
                        <i class="nav-icon fas fa-list"></i> @lang('menus.backend.log-viewer.main')
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer'))
                        }}" href="{{ route('log-viewer::dashboard') }}">
                                @lang('menus.backend.log-viewer.dashboard')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{
                            active_class(Route::is('admin/log-viewer/logs*'))
                        }}" href="{{ route('log-viewer::logs.list') }}">
                                @lang('menus.backend.log-viewer.logs')
                        </a>
                    </li>
                </ul>
            </li> -->

            <li class="divider"></li>
            <li class="nav-item nav-dropdown {{ active_class(Route::is('admin/configuration*'), 'open') }}">
                <a class="nav-link nav-dropdown-toggle {{ active_class(Route::is('admin/configuration*')) }}" href="#">
                    <i class="nav-icon far fa fa-store"></i>
                    Pro
                </a>

                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/configuration*')) }}" href="{{ route('admin.configuration.index') }}">
                        Configuration
                        </a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/tender*')) }}" href="{{ route('admin.tender.index') }}">
                            Tender
                        </a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/category*')) }}" href="{{ route('admin.category.index') }}">
                            Category
                        </a>
                    </li>   
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/country*')) }}" href="{{ route('admin.country.index') }}">
                            Country
                        </a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/state*')) }}" href="{{ route('admin.state.index') }}">
                            State
                        </a>
                    </li>   
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/city*')) }}" href="{{ route('admin.city.index') }}">
                            City
                        </a>
                    </li>     
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/workarea*')) }}" href="{{ route('admin.workarea.index') }}">
                        Workarea
                        </a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link {{ active_class(Route::is('admin/workphase*')) }}" href="{{ route('admin.workphase.index') }}">
                        Workphase
                        </a>
                    </li>     
                     
                     
                </ul> 
            </li>
            @else

        @endif

        </ul>
    </nav>

    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div><!--sidebar-->
