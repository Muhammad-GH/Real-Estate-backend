<!-- @extends('backend.layouts.app') -->

@section('title', app_name() . ' | ' . 'Renovation Calculator')

@section('breadcrumb-links')
    @include('backend.setting.includes.breadcrumb-calculator-link')
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row" style="border-bottom: 1px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-5">
                    <h3 class="card-title mb-0">
                        Renovation Calculator
                    </h3>
                </div>
                <!--col-->
                <div class="col-sm-7">
                </div>
                <!--col-->
            </div>
            <!--row-->
        </div>
        <div class="card-body">
            <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-5">
                    <h5>Work Rates</h5>
                </div>
                <!--col-->
                <div class="col-sm-7">

                    <button class="btn btn-primary float-right" id="edit-workrates" attr-type="edit">
                        Edit
                    </button>
                    <button class="btn btn-danger float-right cancel-edit" attr-class="workrates"
                            attr-id="edit-workrates" style="margin-right:5px;display: none;">
                        Cancel
                    </button>
                    <button class="btn btn-success float-right" id="delete-workrates" attr-type="delete" style="display: none; margin-right:20px; ">
                        Delete
                    </button>
                </div>
                <!--col-->
            </div>
            <!--row-->
            <div class="row mt-4 tabination">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <?php $i = 0; ?>
                        @foreach($rooms as $room)
                            <a class="nav-item nav-link <?php if ($i == 0) echo 'active'; ?>"
                               id="nav-work-{{$room->name}}-tab" data-toggle="tab"
                               href="#nav-work-{{$room->id}}" role="tab" aria-controls="nav-work-{{$room->name}}"
                               aria-selected="true">{{$room->name}}</a>
                            <?php $i++; ?>
                        @endforeach
                    </div>
                </nav>
                {{ html()->form('POST', route('admin.calculator.updatworkrates'))->class('form-horizontal')->id('workrates-form')->attribute('novalidate', true)->open() }}
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <?php $i = $q = 0; ?>
                    @foreach($rooms as $room)
                        <div class="tab-pane <?php if ($i == 0) echo 'fade show active'; ?>" id="nav-work-{{$room->id}}"
                             role="tabpanel" aria-labelledby="nav-work-{{$room->name}}-tab">
                            <div class="row small-input border border-secondary" style="padding: 10px;margin: 10px;">
                                <?php if(isset($work_data[$room->name])){?>
                                @foreach($work_data[$room->name]  as $data)
                                    <?php
                                    if ($data['area_allocation'] == '') {
                                        $data['area_allocation'] = 'no caculation on one time cost';
                                    }
                                    /*if($data['type'] == 1 && $q == 0){ echo'</div><div class="row small-input border border-secondary">'; $q++;}*/ ?>
                                    <?php
                                    if (is_array($data['parent_id']) && count($data['parent_id']) > 0) {
                                        echo '</div><div class="row small-input border border-secondary" style="padding: 10px;margin: 10px;">';
                                    }
                                    ?>
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <input type="checkbox" name="del-work[]" id="del-work-<?= $data['id']?>" class="del-work" value="<?= $data['id']?>">
                                                <label for="del-work-<?= $data['id']?>" style="margin-left: 10px;"><b>{{ $data['name'] }}</b></label>
                                            </div>
                                            <div class="clearfix"></div>
                                            @if($data['type'] == 0 )
                                                <div class="col-lg-5">
                                                    <label>One time cost</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control input-sm workrates"
                                                           name="workrates[{{$data['id'] }}][one_time_cost]"
                                                           value="{{$data['one_time_cost'] }}" readonly>
                                                </div>
                                            @else
                                                <div class="col-lg-5">
                                                    <label>Cost/hour</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input type="text"
                                                           class="form-control input-sm workrates workrates-cost-per-hour"
                                                           name="workrates[{{$data['id'] }}][cost_per_hour]"
                                                           value="{{$data['cost_per_hour'] }}" readonly>
                                                </div>
                                                <div class="col-lg-5">
                                                    <label>Time/m2 (Hours)</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input type="text"
                                                           class="form-control input-sm workrates workrates-time-per-m2"
                                                           name="workrates[{{$data['id']}}][time_per_m2]"
                                                           value="{{$data['time_per_m2'] }}" readonly>
                                                    <span></span>
                                                </div>

                                                <div class="col-lg-5">
                                                    <label>Cost/m2</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input type="text"
                                                           class="form-control input-sm workrates workrates-cost_per_m2"
                                                           name="workrates[{{$data['id'] }}][cost_per_m2]"
                                                           value="{{$data['cost_per_m2'] }}" readonly>
                                                </div>
                                                <div class="col-lg-5">
                                                    <label>Area allocation</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input type="text"
                                                           class="form-control input-sm workrates workrates-area"
                                                           name="workrates[{{$data['id'] }}][area_allocation]"
                                                           value="{{$data['area_allocation'] }}" readonly>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <?php
                                    if(is_array($data['parent_id']) && count($data['parent_id']) > 0){
                                    $c = 0; ?>
                                    @foreach($data['parent_id']  as $child)
                                        <div class="col-lg-4 child">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <input type="checkbox" name="del-work[]" id="del-work-<?= $data['id']?>" class="del-work" value="<?= $data['id']?>">
                                                    <label for="del-work-<?= $data['id']?>"  style="margin-left: 10px;"><b>{{ $child['name'] }}</b></label>
                                                </div>
                                                <div class="clearfix"></div>
                                                @if($child['type'] == 0 )
                                                    <div class="col-lg-5">
                                                        <label>One time cost</label>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm workrates"
                                                               name="workrates[{{$child['id'] }}][one_time_cost]"
                                                               value="{{$child['one_time_cost'] }}" readonly>
                                                    </div>
                                                @else
                                                    <div class="col-lg-5">
                                                        <label>Cost/hour</label>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <input type="text"
                                                               class="form-control input-sm workrates workrates-cost-per-hour"
                                                               name="workrates[{{$child['id'] }}][cost_per_hour]"
                                                               value="{{$child['cost_per_hour'] }}" readonly>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <label>Time/m2 (Hours)</label>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <input type="text"
                                                               class="form-control input-sm workrates workrates-time-per-m2"
                                                               name="workrates[{{$child['id']}}][time_per_m2]"
                                                               value="{{$child['time_per_m2'] }}" readonly>
                                                        <span></span>
                                                    </div>

                                                    <div class="col-lg-5">
                                                        <label>Cost/m2</label>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <input type="text"
                                                               class="form-control input-sm workrates workrates-cost_per_m2"
                                                               name="workrates[{{$child['id'] }}][cost_per_m2]"
                                                               value="{{$child['cost_per_m2'] }}" readonly>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <label>Area allocation</label>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <input type="text"
                                                               class="form-control input-sm workrates workrates-area"
                                                               name="workrates[{{$child['id'] }}][area_allocation]"
                                                               value="{{$child['area_allocation'] }}" readonly>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <?php
                                        $c++;
                                        if ($c == count($data['parent_id'])) {
                                            //echo'</div><div class="row small-input border border-secondary" style="padding: 10px;margin: 10px;">';
                                        }
                                        ?>
                                    @endforeach
                                    <?php
                                    } ?>
                                @endforeach
                                <?php
                                }else{
                                ?>
                                No item found!
                                <?php } ?>
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
        <!--card-body-->
        <!--card-body-->
    </div><!--card-->

    <div class="card">
        <div class="card-body">
            <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-5">
                    <h5>Material Prices</h5>
                </div>
                <!--col-->
                <div class="col-sm-7">

                    <button class="btn btn-primary float-right" id="edit-materials" attr-type="edit">
                        Edit
                    </button>
                    <button class="btn btn-danger float-right cancel-edit" attr-class="material"
                            attr-id="edit-materials" style="margin-right:5px;display: none;">
                        Cancel
                    </button>
                    <button class="btn btn-success float-right" id="delete-materials" attr-type="delete" style="display: none; margin-right:20px;">
                        Delete
                    </button>
                </div>
                <!--col-->
            </div>
            <!--row-->
            <div class="row mt-4 tabination">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <?php $i = 0; ?>
                        @foreach($rooms as $room)
                            <a class="nav-item nav-link <?php if ($i == 0) echo 'active'; ?>"
                               id="nav-metrial-{{$room->name}}-tab" data-toggle="tab"
                               href="#nav-metrial-{{$room->id}}" role="tab" aria-controls="nav-metrial-{{$room->name}}"
                               aria-selected="true">{{$room->name}}</a>
                            <?php $i++; ?>
                        @endforeach
                    </div>
                </nav>
                {{ html()->form('POST', route('admin.calculator.updatematerials'))->class('form-horizontal')->id('materials-form')->attribute('novalidate', true)->open() }}
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <?php $i = 0; ?>
                    @foreach($rooms as $room)
                        <div class="tab-pane <?php if ($i == 0) echo 'fade show active'; ?>"
                             id="nav-metrial-{{$room->id}}"
                             role="tabpanel" aria-labelledby="nav-nav-metrial-{{$room->name}}-tab">
                            <div class="row small-input border border-secondary" style="padding: 10px;margin: 10px;">
                                <?php if(isset($materials_data[$room->name])){
                                    foreach($materials_data[$room->name]  as $data){
                                        if($data['type'] != 0){
                                            continue;
                                        }
                                        if (is_array($data['parent_id']) && count($data['parent_id']) > 0) {
                                            echo '</div><div class="row small-input border border-secondary" style="padding: 10px;margin: 10px;">';
                                        }
                                        ?>
                                    <div class="col-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <input type="checkbox" name="del-met[]" id="del-met-<?= $data['id']?>" class="del-met" value="<?= $data['id']?>">
                                                <label for="del-met-<?= $data['id']?>"  style="margin-left: 10px;"><b>{{ $data['name'] }}</b></label>
                                            </div>
                                            <div class="col-lg-5">
                                                <label>Basic </label>
                                            </div>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm material"
                                                       name="material[{{$data['id'] }}][basic]"
                                                       value="{{$data['basic'] }}" readonly>
                                            </div>
                                            <div class="col-lg-5">
                                                <label>Exclusive</label>
                                            </div>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm material"
                                                       name="material[{{$data['id']}}][exclusive]"
                                                       value="{{$data['exclusive'] }}" readonly>
                                            </div>
                                            <?php if($data['area_allocation'] != '' && $data['area_allocation'] != 'no caculation on one time cost'){?>
                                            <div class="col-lg-5">
                                                <label>Area allocation</label>
                                            </div>
                                            <div class="col-lg-7">
                                                <input type="text"
                                                       class="form-control input-sm material material-area"
                                                       name="material[{{$data['id'] }}][area_allocation]"
                                                       value="{{$data['area_allocation'] }}" readonly>
                                            </div>
                                            <?php } ?>
                                            <div class="col-lg-5">
                                                <label>Cost Type</label>
                                            </div>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control input-sm " name=""
                                                       value="<?= $data['cost_type'] == 0 ? "One time cost" : "Per meter square"?>"
                                                       readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if(is_array($data['parent_id']) && count($data['parent_id']) > 0){
                                    $c = 0; ?>
                                    @foreach($data['parent_id']  as $child)
                                        <div class="col-lg-4 child">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <input type="checkbox" name="del-met[]" id="del-met-<?= $data['id']?>" class="del-met" value="<?= $data['id']?>">
                                                    <label for="del-met-<?= $data['id']?>"  style="margin-left: 10px;"><b>{{ $child['name'] }}</b></label>
                                                </div>
                                                <div class="clearfix"></div>

                                                <div class="col-lg-5">
                                                    <label>Basic</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control input-sm material"
                                                           name="material[{{$child['id'] }}][basic]"
                                                           value="{{$child['basic'] }}" readonly>
                                                </div>
                                                <div class="col-lg-5">
                                                    <label>Exclusive</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control input-sm material"
                                                           name="material[{{$child['id']}}][exclusive]"
                                                           value="{{$child['exclusive'] }}" readonly>
                                                </div>
                                                <?php if($child['area_allocation'] != '' && $child['area_allocation'] == 'no caculation on one time cost'){?>
                                                <div class="col-lg-5">
                                                    <label>Area allocation</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input type="text"
                                                           class="form-control input-sm material material-area"
                                                           name="material[{{$child['id'] }}][area_allocation]"
                                                           value="{{$child['area_allocation'] }}" readonly>
                                                </div>
                                                <?php } ?>
                                                <div class="col-lg-5">
                                                    <label>Cost Type</label>
                                                </div>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control input-sm " name=""
                                                           value="<?= $child['cost_type'] == 0 ? "One time cost" : "Per meter square"?>"
                                                           readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $c++;
                                        if ($c == count($data['parent_id'])) {
                                            //echo'</div><div class="row small-input border border-secondary" style="padding: 10px;margin: 10px;">';
                                        }
                                        ?>
                                    @endforeach
                                    <?php
                                    }
                                    }?>

                                <?php
                                }else{
                                ?>
                                No item found!
                                <?php } ?>
                            </div>
                            <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
                                <div class="col-sm-5">
                                    <h5>Other material prices (including assembly work)</h5>
                                </div>
                                <!--col-->
                                <!--col-->
                            </div>
                            <div class="tab-pane <?php if ($i == 0) echo 'fade show active'; ?>"
                                 id="nav-other-metrial-{{$room->name}}"
                                 role="tabpanel" aria-labelledby="nav-nav-metrial-{{$room->name}}-tab">
                                <div class="row small-input border border-secondary"
                                     style="padding: 10px;margin: 10px;">
                                    <?php if(isset($materials_data[$room->name])){
                                        foreach($materials_data[$room->name]  as $data){
                                            if($data['type'] != 1){
                                                continue;
                                            }
                                        if ($data['area_allocation'] == '') {
                                            $data['area_allocation'] = 'no caculation on one time cost';
                                        } ?>
                                        <?php
                                        if (is_array($data['parent_id']) && count($data['parent_id']) > 0) {
                                            echo '</div><div class="row small-input border border-secondary" style="padding: 10px;margin: 10px;">';
                                        }
                                        if($data['type'] == 1){
                                        ?>
                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="checkbox" name="del-met[]" id="del-met-<?= $data['id']?>" class="del-met" value="<?= $data['id']?>">
                                                        <label for="del-met-<?= $data['id']?>"  style="margin-left: 10px;"><b>{{ $data['name'] }}</b></label>
                                                    </div>
                                                    <div class="clearfix"></div>

                                                    <div class="col-lg-5">
                                                        <label>Basic</label>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm material"
                                                               name="material[{{$data['id'] }}][basic]"
                                                               value="{{$data['basic'] }}" readonly>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <label>Exclusive</label>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm material"
                                                               name="material[{{$data['id']}}][exclusive]"
                                                               value="{{$data['exclusive'] }}" readonly>
                                                    </div>

                                                    <div class="col-lg-5">
                                                        <label>Area allocation</label>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <input type="text"
                                                               class="form-control input-sm material material-area"
                                                               name="material[{{$data['id'] }}][area_allocation]"
                                                               value="{{$data['area_allocation'] }}" readonly>
                                                    </div>
                                                    <div class="col-lg-5">
                                                        <label>Cost Type</label>
                                                    </div>
                                                    <div class="col-lg-7">
                                                        <input type="text" class="form-control input-sm " name=""
                                                               value="<?= $data['cost_type'] == 0 ? "One time cost" : "Per meter square"?>"
                                                               readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            if(is_array($data['parent_id']) && count($data['parent_id']) > 0){
                                            $c = 0; ?>
                                            @foreach($data['parent_id']  as $child)
                                                <div class="col-lg-3 child">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <input type="checkbox" name="del-met[]" id="del-met-<?= $data['id']?>" class="del-met" value="<?= $data['id']?>">
                                                            <label for="del-met-<?= $data['id']?>"  style="margin-left: 10px;"><b>{{ $child['name'] }}</b></label>
                                                        </div>
                                                        <div class="clearfix"></div>

                                                        <div class="col-lg-5">
                                                            <label>Basic</label>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <input type="text" class="form-control input-sm material"
                                                                   name="other_materials[{{$child['id'] }}][basic]"
                                                                   value="{{$child['basic'] }}" readonly>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <label>Exclusive</label>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <input type="text" class="form-control input-sm material"
                                                                   name="other_materials[{{$child['id']}}][exclusive]"
                                                                   value="{{$child['exclusive'] }}" readonly>
                                                        </div>

                                                        <div class="col-lg-5">
                                                            <label>Area allocation</label>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <input type="text"
                                                                   class="form-control input-sm other-materials material-area"
                                                                   name="other_materials[{{$child['id'] }}][area_allocation]"
                                                                   value="{{$child['area_allocation'] }}" readonly>
                                                        </div>
                                                        <div class="col-lg-5">
                                                            <label>Cost Type</label>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <input type="text" class="form-control input-sm " name=""
                                                                   value="<?= $child['cost_type'] == 0 ? "One time cost" : "Per meter square"?>"
                                                                   readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $c++;
                                                if ($c == count($data['parent_id'])) {
                                                    //echo'</div><div class="row small-input border border-secondary" style="padding: 10px;margin: 10px;">';
                                                }
                                                ?>
                                            @endforeach

                                            <?php
                                            }
                                            }
                                            }?>

                                    <?php
                                    }else{
                                    ?>
                                    No item found!
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
        <!--card-body-->
        <!--card-body-->
        <!--card-body-->
    </div><!--card-->

    <div class="card">
        <div class="card-body">
            <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-5">
                    <h5>Import Work Prices</h5>
                </div>
                <!--col-->
                <div class="col-sm-7">
                    <a href="<?= url('/');?>/samples/sample-work-rates.csv" target='_blank'
                       class="btn btn-warning btn-sm float-right"><i
                                class="fa fa-download"></i> Sample File</a>
                </div>
                <!--col-->
            </div>
            <!--row-->
            <div class="row">
                <div class="col-12">
                    {{ html()->form('POST', route('admin.calculator.import-workrates'))->class('form-horizontal')->id('upload-workrate-form')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
                    <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;margin-top: 20px;">
                        <div class="col-lg-4">
                            <label><b>Select a Room</b></label>
                            <select class=" form-control" name="room">
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id}}">{{$room->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4">
                            <label><b>Select Csv File (upload only .csv file)</b> </label>
                            <input type="file" name="upload-workrates" id="upload-workrates" accept=".csv">
                            <span class="error-upload"></span>
                        </div>
                        <div class="col-lg-4">
                            <button style="margin-top: 30px;" type="submit" id="upload-workrates-btn" class="btn btn-success btn-sm"
                                    name="upload">Import
                            </button>
                        </div>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-5">
                    <h5>Export Work Prices</h5>
                </div>
                <!--col-->
                <div class="col-sm-7">
                </div>
                <!--col-->
            </div>
            <div class="row">
                <div class="col-12">
                    {{ html()->form('POST', route('admin.calculator.export-workrates'))->class('form-horizontal')->id('upload-materialrates-form')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
                    <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;margin-top: 20px;">
                        <div class="col-lg-6">
                            <label><b>Select a Room</b></label>
                            <select class=" form-control" name="room">
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id}}">{{$room->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <button style="margin-top: 30px;" type="submit" class="btn btn-success btn-sm"
                                    name="download">Export as CSV
                            </button>
                        </div>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-5">
                    <h5>Import Materials Prices</h5>
                </div>
                <!--col-->
                <div class="col-sm-7">
                    <a href="<?= url('/');?>/samples/sample-material-rates.csv" target='_blank'
                       class="btn btn-warning btn-sm float-right"><i
                                class="fa fa-download"></i> Sample File</a>
                </div>
                <!--col-->
            </div>
            <div class="row">
                <div class="col-12">
                    {{ html()->form('POST', route('admin.calculator.import-materialsrates'))->class('form-horizontal')->id('upload-materialrates-form')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
                    <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;margin-top: 20px;">
                        <div class="col-lg-4">
                            <label><b>Select a Room</b></label>
                            <select class=" form-control" name="room">
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id}}">{{$room->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4">
                            <label><b>Select Csv File (upload only .csv file)</b> </label>
                            <input type="file" name="upload-materials-rates" id="upload-materials-rates" accept=".csv">
                            <span class="error-upload-materials"></span>
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" style="margin-top: 30px;" id="upload-materialsrates-btn" class="btn btn-success btn-sm"
                                    name="upload">Import
                            </button>
                        </div>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;">
                <div class="col-sm-5">
                    <h5>Export Materials Prices</h5>
                </div>
                <!--col-->
                <div class="col-sm-7">
                </div>
                <!--col-->
            </div>
            <div class="row">
                <div class="col-12">
                    {{ html()->form('POST', route('admin.calculator.export-materialsrates'))->class('form-horizontal')->id('upload-materialrates-form')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
                    <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;margin-top: 20px;">
                        <div class="col-lg-6">
                            <label><b>Select a Room</b></label>
                            <select class=" form-control" name="room">
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id}}">{{$room->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <button type="submit" style="margin-top: 30px;" class="btn btn-success btn-sm"
                                    name="download">Export as CSV
                            </button>
                        </div>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    form.form-horizontal {
        width: 100%;
    }

    .tabination nav, .tabination .tab-pane {
        width: 100%;
    }

    .tabination nav > .nav.nav-tabs {
        border: none;
        color: #fff;
        background: #272e38;
        border-radius: 0;

    }

    .tabination nav > div a.nav-item.nav-link {
        border: none;
        padding: 18px 25px;
        color: #fff;
        background: #272e38;
        border-radius: 0;
    }

    .tabination nav > div a.nav-item.nav-link.active {
        background: #e74c3c;
    }

    .tabination nav > div a.nav-item.nav-link.active:after {
        content: "";
        position: relative;
        bottom: -55px;
        left: -25%;
        border: 15px solid transparent;
        border-top-color: #e74c3c;
    }

    .tabination .tab-content {
        background: #fdfdfd;
        width: 100%;
        line-height: 25px;
        border: 1px solid #ddd;
        border-top: 5px solid #e74c3c;
        border-bottom: 5px solid #e74c3c;
    }

    .tabination nav > div a.nav-item.nav-link:hover,
    .tabination nav > div a.nav-item.nav-link:focus {
        border: none;
        background: #e74c3c;
        color: #fff;
        border-radius: 0;
        transition: background 0.20s linear;
    }
</style>