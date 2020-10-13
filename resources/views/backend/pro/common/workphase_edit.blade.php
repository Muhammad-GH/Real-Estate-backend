@extends('backend.layouts.app')

@section('title', __('labels.backend.workphase.management') . ' | ' . __('labels.backend.workphase.edit'))

@section('breadcrumb-links')
    @include('backend.marketplace.material.offer-breadcrumb-links')
@endsection

@section('content')
     {{ html()->modelForm($workphase,'PATCH', route('admin.workphase.update',$workphase[0]['aw_id']))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->attribute('id', 'tender_form')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                        @lang('labels.backend.workphase.management')
                             
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
                
                <div class="row mt-4 mb-4">
                    <div class="col">
                     
                    <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.workphase.table.country'))->class('col-md-2 form-control-label')->for('labels.backend.country.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('aw_area_id', $workarea)
                                        ->class('form-control')
                                        ->id('aw_area_id')
                                        ->value(  $workphase[0]['aw_area_id'] ?? ''   )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div> 
                                </div> 

                        <div class="form-group row">
                            {{html()->label(__('labels.backend.workphase.table.name'))->class('col-md-2 form-control-label')->for(__('labels.backend.country.table.name')) }}

                            <div class="col-md-10">
                                {{ html()->text('aw_lang_aw_name')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.workphase.table.name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->value($workphase[0]['aw_lang_aw_name'] ?? '' )
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group--> 
                        <div class="form-group row">
                            {{html()->label(__('labels.backend.workphase.table.code'))->class('col-md-2 form-control-label')->for(__('labels.backend.country.table.code')) }}

                            <div class="col-md-10">
                                {{ html()->text('aw_identifier')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.workphase.table.code'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->value($workphase[0]['aw_identifier'] ?? '' )
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->  
                        <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.workphase.table.language'))->class('col-md-2 form-control-label')->for('labels.backend.country.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('language', $language)
                                        ->class('form-control')
                                        ->id('language')
                                        ->value(  $workphase[0]['aw_lang_lang_id'] ?? ''   )
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
                        {{ form_cancel(route('admin.country.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.update')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
 