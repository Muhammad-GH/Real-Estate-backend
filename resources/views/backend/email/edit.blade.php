@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'))

<!-- @section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection
 -->

<?php //dd($emailData->id);?>
@section('content')
{{ html()->modelForm($emailData, 'PATCH', route('admin.emails.update', $emailData->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    {{-- <h4 class="card-title mb-0">
                        @lang('labels.backend.access.users.management')
                        <small class="text-muted">@lang('labels.backend.access.users.edit')</small>
                    </h4> --}}
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">

                    <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.emails.email_for'))->class('col-md-2 form-control-label')->for('email_for') }}
                   <div class="col-md-10">
                        {{ html()->text('email_for')
                        ->class('form-control')
                        ->value($emailData->email_for)
                        ->placeholder(__('validation.attributes.backend.access.emails.email_for'))
                        ->attribute('maxlength', 191)
                        ->required()
                        ->autofocus() }}
                   </div>
                                       
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.emails.heading'))->class('col-md-2 form-control-label')->for('subject') }}
                        
                        <div class="col-md-10">{{ html()->text('subject')
                            ->class('form-control')
                            ->value($emailData->subject)
                            ->placeholder(__('validation.attributes.backend.access.emails.heading'))
                            ->attribute('maxlength', 191)
                            ->required()
                            ->autofocus() }}
                        </div>
                    </div><!--form-group-->

                    {{-- <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.emails.var'))->class('col-md-2 form-control-label')->for('var') }}
                        
                        <div class="col-md-10">
                            <button class="btn btn-info pre">Dynamic name</button>
                        </div>
                    </div><!--form-group--> --}}


                    <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.emails.des'))->class('col-md-2 form-control-label')->for('des') }}
                        <div class="col-md-10">
                        <textarea name="editor1">{{$emailData->intro}}</textarea>
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
