@extends('frontend.layouts.login')

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title'))

@section('content')
<section class="fk-login_register">
    	<div class="container">
    		<div class="fk-login_register-inner">
    			<div class="fk-login_register-head">
    				<ul class="nav nav-tabs" role="tablist">
				        <li class="active">
                          <a href="javascript:void(0);" >@lang('labels.frontend.passwords.reset_password_box_title')</a>
                        </li>
				    </ul>
                </div>
                @include('includes.partials.messages')
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
    			<div class="tab-content fk-login_register-content">
			      <div class="tab-pane fade active in" id="login">
			          <div class="fk-login-content_box">
                        {{ html()->form('POST', route('frontend.auth.password.reset'))->id('fk-login_form')->open() }}
                        {{ html()->hidden('token', $token) }}
                            <div class="form-group">
			          			{{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}
                                <div class="form-input">
                                {{ html()->email('email')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div>
			          		</div>
                            <div class="form-group">
			          			{{ html()->label(__('validation.attributes.frontend.password'))->for('password') }}
                                <div class="form-input">
                                {{ html()->password('password')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                                </div>
			          		</div>
                            <div class="form-group">
			          			{{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}
                                <div class="form-input">
                                {{ html()->password('password_confirmation')
                                        ->class('form-control')
                                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                        ->required() }}
                                </div>
			          		</div>
			          		<div class="form-group full-width">
                                {{ form_submit(__('labels.frontend.passwords.reset_password_button'))->id('fk-login_btn') }}
			          		</div>
                          {{ html()->form()->close() }}
			          </div>
			      </div>
			    </div>
    		</div>
    	</div>
    </section>
@endsection
