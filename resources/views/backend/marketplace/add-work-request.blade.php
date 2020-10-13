<!-- @extends('backend.layouts.app') -->



@section('title', app_name() . ' | ' . 'Create Work Request')

@section('breadcrumb-links')

    @include('backend.marketplace.request-breadcrumb-links')

@endsection

@section('content')
{{ html()->form('POST', route('admin.marketplace.WorkRequests.create'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}

        <div class="card">

            <div class="card-body">

                <div class="row">

                    <div class="col-sm-5">

                        <h4 class="card-title mb-0">

                            Marketplace

                            <small class="text-muted">Create work request</small>

                        </h4>

                    </div><!--col-->

                </div><!--row-->



                <hr>

                

                <div class="row mt-4 mb-4">

                    <div class="col">

                        <div class="form-group row">

                            {{html()->label('Title')->class('col-md-2 form-control-label')->for('title') }}



                            <div class="col-md-10">

                                {{ html()->text('title')

                                    ->class('form-control')

                                    ->placeholder('Title')

                                    ->attribute('maxlength', 191)

                                    ->required()

                                    ->autofocus() }}

                            </div><!--col-->

                        </div><!--form-group-->

                        <div class="form-group row">

                            {{ html()->label('Category')->class('col-md-2 form-control-label')->for('category') }}



                            <div class="col-md-10">

                                <select class="form-control" name="categoryId">
									<option value="">Select Category</option>
								@foreach($categories as $cat)
									<option value="{{ $cat->wc_id }}">{{ $cat->name }}</option>
								@endforeach
								</select>

                            </div><!--col-->

                        </div><!--form-group-->



                        <div class="form-group row">

                            {{ html()->label('Description')->class('col-md-2 form-control-label')->for('description') }}



                            <div class="col-md-10">

                                {{ html()->textarea('description')

                                    ->class('form-control')

                                    ->placeholder('Description')

                                    ->required() }}

                            </div><!--col-->

                        </div><!--form-group-->
						
						<div class="form-group row">

                            {{html()->label('Rate')->class('col-md-2 form-control-label')->for('rate') }}



                            <div class="col-md-10">

                                {{ html()->text('rate')

                                    ->class('form-control')

                                    ->placeholder('Rate')

                                    ->attribute('maxlength', 191)

                                    ->autofocus() }}

                            </div><!--col-->

                        </div><!--form-group-->
						
						
						<div class="form-group row">

                            {{html()->label('Budget')->class('col-md-2 form-control-label')->for('budget') }}



                            <div class="col-md-10">

                                {{

                                    html()->select('budget', 

                                        [

                                            'Fixed' => 'Fixed',

                                            'Hourly' => 'Hourly',

                                            'per_m2' => 'cost/m2'

                                        ]

                                        )

                                        ->class('form-control')

                                        ->id('budget')

                                        ->required()

                                }}

                            </div><!--col-->

                        </div><!--form-group-->
						
						<div class="form-group row">

                            {{ html()->label('Availability')->class('col-md-2 form-control-label')->for('ava
							ilability') }}



                            <div class="col-md-4">

                                {{ html()->date('available_from')

                                    ->class('form-control')

                                    ->placeholder('Date')

                                    ->required() }}

                            </div><!--col-->

                            <div class="col-md-2">

                                {{ html()->date('available_to')

                                    ->class('form-control')

                                    ->placeholder('Date')

                                    ->required() }}

                            </div>

                        </div><!--form-group-->
						
						<div class="form-group row">

                            {{ html()->label('City')->class('col-md-2 form-control-label')->for('city') }}



                            <div class="col-md-10">

                                <select class="form-control" name="city" required>
									<option value="">Select City</option>
								@foreach($cities as $city)
									<option value="{{ $city->name }}">{{ $city->name }}</option>
								@endforeach
								</select>

                            </div><!--col-->

                        </div><!--form-group-->

                   

                        <div class="form-group row">

                            {{ html()->label('Pin code')->class('col-md-2 form-control-label')->for('pincode') }}



                            <div class="col-md-10">

                                {{ html()->text('pincode')

                                    ->class('form-control')

                                    ->placeholder('Pin code')

                                    ->required() }}

                            </div><!--col-->

                        </div><!--form-group-->



                        <div class="form-group row">

                            {{ html()->label('Post expires in')->class('col-md-2 form-control-label')->for('post_expiry') }}



                            <div class="col-md-4">

                                {{ html()->text('post_expiry_days')

                                    ->class('form-control')

                                    ->placeholder('Days')

                                    ->required() }}

                            </div><!--col-->

                            <div class="col-md-2">

                                {{ html()->text('post_expiry_hour')

                                    ->class('form-control')

                                    ->id('post_expiry_date')

                                    ->placeholder('Hours')

                                    ->required() }}

                            </div>

                        </div><!--form-group-->

                        <div class="form-group row">

                            {{ html()->label('Attachment')->class('col-md-2 form-control-label')->for('attachment') }}



                            <div class="col-md-10">

                                {{ html()->file('attachment')

                                    ->class('form-control')

                                    ->required() }}

                            </div><!--col-->

                        </div><!--form-group-->



                        <div class="form-group row">

                            {{ html()->label('Featured Image')->class('col-md-2 form-control-label')->for('featured_image') }}



                            <div class="col-md-10">

                                {{ html()->file('featured_image')

                                    ->class('form-control')

                                    ->required() }}

                            </div><!--col-->

                        </div><!--form-group-->

                       

                        

                        <div class="form-group row">

                            {{ html()->label('Slider Image')->class('col-md-2 form-control-label')->for('slider_image') }}



                            <div class="col-md-10">

                                <div class="input-group control-group increment" >

                                    {{ html()->file('slider_image')

                                        ->name('slider_image[]')

                                        ->class('form-control')

                                        ->required() }}

                                    <div class="input-group-btn">  

                                        <button class="btn btn-success button-add-image" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>

                                    </div>

                                </div>

                                <div class="clone" style="display:none;" >

                                    <div class="input-group control-group mt-3" >

                                        {{ html()->file('slider_image')

                                            ->name('slider_image[]')

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

                        {{ form_cancel(route('admin.marketplace.WorkRequests'), __('buttons.general.cancel')) }}

                    </div><!--col-->



                    <div class="col text-right">
						<input type="hidden" name="post_type" value="Request">
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



    });

     </script>

@endpush