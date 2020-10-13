@extends('pms.layout.app')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.login_box_title'))

@section('content')

<div class="container-fluid">
    <h3 class="head3">@lang('pms.my_account.title')</h3>
    <div class="card" style="max-width:1120px">
        <div class="card-body">
            {{ html()->modelForm( $resource ,'POST', route('frontend.pms.my-account'))->id('fk-pro-my_account')->attribute('enctype', 'multipart/form-data')->open() }}
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="form-group">
                        {{ html()->label(__('pms.my_account.first_name'))->for('first_name') }}
                        {{ html()->text('first_name')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.my_account.first_name'))->required() }}
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6 offset-xl-1">
                    <div class="form-group">
                        {{ html()->label(__('pms.my_account.last_name'))->for('last_name') }}
                        {{ html()->text('last_name')->class('form-control')->attribute('maxlength', 191)->placeholder(__('pms.my_account.last_name'))->required() }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="form-group">
                        {{ html()->label(__('pms.my_account.email'))->for('email') }}
                        {{ html()->email('email')->class('form-control')->placeholder(__('pms.my_account.email'))->attribute('maxlength', 191)->required() }}
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6 offset-xl-1">
                    <div class="form-group">
                        {{ html()->label(__('pms.my_account.image'))->for('image') }}
                        {{ html()->text('image')->type('file')->class('form-control') }}
                        @if($resource->photo)
                            @php
                                $image = url('/images/resources/'.$resource->id.'/'.$resource->photo);
                            @endphp
                            <img src="{{ $image }}" style="width:100px" alt="Pic">
                        @endif
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
    // $('#fk-pro-my_account').validate({
    //     rules: {
    //         password: { required: true, minlength: 5},
    //         password_confirmation: { required: true, minlength : 5, equalTo : "#password"}
    //     },
    //     messages: {
    //         password: { required: "@lang('pms.validaion.required.password')",  minlength : "@lang('pms.validaion.invalid.min_length',['min_len'=>5])" },
    //         password_confirmation: {required: "@lang('pms.validaion.required.password')", minlength : "@lang('pms.validaion.invalid.min_length',['min_len'=>5])", equalTo : "@lang('pms.validaion.invalid.equalTo')" }
    //     }
    // });
});
</script>
@endpush