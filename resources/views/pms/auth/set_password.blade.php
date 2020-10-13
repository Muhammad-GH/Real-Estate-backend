@extends('pms.layout.login')

@section('title', app_name() . ' | ' . __('labels.frontend.passwords.reset_password_box_title'))

@section('content')
<section class="fk-login_register">
    <div class="container">
        <div class="fk-login_register-inner">
            <div class="fk-login_register-head">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active">
                        <a href="javascript:void(0);" >@lang('pms.reset.set_password_title')</a>
                    </li>
                </ul>
            </div>
            @include('pms.layout.partials.messages')
            <div class="tab-content fk-login_register-content">
                <div class="tab-pane fade active in" id="login">
                    <div class="fk-login-content_box">
                    {{ html()->form('POST', route('frontend.pms.password.password_submit'))->id('fk-pro-resetPasswordForm')->open() }}
                        {{ html()->text('token')->type('hidden')->value($token) }}
                    <div class="form-group">
                            {{ html()->label(__('pms.reset.password'))->for('password') }}
                            <div class="form-input">
                            {{ html()->password('password')
                                    ->class('form-control')
                                    ->placeholder(__('pms.reset.password'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div>
                        </div>
                        <div class="form-group">
                            {{ html()->label(__('pms.reset.confirm_password'))->for('confirm_password') }}
                            <div class="form-input">
                            {{ html()->password('password_confirmation')
                                    ->class('form-control')
                                    ->placeholder(__('pms.reset.confirm_password'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div>
                        </div>
                        <div class="form-group full-width">
                            {{ form_submit(__('labels.frontend.passwords.send_password_reset_link_button'))->id('fk-login_btn') }}
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('after-scripts')
<script>
$(document).ready(function(){
    $('#fk-pro-resetPasswordForm').validate({
        rules: {
            password: { required: true, minlength: 5},
            password_confirmation: { required: true, minlength : 5, equalTo : "#password"}
        },
        messages: {
            password: { required: "@lang('pms.validaion.required.password')",  minlength : "@lang('pms.validaion.invalid.min_length',['min_len'=>5])" },
            password_confirmation: {required: "@lang('pms.validaion.required.password')", minlength : "@lang('pms.validaion.invalid.min_length',['min_len'=>5])", equalTo : "@lang('pms.validaion.invalid.equalTo')" }
        }
    });
});
</script>
@endpush