@extends('backend.layouts.app')

@section('title', __('labels.backend.tender.management') . ' | ' . __('labels.backend.tender.create_material_offer'))

@section('breadcrumb-links')
    @include('backend.pro.marketplace.includes.tender-breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.tender.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->attribute('id', 'tender_form')->open() }}
    {{  html()->hidden('tender_category_type', 'Work') }}
    {{  html()->hidden('tender_type', 'Request') }}
        <div class="card">

            <div class="card-body">

                <div class="row">

                    <div class="col-sm-5">

                    <h4 class="card-title mb-0">
                        @lang('labels.backend.tender.management') 
                            <small class="text-muted">@lang('labels.backend.tender.create_work_request') </small>
                        </h4>

                    </div><!--col-->

                </div><!--row-->



                <hr>

                

                <div class="row mt-4 mb-4">

                    <div class="col">

						<div class="form-group row">
                            {{html()->label(__('labels.backend.tender.table.title'))->class('col-md-2 form-control-label')->for(__('labels.backend.tender.table.title')) }}

                            <div class="col-md-10">
                                {{ html()->text('tender_title')
                                    ->class('form-control')
                                    ->placeholder(__('labels.backend.tender.table.title'))
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                            <span class="text-danger">{{ $errors->first('tender_title') }}</span>
                        </div><!--form-group-->

                        <div class="form-group row">

                            {{ html()->label('Category')->class('col-md-2 form-control-label')->for('category') }}



                            <div class="col-md-10">
                                {{
                                    html()->select('tender_category_id', $categories)
                                        ->class('form-control')
                                        ->id('material_category')
                                        ->required()
                                }}
                            </div><!--col-->

                        </div><!--form-group-->



                        <div class="form-group row">

                            {{ html()->label('Description')->class('col-md-2 form-control-label')->for('description') }}



                            <div class="col-md-10">

                                {{ html()->textarea('tender_description')

                                    ->class('form-control')

                                    ->placeholder('Description')

                                    ->required() }}

                            </div><!--col-->

                        </div><!--form-group-->
						
						<div class="form-group row">

                            {{html()->label('Rate')->class('col-md-2 form-control-label')->for('rate') }}



                            <div class="col-md-10">

                                {{ html()->text('tender_rate')

                                    ->class('form-control')

                                    ->placeholder('Rate')

                                    ->attribute('maxlength', 191)

                                    ->autofocus()
									->required()  }}

                            </div><!--col-->

                        </div><!--form-group-->
						
						
						<div class="form-group row">

                            {{html()->label('Budget')->class('col-md-2 form-control-label')->for('budget') }}



                            <div class="col-md-10">

                                {{

                                    html()->select('tender_budget', 

                                        [

                                            'Fixed' => 'Fixed',

                                            'Hourly' => 'Hourly',

                                            'per_m2' => 'cost/m2'

                                        ]

                                        )

                                        ->class('form-control')

                                        ->id('tender_budget')

                                        ->required()

                                }}

                            </div><!--col-->

                        </div><!--form-group-->
						
						<div class="form-group row">

                            {{ html()->label('Availability')->class('col-md-2 form-control-label')->for('ava
							ilability') }}



                            <div class="col-md-4">

                                {{ html()->date('tender_available_from')

                                    ->class('form-control')

                                    ->placeholder('Date')

                                    ->required() }}

                            </div><!--col-->

                            <div class="col-md-2">

                                {{ html()->date('tender_available_to')

                                    ->class('form-control')

                                    ->placeholder('Date')

                                    ->required() }}

                            </div>

                        </div><!--form-group-->
						
						<div class="form-group row">
                                    
                                    {{ html()->label(__('labels.backend.city.table.state'))->class('col-md-2 form-control-label')->for('labels.backend.state.table.language') }} 
                                    <div class="col-md-10">
                                        {{  html()->select('state_id', $state)
                                        ->class('form-control')
                                        ->id('state_id')
                                        ->value( )
                                        ->required()
                                         }}
                                
                                 
                                    
                                    </div> 
                                </div> 
						<div class="form-group row">
                            {{ html()->label('City')->class('col-md-2 form-control-label')->for('city') }}

                            <div class="col-md-10">
                            {{  html()->select('tender_city')
                                        ->class('form-control')
                                        ->id('tender_city')
                                        ->placeholder('City')
                                        ->value( )
                                        ->required()
                                         }}
                                         
                                 
                            </div><!--col-->
                        </div><!--form-group-->

                   

                        <div class="form-group row">

                            {{ html()->label('Pin code')->class('col-md-2 form-control-label')->for('tender_pincode') }}



                            <div class="col-md-10">

                                {{ html()->text('tender_pincode')

                                    ->class('form-control')

                                    ->placeholder('Pin code')

                                    ->required() }}

                            </div><!--col-->

                        </div><!--form-group-->



                        <div class="form-group row">
                            {{ html()->label('Post expires in')->class('col-md-2 form-control-label')->for('post_expiry') }}

                            <div class="col-md-4">
                                {{ html()->text('tender_expiry_days')
                                    ->class('form-control')
                                    ->placeholder('Days')
                                    ->required() }}
                            </div><!--col-->
                            <div class="col-md-2">
                                {{ html()->text('tender_expiry_hour')
                                    ->class('form-control')
                                    ->id('post_expiry_date')
                                    ->placeholder('Hours')
                                    ->required() }}
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Attachment')->class('col-md-2 form-control-label')->for('attachment') }}

                            <div class="col-md-10">
                                {{ html()->file('tender_attachment')
                                    ->class('form-control')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->



                        <div class="form-group row">
                            {{ html()->label('Featured Image')->class('col-md-2 form-control-label')->for('featured_image') }}

                            <div class="col-md-10">
                                {{ html()->file('tender_featured_image')
                                    ->class('form-control')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                       

                        

                        <div class="form-group row">
                            {{ html()->label('Slider Image')->class('col-md-2 form-control-label')->for('slider_image') }}

                            <div class="col-md-10">
                                <div class="input-group control-group increment" >
                                    {{ html()->file('tender_slider_image')
                                        ->name('tender_slider_image[]')
                                        ->class('form-control')
                                        ->required() }}
                                    <div class="input-group-btn">  
                                        <button class="btn btn-success button-add-image" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                    </div>
                                </div>
                                <div class="clone" style="display:none;" >
                                    <div class="input-group control-group mt-3" >
                                        {{ html()->file('tender_slider_image')
                                            ->name('tender_slider_image[]')
                                            ->class('form-control')
                                            ->required() }}
                                        <div class="input-group-btn">  
                                            <button class="btn btn-danger btn-remove-image" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div><!--col-->
                        </div><!--form-group-->

                    </div><!--col-->

                </div><!--row-->

            </div><!--card-body-->



            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.tender.index'), __('buttons.general.cancel')) }}
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
 $(document).ready(function() {
 
      $(".button-add-image").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-remove-image",function(){ 
          $(this).parents(".control-group").remove();
      });

      $(".button-add-deliverytype").click(function(){ 
          var html = $(".clone-deliverytype").html();
          $(".increment-deliverytype").after(html);
      });

      $("body").on("click",".btn-remove-deliverytype",function(){ 
          $(this).parents(".form-group").remove();
      });

    });
     </script>

<script>
 

    if ($("#tender_form").length > 0) {
        $("#tender_form").validate({
            rules: {
                tender_title: {
                    required: true,
                    maxlength: 50
                },
            },
            messages: {
 
                tender_title: {
                    required: "Please enter name",
                },
            },
        })
    } 
 </script>  
 <script>
   

 $(document).on('change', '#state_id', function(){
    var state_id = $('#state_id').val();
    var language = $('#language').val();
   
  $.ajax({
   url:"{{ route('admin.city.get_city_by_state') }}?state_id="+state_id+"&language="+language,
   success:function(data)
   {
    var select = $('form select[name=tender_city]');

                select.empty();

                $.each(data,function(key, value) {
                    select.append('<option value=' + key + '>' + value + '</option>');
                });
     
   }
  })
 });
     
 </script>  

@endpush