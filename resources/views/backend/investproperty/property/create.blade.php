@extends('backend.layouts.app')

@section('title', 'Property Management' . ' | ' . 'Create Property')

@section('breadcrumb-links')
    @include('backend.property.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.property.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Property Management
                            <small class="text-muted">Create Property</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
                
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label('Property Title')->class('col-md-2 form-control-label')->for('title') }}

                            <div class="col-md-10">
                                {{ html()->text('title')
                                    ->class('form-control')
                                    ->placeholder('Property Title')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Property Name')->class('col-md-2 form-control-label')->for('name') }}

                            <div class="col-md-10">
                                {{ html()->text('name')
                                    ->class('form-control')
                                    ->placeholder('Property Name')
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div>
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Appartment Type')->class('col-md-2 form-control-label')->for('appartment_type') }}

                            <div class="col-md-10">
                                {{
                                    html()->select('appartment_type', 
                                            [
                                                '' => 'Please Select',
                                                'Omakotitalo' => 'Omakotitalo',
                                                'Rivitalo' => 'Rivitalo',
                                                'Kerrostalo' => 'Kerrostalo',
                                                'Paritalo' => 'Paritalo'
                                            ]
                                        )
                                        ->class('form-control')
                                        ->id('p-Aihe')
                                        ->required()
                                }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Property Details')->class('col-md-2 form-control-label')->for('details') }}

                            <div class="col-md-10">
                                {{ html()->textarea('details')
                                    ->class('form-control')
                                    ->placeholder('Property Details')
                                    ->required() }}
                                    <!-- ->attribute('maxlength', 191) -->
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Property Area')->class('col-md-2 form-control-label')->for('area') }}

                            <div class="col-md-10">
                                {{ html()->text('area')
                                    ->class('form-control')
                                    ->placeholder('Property Area')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Property Address')->class('col-md-2 form-control-label')->for('address') }}

                            <div class="col-md-10">
                                {{ html()->text('address')
                                    ->class('form-control')
                                    ->placeholder('Property Address')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Property Size')->class('col-md-2 form-control-label')->for('size') }}

                            <div class="col-md-10">
                                {{ html()->text('size')
                                    ->class('form-control')
                                    ->placeholder('Property Size')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Property Rooms')->class('col-md-2 form-control-label')->for('rooms') }}

                            <div class="col-md-10">
                                {{ html()->text('rooms')
                                    ->class('form-control')
                                    ->placeholder('Property Rooms')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Property Price')->class('col-md-2 form-control-label')->for('price') }}

                            <div class="col-md-10">
                                {{ html()->text('price')
                                    ->class('form-control')
                                    ->placeholder('Property Price')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Manager Name')->class('col-md-2 form-control-label')->for('manager_name') }}

                            <div class="col-md-10">
                                {{ html()->text('manager_name')
                                    ->class('form-control')
                                    ->placeholder('Manager Name')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Built Year')->class('col-md-2 form-control-label')->for('built_year') }}

                            <div class="col-md-10">
                                {{ html()->text('built_year')
                                    ->class('form-control')
                                    ->placeholder('Built Year')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Apartment No')->class('col-md-2 form-control-label')->for('apartment_no') }}

                            <div class="col-md-10">
                                {{ html()->text('apartment_no')
                                    ->class('form-control')
                                    ->placeholder('Apartment No')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Planned Renovation')->class('col-md-2 form-control-label')->for('planned_renovation') }}

                            <div class="col-md-10">
                                {{ html()->text('planned_renovation')
                                    ->class('form-control')
                                    ->placeholder('Planned Renovation')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Done Renovation')->class('col-md-2 form-control-label')->for('done_renovation') }}

                            <div class="col-md-10">
                                {{ html()->text('done_renovation')
                                    ->class('form-control')
                                    ->placeholder('Done Renovation')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Land Ownership')->class('col-md-2 form-control-label')->for('land_ownership') }}

                            <div class="col-md-10">
                                {{ html()->text('land_ownership')
                                    ->class('form-control')
                                    ->placeholder('Land Ownership')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Land Area')->class('col-md-2 form-control-label')->for('land_area') }}

                            <div class="col-md-10">
                                {{ html()->text('land_area')
                                    ->class('form-control')
                                    ->placeholder('Land Area')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Heating Method')->class('col-md-2 form-control-label')->for('heating_method') }}

                            <div class="col-md-10">
                                {{ html()->text('heating_method')
                                    ->class('form-control')
                                    ->placeholder('Heating Method')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Month Appartment Cost')->class('col-md-2 form-control-label')->for('month_appartment_cost') }}

                            <div class="col-md-10">
                                {{ html()->text('month_appartment_cost')
                                    ->class('form-control')
                                    ->placeholder('Month Appartment Cost')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Month Appartment Capital')->class('col-md-2 form-control-label')->for('month_appartment_capital') }}

                            <div class="col-md-10">
                                {{ html()->text('month_appartment_capital')
                                    ->class('form-control')
                                    ->placeholder('Month Appartment Capital')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Water Cost')->class('col-md-2 form-control-label')->for('water_cost') }}

                            <div class="col-md-10">
                                {{ html()->text('water_cost')
                                    ->class('form-control')
                                    ->placeholder('Water Cost')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Other Appartment Cost')->class('col-md-2 form-control-label')->for('other_appartment_cost') }}

                            <div class="col-md-10">
                                {{ html()->text('other_appartment_cost')
                                    ->class('form-control')
                                    ->placeholder('Other Appartment Cost')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Primary Image')->class('col-md-2 form-control-label')->for('property_image') }}

                            <div class="col-md-10">
                                {{ html()->file('property_primary_image')
                                    ->class('form-control')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Property Image')->class('col-md-2 form-control-label')->for('property_image') }}

                            <div class="col-md-10">
                                <div class="input-group control-group increment" >
                                    {{ html()->file('property_image')
                                        ->name('property_image[]')
                                        ->class('form-control')
                                        ->required() }}
                                    <div class="input-group-btn">  
                                        <button class="btn btn-success button-add-image" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                                    </div>
                                </div>
                                <div class="clone" style="display:none;" >
                                    <div class="input-group control-group mt-3" >
                                        {{ html()->file('property_image')
                                            ->name('property_image[]')
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
                        {{ form_cancel(route('admin.property.index'), __('buttons.general.cancel')) }}
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

    });
     </script>
@endpush