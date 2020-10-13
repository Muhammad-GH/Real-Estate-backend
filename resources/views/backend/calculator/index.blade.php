<!-- @extends('backend.layouts.app') -->

@section('title', app_name() . ' | ' . 'Calculator Management')

@section('breadcrumb-links')
    @include('backend.setting.includes.breadcrumb-calculator-link')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row" style="border-bottom: 1px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-5">
                    <h3 class="card-title mb-0">
                        Calculator Management
                    </h3>
                </div><!--col-->
                <div class="col-sm-7">
                </div><!--col-->
            </div><!--row-->
        </div>
        <div class="card-body">
            <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-5">
                    <h5>Appartment Condition Pricing</h5>
                </div><!--col-->
                <div class="col-sm-7">
                    <button class="btn btn-primary float-right" id="edit-appartment" attr-type="edit">
                        Edit
                    </button>
                    <button class="btn btn-danger float-right cancel-edit" attr-class="appartment" attr-id="edit-appartment" style="margin-right:5px;display: none;">
                        Cancel
                    </button>
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4">
                <div class="col">
                    @include('backend.calculator.create-appartment')
                    {{ html()->form('POST', route('admin.calculator.updateapprtment'))->class('form-horizontal')->id('appartment-form')->attribute('novalidate', true)->open() }}
                    <div class="row small-input">
                        @foreach($appartment  as $data)
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label><b>{{ $data->name }}</b></label>
                                    </div>
                                    <div class="col-lg-8"></div>

                                    <div class="col-lg-4">
                                        <label>Poor Value</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm appartment"
                                               name="appartment[{{$data->id }}][poor_value]"
                                               value="{{$data->poor_value }}" readonly>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>Average Value</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm appartment"
                                               name="appartment[{{$data->id }}][avg_value]"
                                               value="{{$data->avg_value }}" readonly>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>Excellent Value</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm appartment"
                                               name="appartment[{{$data->id }}][excellent_value]"
                                               value="{{$data->excellent_value }}" readonly>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div><!--col-->
                    {{ html()->form()->close() }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
        <div class="card-body">
            <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-5">
                    <h5>Property Condition Pricing </h5>
                </div><!--col-->
                <div class="col-sm-7">
                    <button class="btn btn-primary float-right" id="edit-property" attr-type="edit">
                        Edit
                    </button>
                    <button class="btn btn-danger float-right cancel-edit" attr-class="property" attr-id="edit-property" style="margin-right:5px;display: none;">
                        Cancel
                    </button>
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4">
                <div class="col">
                    @include('backend.calculator.create-property')
                    {{ html()->form('POST', route('admin.calculator.updateproperty'))->class('form-horizontal')->id('property-form')->attribute('novalidate', true)->open() }}
                    <div class="row small-input">
                        @foreach($property  as $data)
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <label><b>{{ $data->name }}</b></label>
                                    </div>
                                    <div class="col-lg-7"></div>
                                    <div class="col-lg-5">
                                        <label>Already Renovated</label>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control input-sm property"
                                               name="property[{{$data->id }}][renovated_value]" readonly
                                               value="{{$data->renovated_value }}">
                                    </div>
                                    <div class="col-lg-5">
                                        <label>No Renovated</label>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control input-sm property"
                                               name="property[{{$data->id }}][norenovated_value]" readonly
                                               value="{{$data->norenovated_value }}">
                                    </div>

                                    <div class="col-lg-5">
                                        <label>Dont Know</label>
                                    </div>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control input-sm property"
                                               name="property[{{$data->id }}][dontknow_value]" readonly
                                               value="{{$data->dontknow_value }}">
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ html()->form()->close() }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-body-->
        @include('backend.calculator.create-area',['city' => $city]);
    <div class="card">
        <div class="card-body">
            <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-5">
                    <h5>Area Max Selling Price </h5>
                </div><!--col-->
                <div class="col-sm-7">
                    <button class="btn btn-primary float-right" id="edit-area" attr-type="edit">
                        Edit
                    </button>
                    <button class="btn btn-danger float-right cancel-edit" attr-class="area" attr-id="edit-area" style="margin-right:5px;display: none;">
                        Cancel
                    </button>
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4">
                <div class="col">
                    <?php
                    $in_one = round($areaSelling->count() / 3);
                    if($areaSelling->count()%3 == 1){
                        $in_one = $in_one+1;
                    }
                    $i = 0;
                    ?>
                    {{ html()->form('POST', route('admin.calculator.updateareaselling'))->class('form-horizontal')->id('area-form')->attribute('novalidate', true)->open() }}
                    <div class="row table-input" style="margin-top: 10px;">
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>City</th>
                                        <th>Postal Code</th>
                                        <th>Price/m2</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($areaSelling  as $data)
                                        <?php

                                        if($in_one == $i){
                                        $i = 0; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-condensed">
                                    <thead>
                                    <tr>
                                        <th>City</th>
                                        <th>Postal Code</th>
                                        <th>Price/m2</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <select name="area[{{$data->id }}][city]" id="city" class="form-control input-sm area" disabled="disabled">
                                                <option value="">Select City</option>
                                                <?php
                                                if($city->count() > 0){
                                                    foreach($city  as $cdata){ ?>
                                                    <option value="<?= $cdata->id ?>" <?php if($cdata->id == $data->city){ echo'selected';} ?>><?= $cdata->name ?></option>
                                                    <?php
                                                    }
                                                } ?>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control input-sm area"
                                                   name="area[{{$data->id }}][postal_code]" readonly
                                                   value="{{ $data->postal_code }}">

                                        </td>
                                        <td>
                                            <input type="text" class="form-control input-sm area"
                                                   name="area[{{$data->id }}][price]" readonly
                                                   value="{{ $data->price }}">

                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                    ?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{ html()->form()->close() }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
