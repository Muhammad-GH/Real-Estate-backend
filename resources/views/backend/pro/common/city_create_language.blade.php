@extends('backend.layouts.app')

@section('title', __('labels.backend.city.management') . ' | ' . __('labels.backend.city.create'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->form('POST', route('admin.city.store'))->class('form-horizontal')->attribute('id', 'city_form')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                        @lang('labels.backend.city.management')
                             
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
                
                <div class="row mt-4 mb-4">
                    <div class="col">
                      
                    <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.city.table.language'))->class('col-md-2 form-control-label')->for('labels.backend.country.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('language', array('1'=>'Finnish','2'=>'English'))
                                        ->class('form-control')
                                        ->id('language') 
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div><!--col-->
                                </div><!--form-group-->

                                <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.city.table.country'))->class('col-md-2 form-control-label')->for('labels.backend.country.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('country_id', $country)
                                        ->class('form-control')
                                        ->id('country_id')
                                        ->value( )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div> 
                                </div>
                    <div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.city.table.state'))->class('col-md-2 form-control-label')->for('labels.backend.country.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('city_state_id', '')
                                        ->class('form-control')
                                        ->id('city_state_id')
                                        ->value( )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div> 
                                </div> 

                              
                        <div class="form-group row">
                            {{html()->label(__('labels.backend.city.table.code'))->class('col-md-2 form-control-label')->for(__('labels.backend.country.table.code')) }}

                            <div class="col-md-10">
                            {{  html()->select('city_id', array(__('labels.general.select')))
                                        ->class('form-control')
                                        ->id('city_id')
                                        ->value( )
                                        ->required()
                                         }}
                            </div><!--col-->
                        </div><!--form-group-->           
                        <div class="form-group row">
                            {{html()->label(__('labels.backend.city.table.name'))->class('col-md-2 form-control-label')->for(__('labels.backend.country.table.name')) }}

                            <div class="col-md-10">
                            {{ html()->text('city_name')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.city.table.name'))
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
                        {{ form_cancel(route('admin.city.index'), __('buttons.general.cancel')) }}
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
   $(document).on('change', '#country_id', function(){ 
    var country_id = $('#country_id').val();
    var language = $('#language').val();
   
  $.ajax({
   url:"{{ route('admin.state.get_country_by_state') }}?country_id="+country_id+"&language="+language,
   success:function(data)
   {
    var select = $('form select[name=city_state_id]');

                select.empty();
                select.append('<option value=0>Select</option>');
                $.each(data,function(key, value) {
                    select.append('<option value=' + key + '>' + value + '</option>');
                });
     
   }
  })
 });

 $(document).on('change', '#city_state_id', function(){
    var state_id = $('#city_state_id').val();
    var language = $('#language').val();
   
  $.ajax({
   url:"{{ route('admin.city.get_city_by_state') }}?state_id="+state_id+"&language="+language,
   success:function(data)
   {
    var select = $('form select[name=city_id]');

                select.empty();

                $.each(data,function(key, value) {
                    select.append('<option value=' + key + '>' + value + '</option>');
                });
     
   }
  })
 });
    if ($("#city_form").length > 0) {
        $("#city_form").validate({
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