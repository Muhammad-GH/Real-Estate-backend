@extends('backend.layouts.app')

@section('title', __('labels.backend.workarea.management') . ' | ' . __('labels.backend.workarea.edit'))

@section('breadcrumb-links')
    @include('backend.marketplace.material.offer-breadcrumb-links')
@endsection

@section('content')
     {{ html()->modelForm($workarea,'PATCH', route('admin.workarea.update',$workarea[0]['area_id']))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->attribute('id', 'tender_form')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                        @lang('labels.backend.workarea.management')
                             
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
                
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{html()->label(__('labels.backend.workarea.table.name'))->class('col-md-2 form-control-label')->for(__('labels.backend.workarea.table.name')) }}

                            <div class="col-md-10">
                                {{ html()->text('area_name')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.workarea.table.name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->value($workarea[0]['area_name'] ?? '' )
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group--> 
                        <div class="form-group row">
                            {{html()->label(__('labels.backend.workarea.table.code'))->class('col-md-2 form-control-label')->for(__('labels.backend.workarea.table.code')) }}

                            <div class="col-md-10">
                                {{ html()->text('area_identifier')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.workarea.table.code'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->value($workarea[0]['area_identifier'] ?? '' )
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->  
                        <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.workarea.table.language'))->class('col-md-2 form-control-label')->for('labels.backend.workarea.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('language', $language)
                                        ->class('form-control')
                                        ->id('language')
                                        ->value(   $workarea[0]['area_lang_lang_id'] ?? ''     )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group-->
                   
 
                       
                        
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.workarea.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
 