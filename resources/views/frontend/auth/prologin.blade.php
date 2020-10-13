@extends('frontend.layouts.login')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.pro_login'))

@section('content')
    <!-- login register form html start here -->
    <section class="fk-login_register">
    	<div class="container">

    		<div class="fk-login_register-inner">
    			<div class="fk-login_register-head">
    				<ul class="nav nav-tabs" role="tablist">
				      <li class="active">
                          <a href="{{ route('frontend.auth.login') }}" >@lang('labels.frontend.auth.login_box_title')</a>
                        </li>
				      <li><a href="{{ route('frontend.auth.register') }}" >@lang('labels.frontend.auth.register_box_title')</a></li>
				    </ul>
                </div>
                @include('includes.partials.messages')
    			<div class="tab-content fk-login_register-content">
			      <div class="tab-pane fade active in" id="login">
			          <div class="fk-login-content_box">
                      {{ html()->form('POST', route('frontend.auth.prologin.post'))->id('fk-login_form')->open() }} 		<div class="form-group">
			          			{{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}
                                <div class="form-input">
                                {{ html()->email('email')
                                    ->class('form-control')
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                                </div>
			          		</div>
			          		<div class="form-group">
			          			{{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}
			          			<div class="form-input">
			          				{{ html()->password('password')
                                        ->class('form-control')
                                        ->required() }}
			          			</div>
			          		</div>
			          		<div class="form-group">
			          			<div class="fk-remember-checbox">
                                    <div class="fk-remember-checkbox_inner">
                                        {{ html()->checkbox('remember', false, 1)  }}
                                        {{ html()->label(__('labels.frontend.auth.remember_me'))->for('remember') }}    
                                    </div>
                                </div>
                            </div>
                            @if(config('access.captcha.login'))
                            <div class="form-group">
			          			@captcha
                                {{ html()->hidden('captcha_status', 'true') }}
                            </div>
                            @endif
			          		<div class="form-group full-width">
                                {{ form_submit(__('labels.frontend.auth.login_button'))->id('fk-login_btn') }}
			          		</div>
			          		<div class="form-group">
			          			<a id="fk-forgot_pwd" href="{{ route('frontend.auth.password.reset') }}">@lang('labels.frontend.passwords.forgot_password')</a>
			          		</div>
                          {{ html()->form()->close() }}
                          <div class="row">
                            <div class="col">
                                <div class="text-center">
                                    @include('frontend.auth.includes.socialite')
                                </div>
                            </div><!--col-->
                        </div><!--row-->
			          </div>
			      </div>
			    </div>
    		</div>
    	</div>
    </section>
    <!-- login register form html end here -->
@endsection

@push('after-scripts')
    @if(config('access.captcha.login'))
        @captchaScripts
    @endif
@endpush
