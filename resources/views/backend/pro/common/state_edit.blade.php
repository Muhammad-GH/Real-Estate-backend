@extends('backend.layouts.app')

@section('title', __('labels.backend.state.management') . ' | ' . __('labels.backend.state.edit'))

@section('breadcrumb-links')
    @include('backend.marketplace.material.offer-breadcrumb-links')
@endsection

@section('content')
     {{ html()->modelForm($state,'PATCH', route('admin.state.update',$state[0]['state_id']))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->attribute('id', 'tender_form')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                        @lang('labels.backend.state.management')
                             
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
                
                <div class="row mt-4 mb-4">
                    <div class="col">
                     
                    <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.state.table.country'))->class('col-md-2 form-control-label')->for('labels.backend.country.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('state_country_id', $country)
                                        ->class('form-control')
                                        ->id('state_country_id')
                                        ->value(  $state[0]['state_country_id'] ?? ''   )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div> 
                                </div> 

                        <div class="form-group row">
                            {{html()->label(__('labels.backend.state.table.name'))->class('col-md-2 form-control-label')->for(__('labels.backend.country.table.name')) }}

                            <div class="col-md-10">
                                {{ html()->text('state_name')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.state.table.name'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->value($state[0]['state_name'] ?? '' )
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group--> 
                        <div class="form-group row">
                            {{html()->label(__('labels.backend.state.table.code'))->class('col-md-2 form-control-label')->for(__('labels.backend.country.table.code')) }}

                            <div class="col-md-10">
                                {{ html()->text('state_code')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.state.table.code'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->value($state[0]['state_code'] ?? '' )
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->  
                        <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.state.table.language'))->class('col-md-2 form-control-label')->for('labels.backend.country.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('language', array('1'=>'Finnish','2'=>'English'))
                                        ->class('form-control')
                                        ->id('language')
                                        ->value(  $state[0]['statelang_lang_id'] ?? ''   )
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
 