@extends('backend.layouts.app')

@section('title', 'Marketplace' . ' | ' . 'Edit Material Offer')

@section('breadcrumb-links')
    @include('backend.marketplace.material.offer-breadcrumb-links')
@endsection

@section('content')
     {{ html()->modelForm($tender,'PATCH', route('admin.tender.update',$tender->tender_id))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->attribute('id', 'tender_form')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Marketplace
                            <small class="text-muted">Edit material offer</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
                
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{html()->label(__('labels.backend.tender.table.category_type'))->class('col-md-2 form-control-label')->for(__('labels.backend.tender.table.category_type')) }}

                            <div class="col-md-10">
                           
                                {{  html()->select('tender_category_type', [
                                            '' => 'Select',
                                            'Work' => 'Work',
                                            'Material' => 'Material' 
                                        ] )
                                        ->class('form-control')
                                        ->id('tender_category_type')
                                        
                                        ->required()
                                         }}
                         
                            </div><!--col-->
                            <span class="text-danger">{{ $errors->first('tender_type') }}</span>
                        </div><!--form-group--> 
                        <div class="form-group row">
                            {{html()->label('Title')->class('col-md-2 form-control-label')->for('title') }}

                            <div class="col-md-10">
                                {{ html()->text('tender_title')
                                    ->class('form-control')
                                    ->placeholder('Title')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Category')->class('col-md-2 form-control-label')->for('tender_category') }}

                            <div class="col-md-10">
                                {{
                                    html()->select('tender_category_id', $categories)
                                        ->class('form-control')
                                        ->id('tender_category')
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
                             {{ html()->label('Quantity')->class('col-md-2 form-control-label')->for('quantity') }}

                            <div class="col-md-10">
                                {{ html()->text('tender_quantity')
                                    ->class('form-control')
                                    ->placeholder('Quantity')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                   
                        <div class="form-group row">
                            {{ html()->label('Cost')->class('col-md-2 form-control-label')->for('cost_per_unit') }}

                            <div class="col-md-4">
                                {{ html()->text('tender_cost_per_unit')
                                    ->class('form-control')
                                    ->placeholder('100')
                                    ->required() }}
                            </div>
                       
                            {{ html()->label('Unit')->class('col-md-1 form-control-label')->for('unit') }}

                            <div class="col-md-2">
                                {{
                                    html()->select('tender_unit', 
                                        [
                                            'Kg' => 'Kg',
                                            'M2' => 'M2',
                                            'Liter' => 'Liter',
                                            'Pcs' => 'Pcs',
                                            'Other' => 'Other'
                                        ]
                                        )
                                        ->class('form-control')
                                        ->id('unit')
                                        ->required()
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                    
                        <div class="form-group row">
                            {{ html()->label('City')->class('col-md-2 form-control-label')->for('city') }}

                            <div class="col-md-10">
                                {{ html()->text('tender_city')
                                    ->class('form-control')
                                    ->placeholder('City')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Pin code')->class('col-md-2 form-control-label')->for('pincode') }}

                            <div class="col-md-10">
                                {{ html()->text('tender_pincode')
                                    ->class('form-control')
                                    ->placeholder('Pin code')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Warranty')->class('col-md-2 form-control-label')->for('warranty') }}

                            <div class="col-md-4">
                                {{ html()->text('tender_warranty')
                                    ->class('form-control')
                                    ->placeholder('10')
                                    ->required() }}
                            </div>

                            <div class="col-md-2">
                                {{
                                    html()->select('tender_warranty_type', 
                                        [
                                            'Days' => 'Days',
                                            'Week' => 'Week',
                                            'Month' => 'Month',
                                            'Year' => 'Year'
                                        ]
                                        )
                                        ->class('form-control')
                                        ->required()
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row increment-deliverytype">
                            {{ html()->label('Delivery type')->class('col-md-2 form-control-label')->for('delivery_type') }}

                            <div class="col-md-4">
                                {{
                                    html()->select('tender_delivery_type[]', 
                                        [
                                            '' => 'Select',
                                            'Flight' => 'Flight',
                                            'Road' => 'Road',
                                            'Ship' => 'Ship'
                                        ]
                                        )
                                        ->class('form-control')
                                         
                                }}
                                
                            </div>
                             {{ html()->label('Delivery cost')->class('col-md-2 form-control-label')->for('delivery_cost') }}
                            <div class="col-md-2">
                                {{ html()->text('tender_delivery_cost[]')
                                    ->class('form-control')
                                    ->placeholder('1000')
                                     }}
                            </div><!--col-->
                            <div class="col-md-2">
                                <div class="input-group-btn">  
                                    <button class="btn btn-success button-add-deliverytype" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                </div>
                            </div>
                        </div><!--form-group-->
                        @php
                if(!empty($tender->tender_delivery_type_cost)):
                $deliverytype_cost = json_decode($tender->tender_delivery_type_cost);
                foreach($deliverytype_cost as $type=>$cost):
                    if(!empty($type) && !empty($cost)):
                @endphp
                        <div class="form-group row">
                            {{ html()->label('Delivery type')->class('col-md-2 form-control-label')->for('delivery_type') }}

                            <div class="col-md-4">
                                {{
                                    html()->select('tender_delivery_type[]', 
                                        [
                                            '' => 'Select',
                                            'Flight' => 'Flight',
                                            'Road' => 'Road',
                                            'Ship' => 'Ship'
                                        ]
                                        )
                                        ->class('form-control')
                                        ->value($type)
                                        ->required()
                                }}
                                
                            </div>
                            {{ html()->label('Delivery cost')->class('col-md-2 form-control-label')->for('delivery_cost') }}
                            <div class="col-md-2">
                                {{ html()->text('tender_delivery_cost[]')
                                    ->class('form-control')
                                    ->value($cost)
                                    ->placeholder('1000')
                                    ->required() }}
                            </div><!--col-->

                            <div class="input-group-btn">  
                                <button class="btn btn-danger btn-remove-deliverytype" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                            </div>
                        </div>
                @php
                    endif;
                    endforeach;
                    endif;
                @endphp
                         <div class="clone-deliverytype" style="display:none;" >
                                <div class="form-group row">
                                   {{ html()->label('Delivery type')->class('col-md-2 form-control-label')->for('delivery_type') }}

                                    <div class="col-md-4">
                                        {{
                                            html()->select('tender_delivery_type[]', 
                                                [
                                                    '' => 'Select',
                                                    'Flight' => 'Flight',
                                                    'Road' => 'Road',
                                                    'Ship' => 'Ship'
                                                ]
                                                )
                                                ->class('form-control')
                                                ->required()
                                        }}
                                        
                                    </div>
                                     {{ html()->label('Delivery cost')->class('col-md-2 form-control-label')->for('delivery_cost') }}
                                    <div class="col-md-2">
                                        {{ html()->text('tender_delivery_cost[]')
                                            ->class('form-control')
                                            ->placeholder('1000')
                                            ->required() }}
                                    </div><!--col-->

                                    <div class="input-group-btn">  
                                        <button class="btn btn-danger btn-remove-deliverytype" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                    </div>
                                </div>
                            </div>

                        <div class="form-group row">
                            @php
                            
                            $diff = datetimeDiff($tender->tender_expiry_date);

                            @endphp
                            {{ html()->label('Post expires in')->class('col-md-2 form-control-label')->for('post_expiry') }}

                            <div class="col-md-4">
                                {{ html()->text('tender_expiry_days')
                                    ->class('form-control')
                                    ->placeholder('Days')
                                    ->value($diff['day'])
                                    ->required() }}
                            </div><!--col-->
                            <div class="col-md-2">
                                {{ html()->text('tender_expiry_hour')
                                    ->class('form-control')
                                    ->value($diff['hour'])
                                    ->placeholder('Hours')
                                    ->required() }}
                            </div>
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Attachment')->class('col-md-2 form-control-label')->for('attachment') }}

                            <div class="col-md-10">
                                {{ html()->file('tender_attachment')
                                    ->class('form-control')
                                    }}
                                    @if(!empty($tender->tender_attachment))
                                @php
                                    $file = url('/images/marketplace/material/'.$tender->tender_attachment);
                                @endphp
                                <span>
                                    <i class="fa fa-paperclip"></i>
                                    <a href="{{$file}}" target="_blank">{{$tender->tender_attachment}}</a>
                                </span>
                                @endif
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Featured Image')->class('col-md-2 form-control-label')->for('featured_image') }}

                            <div class="col-md-10">
                                {{ html()->file('tender_featured_image')
                                    ->class('form-control')
                                      }}

                                @if(isset($tender->tender_featured_image) &&!empty($tender->tender_featured_image))
                                    @php
                                        $image = url('/images/marketplace/material/'.$tender->tender_featured_image);
                                    @endphp
                                    <span>
                                    <img src="{{ $image }}" style="width:100px" alt="Featured image">
                                    </span>
                                @endif
                            </div><!--col-->
                        </div><!--form-group-->
                       
                        
                        <div class="form-group row">
                            {{ html()->label('Slider Image')->class('col-md-2 form-control-label')->for('slider_image') }}

                            <div class="col-md-10">
                                <div class="input-group control-group increment" >
                                    {{ html()->file('tender_slider_image')
                                        ->name('tender_slider_image[]')
                                        ->class('form-control')
                                         }}
                                    <div class="input-group-btn">  
                                        <button class="btn btn-success button-add-image" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                    </div>
                                </div>
                                 @php
                                $slider_images = [];
                                if(!empty($tender->tender_slider_images)){
                                    $slider_images = json_decode($tender->tender_slider_images);
                                }
                                @endphp
                                @if( count($slider_images) > 0 )
                                    @foreach($slider_images as $key=>$sliderimage)
                                        @php
                                            $image = url('/images/marketplace/material/'.$sliderimage);
                                        @endphp
                                        <span>
                                            <img src="{{ $image }}" style="width:100px" alt="Pic">
                                            <a href="{{ route('admin.marketplace.MaterialOffer.deleteimage', [$tender->tender_id, $key]) }}" data-method="get" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" data-trans-button-cancel="@lang('buttons.general.cancel')" data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="@lang('strings.backend.general.are_you_sure')" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </span>
                                    @endforeach
                                @endif
                                <div class="clone" style="display:none;" >
                                    <div class="input-group control-group mt-3" >
                                        {{ html()->file('tender_slider_image')
                                            ->name('tender_slider_image[]')
                                            ->class('form-control')
                                              }}
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
                        {{ form_submit(__('buttons.general.crud.update')) }}
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
@endpush