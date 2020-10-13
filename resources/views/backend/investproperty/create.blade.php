@extends('backend.layouts.app')

@section('title', 'Invest Property Management' . ' | ' . 'Create Invest Property')

@section('breadcrumb-links')
    @include('backend.investproperty.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.investproperty.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Invest Property Management
                            <small class="text-muted">Create Invest Property</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
                                    
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label('Title')->class('col-md-2 form-control-label')->for('title') }}

                            <div class="col-md-10">
                                {{ html()->text('title')
                                    ->class('form-control')
                                    ->placeholder('Title')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <!--<div class="form-group row">
                            {{ html()->label('Name')->class('col-md-2 form-control-label')->for('name') }}

                            <div class="col-md-10">
                                {{ html()->text('name')
                                    ->class('form-control')
                                    ->placeholder('Name')
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div>< !--col-- >
                        </div>< !--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Appartment Type')->class('col-md-2 form-control-label')->for('appartment_type') }}

                            <div class="col-md-10">
                                {{
                                    html()->select('appartment_type', 
                                            [
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
                            {{ html()->label('Details')->class('col-md-2 form-control-label')->for('details') }}

                            <div class="col-md-10">
                                {{ html()->textarea('details')
                                    ->class('form-control')
                                    ->placeholder('Details')
                                    ->required() }}
                                    <!-- ->attribute('maxlength', 191) -->
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Location')->class('col-md-2 form-control-label')->for('location') }}

                            <div class="col-md-10">
                                {{ html()->text('location')
                                    ->class('form-control')
                                    ->placeholder('Location')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Buying Price')->class('col-md-2 form-control-label')->for('price') }}

                            <div class="col-md-10">
                                {{ html()->text('price')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Buying Price')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Selling Price')->class('col-md-2 form-control-label')->for('selling_price') }}

                            <div class="col-md-10">
                                {{ html()->text('selling_price')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Selling Price')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label('Invest Price')->class('col-md-2 form-control-label')->for('invest_price') }}

                            <div class="col-md-10">
                                {{ html()->text('invest_price')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Invest Price')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Target Price')->class('col-md-2 form-control-label')->for('target_price') }}

                            <div class="col-md-10">
                                {{ html()->text('target_price')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Target Price')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Profit')->class('col-md-2 form-control-label')->for('profit') }}

                            <div class="col-md-10">
                                {{ html()->text('profit')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Profit')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Net Return')->class('col-md-2 form-control-label')->for('net_return') }}

                            <div class="col-md-10">
                                {{ html()->text('net_return')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Net Return')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Capital Growth')->class('col-md-2 form-control-label')->for('capital_growth') }}

                            <div class="col-md-10">
                                {{ html()->text('capital_growth')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Capital Growth')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Liquidation')->class('col-md-2 form-control-label')->for('liquidation') }}

                            <div class="col-md-10">
                                {{ html()->text('liquidation')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Liquidation')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Bathroom')->class('col-md-2 form-control-label')->for('bathroom') }}

                            <div class="col-md-10">
                                {{ html()->text('bathroom')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Bathroom')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Kitchen')->class('col-md-2 form-control-label')->for('kitchen') }}

                            <div class="col-md-10">
                                {{ html()->text('kitchen')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Kitchen')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Painting')->class('col-md-2 form-control-label')->for('painting') }}

                            <div class="col-md-10">
                                {{ html()->text('painting')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Painting')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Flooring')->class('col-md-2 form-control-label')->for('flooring') }}

                            <div class="col-md-10">
                                {{ html()->text('flooring')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Flooring')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Interior Design')->class('col-md-2 form-control-label')->for('interior_design') }}

                            <div class="col-md-10">
                                {{ html()->text('interior_design')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Interior Design')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Broker Fee')->class('col-md-2 form-control-label')->for('broker_fee') }}

                            <div class="col-md-10">
                                {{ html()->text('broker_fee')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Broker Fee')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Taxes')->class('col-md-2 form-control-label')->for('taxes') }}

                            <div class="col-md-10">
                                {{ html()->text('taxes')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Taxes')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label('Month Cost')->class('col-md-2 form-control-label')->for('monthly_cost') }}

                            <div class="col-md-10">
                                {{ html()->text('monthly_cost')
                                    ->attribute('type', 'number')
                                    ->class('form-control')
                                    ->placeholder('Month Cost')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label('Image')->class('col-md-2 form-control-label')->for('document') }}

                            <div class="col-md-10">
                                {{ html()->file('image')
                                    ->class('form-control')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                            {{ html()->label('Document')->class('col-md-2 form-control-label')->for('image') }}

                            <div class="col-md-10">
                                {{ html()->file('document')
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
                        {{ form_cancel(route('admin.investproperty.index'), __('buttons.general.cancel')) }}
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
