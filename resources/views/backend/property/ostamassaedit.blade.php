@extends('backend.layouts.app')

@section('title', 'Property Management' . ' | ' . 'Ostamassa  Property')

@section('content')
    {{ html()->modelForm($propertyContact,'PATCH', route('admin.property.ostamassa_update',$propertyContact->id))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Property Management
                            <small class="text-muted">Ostamassa Property Edit</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label('Name')->class('col-md-2 form-control-label')->for('name') }}

                            <div class="col-md-10">
                                {{ html()->text('name')
                                    ->class('form-control')
                                    ->placeholder('Name')
                                    ->attribute('maxlength', 191)
                                    ->attribute('readonly', true)
                                    ->attribute('disabled', 'disabled')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Phone')->class('col-md-2 form-control-label')->for('phone') }}

                            <div class="col-md-10">
                                {{ html()->text('phone')
                                    ->class('form-control')
                                    ->placeholder('Phone')
                                    ->attribute('maxlength', 191)
                                    ->attribute('readonly', true)
                                    ->attribute('disabled', 'disabled')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Email')->class('col-md-2 form-control-label')->for('email') }}

                            <div class="col-md-10">
                                {{ html()->text('email')
                                    ->class('form-control')
                                    ->placeholder('Email')
                                    ->attribute('maxlength', 191)
                                    ->attribute('readonly', true)
                                    ->attribute('disabled', 'disabled')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Appartment Min Size')->class('col-md-2 form-control-label')->for('appartment_min_size') }}

                            <div class="col-md-10">
                                {{ html()->text('appartment_min_size')
                                    ->class('form-control')
                                    ->placeholder('Appartment Min Size')
                                    ->attribute('maxlength', 191)
                                    ->attribute('type', 'number')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Appartment Max Size')->class('col-md-2 form-control-label')->for('appartment_max_size') }}

                            <div class="col-md-10">
                                {{ html()->text('appartment_max_size')
                                    ->class('form-control')
                                    ->placeholder('Appartment Max Size')
                                    ->attribute('maxlength', 191)
                                    ->attribute('type', 'number')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Rooms Min')->class('col-md-2 form-control-label')->for('rooms_min') }}

                            <div class="col-md-10">
                                {{ html()->text('rooms_min')
                                    ->class('form-control')
                                    ->placeholder('Rooms Min')
                                    ->attribute('maxlength', 191)
                                    ->attribute('type', 'number')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Rooms Max')->class('col-md-2 form-control-label')->for('rooms_max') }}

                            <div class="col-md-10">
                                {{ html()->text('rooms_max')
                                    ->class('form-control')
                                    ->placeholder('Rooms Max')
                                    ->attribute('maxlength', 191)
                                    ->attribute('type', 'number')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <?php 
                            $propertyYear = [];

							for($i=2000;$i<=date('Y');$i++){
    							$propertyYear[$i] = $i;    
							}
                            ?>
                            
                        <div class="form-group row">
                            {{ html()->label('Construction Year Min')->class('col-md-2 form-control-label')->for('construction_year_min') }}

                            <div class="col-md-10">
                                {{
                                    html()->select('construction_year_min', $propertyYear )
                                    ->class('form-control')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Construction Year Max')->class('col-md-2 form-control-label')->for('construction_year_max') }}

                            <div class="col-md-10">
                                {{
                                    html()->select('construction_year_max', $propertyYear )
                                    ->class('form-control')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Property Type')->class('col-md-2 form-control-label')->for('property_type') }}

                            <div class="col-md-10">
                                {{
                                    html()->select('property_type', 
                                            [
                                                'Omakotitalo' => 'Omakotitalo',
                                                'Rivitalo' => 'Rivitalo',
                                                'Kerrostalo' => 'Kerrostalo',
                                                'Paritalo' => 'Paritalo'
                                            ]
                                        )
                                    ->class('form-control')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Appartment min price')->class('col-md-2 form-control-label')->for('appartment_min_price') }}

                            <div class="col-md-10">
                                {{ html()->text('appartment_min_price')
                                    ->class('form-control')
                                    ->placeholder('appartment_max_price')
                                    ->attribute('maxlength', 191)
                                    ->attribute('type', 'number')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('appartment_max_price')->class('col-md-2 form-control-label')->for('appartment_max_price') }}

                            <div class="col-md-10">
                                {{ html()->text('appartment_max_price')
                                    ->class('form-control')
                                    ->placeholder('Appartment max price')
                                    ->attribute('maxlength', 191)
                                    ->attribute('type', 'number')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Condition')->class('col-md-2 form-control-label')->for('condition') }}

                            <div class="col-md-10">
                                {{
                                    html()->select('condition', 
                                            [
                                                'Loistava' => 'Loistava',
                                                'Tyydyttava' => 'Tyydyttävä',
                                                'Hyva' => 'Hyvä',
                                                'Välttava' => 'Välttävä'
                                            ]
                                        )
                                    ->class('form-control')
                                }}
                            </div><!--col-->
                        </div><!--form-group-->
            
                        <div class="form-group row">
                            {{ html()->label('Additional Requests')->class('col-md-2 form-control-label')->for('additional_requests') }}

                            <div class="col-md-10">
                                {{ html()->textarea('additional_requests')
                                    ->class('form-control')
                                    ->placeholder('Additional Requests')
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->
                        

                        <div class="form-group row">
                            {{ html()->label('Appartment photo')->class('col-md-2 form-control-label')->for('appartment_photo') }}

                            <div class="col-md-10">
                                 @if(isset($propertyContact->appartment_photo) &&!empty($propertyContact->appartment_photo))
                                    @php
                                        $image = url('/images/contactform/'.$propertyContact->appartment_photo);
                                    @endphp
                                    <span>
                                        <img src="{{ $image }}" style="width:250px" alt="Propert picture">
                                    </span>
                                @endif
                                {{ html()->file('appartment_photo')
                                    ->class('form-control')
                                     }}
                            </div><!--col-->
                        </div><!--form-group-->

                        
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.property.ostamassa'), __('buttons.general.cancel')) }}
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

    });
     </script>
@endpush