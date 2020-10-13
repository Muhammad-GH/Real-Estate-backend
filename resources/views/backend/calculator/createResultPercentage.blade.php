<!-- @extends('backend.layouts.app') -->



@section('title', app_name() . ' | ' . 'Renovation Calculator')



@section('breadcrumb-links')

    @include('backend.setting.includes.breadcrumb-calculator-link')

@endsection

@section('content')
<style>
    input.form-control.cust-result-btn.btn.btn-primary {
    margin-top: 28px;
}
</style>
<div class="card">
    <div class="card-body">
        {{ html()->form('POST', route('admin.calculator.create-result-percentage'))->class('form-horizontal')->id('create-area-form')->attribute('novalidate', true)->open() }}
        <div class="row">
            <div class="col-md-9">
                <h2>Add Result Percentage</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>Select Room</label>
                <select class="form-control" name="room">
                    <option value="">Select room </option>
                    @foreach($roomsdata as $room)
                    <option value="{{$room->id}}" >{{$room->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Min(%)</label>
                <input type="text" class="form-control" name="min"  required>
            </div>
            <div class="col-md-3">
                <label>Max(%)</label>
                <input type="text" class="form-control" name="max"  required>
            </div>
            <div class="col-md-2">
                <input type="submit" class="form-control cust-result-btn btn btn-primary" name="save" value="Save">
            </div>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>
@endsection