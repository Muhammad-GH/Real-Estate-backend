@extends('pms.layout.login')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')
    <!-- login register form html start here -->
    <section class="fk-login_register">
    	<div class="container">

    		<div class="fk-login_register-inner">
    			<div class="fk-login_register-head">
    				<ul class="nav nav-tabs" role="tablist">
				        <li class="active">
                          <a href="{{ route('frontend.pms.login') }}" >@lang('labels.frontend.auth.login_box_title')</a>
                        </li>
				    </ul>
                </div>
                @include('pms.layout.partials.messages')
    			<div class="tab-content fk-login_register-content">
			      <div class="tab-pane fade active in" id="login">
			          <div class="fk-login-content_box">
                      {{ html()->form('POST', route('frontend.pms.login_submit'))->id('fk-pro-login_form')->open() }} 		
                        <div class="form-group">
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
                            <div class="form-group full-width">
                                {{ form_submit(__('labels.frontend.auth.login_button'))->id('fk-login_btn') }}
			          		</div>
			          		<div class="form-group">
			          			<a id="fk-forgot_pwd" href="{{ route('frontend.pms.password.reset') }}">@lang('pms.login.password')</a>
			          		</div>
                          {{ html()->form()->close() }}
			          </div>
			      </div>
			    </div>
    		</div>
    	</div>
    </section>
    <!-- login register form html end here -->
@endsection
@push('after-scripts')
<script>
$(document).ready(function(){
    $('#fk-pro-login_form').validate({
        rules: {
            email: {required: true, email: true},
            password: {required: true}
        },
        messages: {
            email: {required: "@lang('pms.validaion.required.email')"+'asdasdasd', email: "@lang('pms.validaion.invalid.email')" },
            password: {required: "@lang('pms.validaion.required.password')" }
        }
    });
});
</script>
@endpush