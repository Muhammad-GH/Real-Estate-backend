@extends('frontend.layouts.calculator')

@section('content')
    <section class="fk-rent-flip_case">
        <div class="container-fluid">
            <div class="row">
                <div class="fk-rent-flip_case-head text-center">
                    <h3>Dashboard</h3>
                </div>
            </div>
        </div>    
        <div class="container-fluid">
            <div class="row">
                <div class="fk-rent-flip_case-wrap">
                    <div class="fk-rent-flip_case-wrap_inner">

                    <div class="dash-showbox">
                        <ul>
                            <li class="width-33-n-p"><a href="{{ route('frontend.sale') }}"><div class="b-outer"><span class="dlinkbuy"><i>Löydä </i><br>sopiva asunto</span></div></a></li>
                            <li class="width-33-n-p"><a href="{{ route('frontend.sell_ad') }}"><div class="b-outer"><span class="dlinksell"><i>Myy </i><br>asunto</span></div></a></li>
                            <li class="width-33-n-p"><a href="{{ route('frontend.stationing') }}"><div class="b-outer"><span class="dlinkinvest"><i>Sijoita </i>asuntoihin</span></div></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="fk-rent-flip_case-head text-center">
                    <h3>@lang('navs.frontend.user.account')</h3>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            @include('includes.partials.messages')
            <div class="row">
                <div class="fk-rent-flip_case-wrap">
                <div class="fk-rent-flip_case-wrap_inner">
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item active">
                                <a href="#profile" class="nav-link active" aria-controls="profile" role="tab" data-toggle="tab">@lang('navs.frontend.user.profile')</a>
                            </li>

                            <li class="nav-item">
                                <a href="#edit" class="nav-link" aria-controls="edit" role="tab" data-toggle="tab">@lang('labels.frontend.user.profile.update_information')</a>
                            </li>

                            @if($logged_in_user->canChangePassword())
                                <li class="nav-item">
                                    <a href="#password" class="nav-link" aria-controls="password" role="tab" data-toggle="tab">@lang('navs.frontend.user.change_password')</a>
                                </li>
                            @endif
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in pt-3" id="profile" aria-labelledby="profile-tab">
                                @include('frontend.user.account.tabs.profile')
                            </div><!--tab panel profile-->

                            <div role="tabpanel" class="tab-pane fade  pt-3" id="edit" aria-labelledby="edit-tab">
                                @include('frontend.user.account.tabs.edit')
                            </div><!--tab panel profile-->

                            @if($logged_in_user->canChangePassword())
                                <div role="tabpanel" class="tab-pane fade  pt-3" id="password" aria-labelledby="password-tab">
                                    @include('frontend.user.account.tabs.change-password')
                                </div><!--tab panel change password-->
                            @endif
                        </div><!--tab content-->
                    </div><!--tab panel-->
                </div>
                </div>
            </div><!-- row -->
        </div>
    </section>
@endsection
