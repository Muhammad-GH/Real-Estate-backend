@extends('backend.layouts.app')

@section('title', 'Departments Management' . ' | ' . 'Create Content')

@section('breadcrumb-links')
    <li class="breadcrumb-menu">
        <div class="btn-group" role="group" aria-label="Button group">
            <div class="dropdown">
                <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Content
                </a>

            </div><!--dropdown-->
        </div><!--btn-group-->
    </li>
   

@endsection

@section('content')
    {{ html()->form('POST', route('admin.emails.store'))->class('form-horizontal')->open() }}

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.users.email')
                            <small class="text-muted">@lang('labels.backend.access.users.email_cre')</small>
                        </h4>
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
                            {{-- <textarea name="editor1">{{$html->intro}}</textarea> --}}
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.emails.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
