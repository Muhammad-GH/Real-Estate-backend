@extends('pms.layout.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')

<div class="container-fluid">
    <h3 class="head3">@lang('pms.change_password.title')</h3>
    <div class="card" style="max-width:1120px">
        <div class="card-body">
            {{ html()->form( 'POST', route('frontend.pms.change-password'))->id('fk-pro-change_password')->attribute('enctype', 'multipart/form-data')->open() }}
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="form-group">
                        {{ html()->label(__('pms.change_password.old_password'))->for('old_password') }}
                        {{ html()->password('old_password')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.change_password.old_password'))->required() }}
                    </div>
                
                    <div class="form-group">
                        {{ html()->label(__('pms.change_password.password'))->for('password') }}
                        {{ html()->password('password')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.change_password.password'))->required() }}
                    </div>
                
                    <div class="form-group">
                        {{ html()->label(__('pms.change_password.password_confirmation'))->for('password_confirmation') }}
                        {{ html()->password('password_confirmation')->class('form-control')->placeholder(__('pms.change_password.password_confirmation'))->attribute('maxlength', 191)->required() }}
                    </div>
                </div>
               
            </div>
            <div class="mt-5"></div>
            {{ form_submit(__('pms.my_account.submit'))->id('submit_btn')->class('btn btn-primary mb-sm-0 mb-3') }}
            {{ html()->form()->close() }}
        </div>
    </div>
</div>


@endsection

@push('after-scripts')
<script>
$(document).ready(function(){
    $('#fk-pro-change_password').validate({
        rules: {
            old_password: { required: true, minlength: 5},
            password: { required: true, minlength: 5},
            password_confirmation: { required: true, minlength : 5, equalTo : "#password"}
        },
        messages: {
            old_password: { required: "@lang('pms.validaion.required.password')",  minlength : "@lang('pms.validaion.invalid.min_length',['min_len'=>5])" },
            password: { required: "@lang('pms.validaion.required.password')",  minlength : "@lang('pms.validaion.invalid.min_length',['min_len'=>5])" },
            password_confirmation: {required: "@lang('pms.validaion.required.password')", minlength : "@lang('pms.validaion.invalid.min_length',['min_len'=>5])", equalTo : "@lang('pms.validaion.invalid.equalTo')" }
        }
    });
});
</script>
@endpush