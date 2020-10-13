@extends('backend.layouts.app')

@section('title', __('labels.backend.workphase.management') . ' | ' . __('labels.backend.workphase.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.workphase.store'))->class('form-horizontal')->attribute('id', 'workphase_form')->open() }}
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
                <input type="hidden" name="aw_id" value="0">
                <div class="row mt-4 mb-4">
                    <div class="col">
                    <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.workphase.table.workarea'))->class('col-md-2 form-control-label')->for('labels.backend.workphase.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('aw_area_id', $workarea)
                                        ->class('form-control')
                                        ->id('aw_area_id')
                                        ->value( )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div> 
                                </div> 


                        <div class="form-group row">
                            {{html()->label(__('labels.backend.workphase.table.name'))->class('col-md-2 form-control-label')->for(__('labels.backend.workphase.table.name')) }}

                            <div class="col-md-10">
                                {{ html()->text('aw_lang_aw_name')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.workphase.table.name'))
                                    ->attribute('maxlength', 191)
                                    ->required() 
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group--> 
                        <div class="form-group row">
                            {{html()->label(__('labels.backend.workphase.table.code'))->class('col-md-2 form-control-label')->for(__('labels.backend.workphase.table.code')) }}

                            <div class="col-md-10">
                                {{ html()->text('aw_identifier')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.workphase.table.code'))
                                    ->attribute('maxlength', 191)
                                    ->required() 
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->  
                        <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.workphase.table.language'))->class('col-md-2 form-control-label')->for('labels.backend.workphase.table.language') }} 
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
                        {{ form_cancel(route('admin.workphase.index'), __('buttons.general.cancel')) }}
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
 

    if ($("#workphase_form").length > 0) {
        $("#workphase_form").validate({
            rules: {
                aw_lang_aw_name: {
                    required: true,
                    maxlength: 50
                },
            },
            messages: {
 
                // aw_identifier: {
                //     required: "Please enter name",
                // },
            },
        })
    } 
 </script>     
@endpush