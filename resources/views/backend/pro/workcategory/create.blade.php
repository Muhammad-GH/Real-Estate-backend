@extends('backend.layouts.app')

@section('title', __('labels.backend.workcategory.management') . ' | ' . __('labels.backend.workcategory.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.workcategory.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.workcategory.management')
                            <small class="text-muted">@lang('labels.backend.workcategory.create')</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('labels.backend.workcategory.table.name'))->class('col-md-2 form-control-label')->for('first_name') }}

                            <div class="col-md-10">
                                {{ html()->text('name')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.workcategory.table.name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('labels.backend.workcategory.table.parent'))->class('col-md-2 form-control-label')->for('parent') }}

                        <div class="col-md-10">
                        {!! html()->select('wc_parent_id', [0=>'Select'] + $categories,'')->class('form-control') !!}
                          
                        </div><!--col-->
                    </div><!--form-group-->


                       
 

                 
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.workcategory.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
