@extends('backend.layouts.app')

@section('title', __('labels.backend.workarea.management') . ' | ' . __('labels.backend.workarea.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.workarea.store'))->class('form-horizontal')->attribute('id', 'workarea_form')->open() }}
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
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group--> 
                        <div class="form-group row">
                            {{html()->label(__('labels.backend.workarea.table.code'))->class('col-md-2 form-control-label')->for(__('labels.backend.workarea.table.code')) }}

                            <div class="col-md-10">
                            
                            {{  html()->select('area_id', $area_identifier)
                                        ->class('form-control')
                                        ->id('language') 
                                        ->required()
                                         }} 
                            
                            </div><!--col-->
                        </div><!--form-group-->  
                        <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.workarea.table.language'))->class('col-md-2 form-control-label')->for('labels.backend.workarea.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('language', $language)
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
                        {{ form_cancel(route('admin.workarea.index'), __('buttons.general.cancel')) }}
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
 

    if ($("#workarea_form").length > 0) {
        $("#workarea_form").validate({
            rules: {
                area_name: {
                    required: true,
                    maxlength: 50
                },
            },
            messages: {
 
                // workarea_code: {
                //     required: "Please enter name",
                // },
            },
        })
    } 
 </script>     
@endpush