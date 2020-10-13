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
            <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-5">
                    <h5>Set Result Percentage</h5>
                </div>
                <!--col-->
                <div class="col-sm-7">
                    {{--<a href="{{route('admin.calculator.create-result-percentage')}}"
                       class="btn btn-success btn-sm float-right">
                        <i class="fa fa-plus"></i> Add
                    </a>--}}
                </div>
                <!--col-->
            </div>
            <!--row-->
            <div class="row" style="margin-top: 20px;">
                <div class="col-12">
                    @foreach($data as $percentage)
                        {{ html()->form('POST', route('admin.calculator.result-percentage'))->class('form-horizontal')->id('create-area-form')->attribute('novalidate', true)->open() }}
                        <div class="row">
                            <div class="col-md-4">
                                <label>Room</label>
                                <input type="hidden" name="room" value="<?= $percentage->room_id ?>">
                                <p class="form-control">
                                    @foreach($roomsdata as $room)
                                        <?php if ($room->id == $percentage->room_id) {
                                            echo $room->name;
                                        } ?>
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-md-3">
                                <label>Min(%)</label>
                                <input type="text" class="form-control" name="min" value="{{$percentage->min}}"
                                       required>
                            </div>
                            <div class="col-md-3">
                                <label>Max(%)</label>
                                <input type="text" class="form-control" name="max" value="{{$percentage->max}}"
                                       required>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" class="form-control cust-result-btn btn btn-primary" name="save"
                                       value="Update">
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection