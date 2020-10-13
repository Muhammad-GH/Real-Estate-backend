@extends('frontend.layouts.login')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.register_box_title'))

@section('content')
<?php
$langtextarr = Session::get('langtext');
?>
<!-- login register form html start here -->
<div class="signup-message">
     <h3>Oletko uusi Flipkoti käyttäjä?</h3><p>Luo tili rekisteröitymällä tai <a href="{{ route('frontend.auth.login') }}">Kirjaudu sisään tästä</a></p>
            </div>
  <section class="fk-login_register">
    	<div class="container">
    		<div class="fk-login_register-inner">
    			<!--div class="fk-login_register-head">
    				<ul class="nav nav-tabs" role="tablist">
				      <li ><a href="{{ route('frontend.auth.login') }}" >@lang('labels.frontend.auth.login_box_title')</a></li>
				      <li class="active" ><a href="{{ route('frontend.auth.register') }}" >@lang('labels.frontend.auth.register_box_title')</a></li>
				    </ul>
                </div-->
                @include('includes.partials.messages')
    			<div class="tab-content fk-login_register-content">
			      <div class="tab-pane fade  active in" id="register">
			          <div class="fk-register-content_box">
                      {{ html()->form('POST', route('frontend.auth.register.post'))->id('fk-register_form')->open() }}    
                      		<div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.first_name'))->for('first_name') }}
                                <div class="form-input">
                                {{ html()->text('first_name')
                                        ->class('form-control')
                                        ->attribute('maxlength', 191)
                                        ->required()}}
                                </div>
			          		</div>
                      		<div class="form-group">
                                {{ html()->label(__('validation.attributes.frontend.last_name'))->for('last_name') }}
                                <div class="form-input">
                                {{ html()->text('last_name')
                                        ->class('form-control')
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                                </div>
			          		</div>
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
			          			{{ html()->label(__('validation.attributes.frontend.password_confirmation'))->for('password_confirmation') }}
			          			<div class="form-input">
			          				{{ html()->password('password_confirmation')
                                        ->class('form-control')
                                        ->required() }}
			          			</div>
                            </div>
                            @if(config('access.captcha.registration'))
			          		<div class="form-group">
			          			@captcha
                                {{ html()->hidden('captcha_status', 'true') }}
                            </div>
                            @endif
                            <div class="form-group">
			          			<input type="checkbox" class="custom-check" id="terms" name="terms" required=""> <span class="check-text">{{ translateText($langtextarr, 'Olen lukenut Flipkodin') }}  <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link"> {{ translateText($langtextarr, 'tietosuojaselosteen') }}</a> {{ translateText($langtextarr, 'ja') }} <a href="{{ route('frontend.terms') }}" class="custom-link"> {{ translateText($langtextarr, 'käyttöehdot') }}</a></span>
                            </div>
			          		<div class="form-submit full-width">
                                {{ form_submit(__('labels.frontend.auth.register_button'))->id('fk-register_btn') }}
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
    @if(config('access.captcha.registration'))
        @captchaScripts
    @endif
    <script>
        $(document).on('submit','#fk-register_form',function(){
            alert('asldf'); return false;
        });
    </script>
@endpush
