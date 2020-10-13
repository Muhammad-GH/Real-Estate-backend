@extends('backend.layouts.app')

@section('title', __('labels.backend.country.management') . ' | ' . __('labels.backend.country.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.country.store'))->class('form-horizontal')->attribute('id', 'country_form')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                        @lang('labels.backend.country.management')
                             
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
                
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{html()->label(__('labels.backend.country.table.name'))->class('col-md-2 form-control-label')->for(__('labels.backend.country.table.name')) }}

                            <div class="col-md-10">
                                {{ html()->text('country_name')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.country.table.name'))
                                    ->attribute('maxlength', 191)
                                    ->required() 
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group--> 
                        <div class="form-group row">
                            {{html()->label(__('labels.backend.country.table.code'))->class('col-md-2 form-control-label')->for(__('labels.backend.country.table.code')) }}

                            <div class="col-md-10">
                            
                            {{  html()->select('country_code', $country_code)
                                        ->class('form-control')
                                        ->id('language') 
                                        ->required()
                                         }} 
                            
                            </div><!--col-->
                        </div><!--form-group-->  
                        <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.country.table.language'))->class('col-md-2 form-control-label')->for('labels.backend.country.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('language', array('1'=>'Finnish','2'=>'English'))
                                        ->class('form-control')
                                        ->id('language') 
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
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
@push('after-scripts') 

<script>
 

    if ($("#country_form").length > 0) {
        $("#country_form").validate({
            rules: {
                country_name: {
                    required: true,
                    maxlength: 50
                },
            },
            messages: {
 
                // country_code: {
                //     required: "Please enter name",
                // },
            },
        })
    } 
 </script>     
@endpush