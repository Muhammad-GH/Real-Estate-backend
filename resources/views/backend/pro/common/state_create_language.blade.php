@extends('backend.layouts.app')

@section('title', __('labels.backend.state.management') . ' | ' . __('labels.backend.state.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.state.store'))->class('form-horizontal')->attribute('id', 'state_form')->open() }}
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
                                    
                                    {{ html()->label(__('labels.backend.state.table.language'))->class('col-md-2 form-control-label')->for('labels.backend.country.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('language', array('1'=>'Finnish','2'=>'English'))
                                        ->class('form-control')
                                        ->id('language') 
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group-->

                    <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.state.table.country'))->class('col-md-2 form-control-label')->for('labels.backend.country.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('state_country_id', $country)
                                        ->class('form-control')
                                        ->id('state_country_id')
                                        ->value( )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div> 
                                </div> 

                              
                        <div class="form-group row">
                            {{html()->label(__('labels.backend.state.table.code'))->class('col-md-2 form-control-label')->for(__('labels.backend.country.table.code')) }}

                            <div class="col-md-10">
                            {{  html()->select('state_code', array(__('labels.general.select')))
                                        ->class('form-control')
                                        ->id('state_code')
                                        ->value( )
                                        ->required()
                                         }}
                            </div><!--col-->
                        </div><!--form-group-->           
                        <div class="form-group row">
                            {{html()->label(__('labels.backend.state.table.name'))->class('col-md-2 form-control-label')->for(__('labels.backend.country.table.name')) }}

                            <div class="col-md-10">
                            {{ html()->text('state_name')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.state.table.name'))
                                    ->attribute('maxlength', 191)
                                    ->required() 
                                    ->autofocus() }}
                                          
                            </div><!--col-->
                        </div><!--form-group--> 
                   
 
                       
                        
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.state.index'), __('buttons.general.cancel')) }}
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
 
 $(document).on('change', '#state_country_id', function(){
    var country_id = $('#state_country_id').val();
    var language = $('#language').val();
   
  $.ajax({
   url:"{{ route('admin.state.get_country_by_state') }}?country_id="+country_id+"&language="+language,
   success:function(data)
   {
    var select = $('form select[name=state_code]');

                select.empty();

                $.each(data,function(key, value) {
                    select.append('<option value=' + key + '>' + value + '</option>');
                });
     
   }
  })
 });
    if ($("#state_form").length > 0) {
        $("#state_form").validate({
            rules: {
                state_name: {
                    required: true,
                    maxlength: 50
                },
            },
            messages: {
 
                // state_code: {
                //     required: "Please enter name",
                // },
            },
        })
    } 
 </script>     
@endpush