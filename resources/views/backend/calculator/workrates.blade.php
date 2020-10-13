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

                    </h3>
                </div><!--col-->
                <div class="col-sm-7">
                </div><!--col-->
            </div><!--row-->
        </div>
        <div class="card-body">
            <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-5">
                    <h5>Work Rates</h5>
                </div><!--col-->
                <div class="col-sm-7">
                    <button class="btn btn-primary float-right" id="edit-workrates" attr-type="edit">
                        Edit
                    </button>
                    <button class="btn btn-danger float-right cancel-edit" attr-class="workrates" attr-id="edit-workrates" style="margin-right:5px;display: none;">
                        Cancel
                    </button>
                </div><!--col-->
            </div><!--row-->
            <div class="row mt-4">
                <div class="col">
                    {{ html()->form('POST', route('admin.calculator.updatworkrates'))->class('form-horizontal')->id('workrates-form')->attribute('novalidate', true)->open() }}
                    {{--@include('backend.calculator.create-appartment')--}}
                    <div class="row small-input">
                        @foreach($workrates  as $data)
                            <div class="col-lg-3">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label><b>{{ $data->name }}</b></label>
                                    </div>
                                    <div class="col-lg-8"></div>
                                    @if($data->type == 0 )
                                    <div class="col-lg-4">
                                        <label>One time cost</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm workrates"
                                               name="workrates[{{$data->id }}][one_time_cost]"
                                               value="{{$data->one_time_cost }}" readonly>
                                    </div>
                                    @else
                                        <div class="col-lg-4">
                                            <label>Cost/hour</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control input-sm workrates"
                                                   name="workrates[{{$data->id }}][cost_per_hour]"
                                                   value="{{$data->cost_per_hour }}" readonly>
                                        </div>
                                    <div class="col-lg-4">
                                        <label>Time/m2</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm workrates"
                                               name="workrates[{{$data->id }}][time_per_m2]"
                                               value="{{$data->time_per_m2 }}" readonly>
                                    </div>

                                    <div class="col-lg-4">
                                        <label>Cost/m2</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm workrates"
                                               name="workrates[{{$data->id }}][cost_per_m2]"
                                               value="{{$data->cost_per_m2 }}" readonly>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Area allocation</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control input-sm workrates"
                                               name="workrates[{{$data->id }}][area_allocation]"
                                               value="{{$data->area_allocation }}" readonly>
                                    </div>
                                        @endif
                                </div>
                            </div>
                        @endforeach
                    </div><!--col-->
                    {{ html()->form()->close() }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <!--card-body-->
    </div><!--card-->
@endsection
