@extends('frontend.layouts.calculator')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<?php
    $langtextarr = Session::get('langtext');
?>
    <style>

        .contact-detail {
            margin-top: 40px;
        }

        div#oth_mat {
            padding-left: 20px;
            padding-top: 10px;
        }

        div.materiallist input[type="checkbox"] {
            margin-right: 15px;
        }

        div.bothlist input[type="checkbox"] {
            margin-right: 15px;
        }

        .calc .my-select .form-control {
            border-radius: 2px;
            height: 120px;
            font-weight: normal;
            border: #dedfe1 1px solid;
            font-size: 18px;
            box-shadow: none;
            padding-left: 20px;
            background: #eaeef7;
            color: gray;
            font-size: 15px;
            padding: 7px;
        }

        .my-textselect {
            margin: 12px 0px 8px 0px;
            font-size: 25px;
            font-weight: bold;
        }

        .my-input .calcinput {
            display: block;
            margin-left: 0;
            position: relative;
            margin-bottom: 26px;
        }

        .reno-calculator-steps .btn-group label.active {
            background: #002c5d;
        }

        .reno-calculator-steps .btn-group label {
            padding: 45px 0;
            color: #002c5d;
            border: #d8dfe5 1px solid;
            box-shadow: none;
            width: 250px;
            font-size: 20px;
            font-weight: 500;
            margin-right: 35px;
        }

        section.calc h4 {
            margin-bottom: 90px;
            font-size: 36px;
        }

        section.btndevice .btn-primary:hover {
            background: #002c5d;
        }

        section.btndevice {
            padding: 40px 0px 60px;
            background: #f5f5f5;
        }

        section.btndevice .btn-primary {
            background: #ffffff;
            color: #20303f;
            font-size: 20px;
            font-weight: 600;
        }

        section.btndevice .btn-secondary {
            font-size: 20px;
            font-weight: 600;
        }

        section.btndevice .btn-primary:hover {
            background: #20303f;
        }

        .calculatorbox {
            box-shadow: none;
            padding: 0px;
            margin: 0px auto;
            min-height: 52vh;
            display: block;
        }

        .size-data {
            float: right;
            text-align: right;
        }

        .size-data a {
            color: #20303f;
            font-weight: 600;
            padding-top: 20px;
            display: block;
        }

        .row.full-revo div {
            padding: 1px 10px;
        }

        .row.full-revo button.btn.dropdown-toggle.btn-default {
            padding: 0;
        }

        .row.full-revo .dropdown.bootstrap-select {
            width: 100% !important;
        }

        .row.full-revo label.contain {
            margin: 0;
        }

        .row-hover {
            padding: 5px 0;
            float: left;
            width: 100%;
            line-height: initial;
        }

        .row-hover:hover {
            box-shadow: 0px 0 8px #d9d9d9;
        }

        .mi-wd {
            width: 100%;
            max-width: 1150px;
        }

        .calcbox {
            padding-right: 15px;
            margin-bottom: 50px;
        }

        .vlu span {
            color: #20303f;
            font-weight: 600;
        }

        .vlu b {
            color: #20303f;
            font-weight: 600;
        }

        .vlu sup {
            color: #20303f;
            font-weight: 600;
        }

        section.calc .s3-hdng h4 {
            font-size: 24px;
        }

        section.calc .s4-hdng h4 {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .calc label {
            display: inline-block;
            width: 100%;
        }

        .otr-mt .form-group {
            padding: 0;
        }

        .otr-mt div#oth_mat {
            padding-left: 0;
        }

        .calc .my-select .form-control {
            background: transparent;
            max-width: 260px;
        }

        .calc .my-select .form-control option {
            padding: 5px;
        }

        div.worklist label input {
            margin-right: 15px;
        }

        .text-left h5 {
            font-size: 18px;
            font-weight: 600;
        }

        .s4-hdng .contact-detail {
            margin-top: 0px;
        }

        .calc .form-control {
            margin-bottom: 20px;
        }

        .form-control {
            color: #012b5d;
        }

        .ct-form-pd {
            padding: 0 30px;
        }

        .calc .s4-hdng textarea {
            height: 130px;
        }

        .calc label {
            color: #262628;
        }

        .ct-hd-pd {
            padding: 10px 15px 0;
        }

        .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 330px;
        }

        section.btndevice .sl-pk .btn {
            background: #fff;
            color: #757575;
            border: none;
            font-weight: lighter;
            padding: 15px 15px;
            box-shadow: none;
            border: #d3d3d3 1px solid;
            background: #f5f9fc;
        }

        .dropdown-menu {
            box-shadow: none;
        }

        .calc label {
            color: #000;
            font-weight: initial;
        }

        .contain {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .contain input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmarks {
            position: absolute;
            top: 0;
            left: 0;
            height: 17px;
            width: 17px;
            background-color: #fff;
            border: 2px solid #d8d8d8;
        }

        .contain:hover input ~ .checkmarks {
            background-color: #ccc;
        }

        .contain input:checked ~ .checkmarks {
            background-color: #fff;
        }

        .checkmarks:after {
            content: "";
            position: absolute;
            display: none;
        }

        .contain input:checked ~ .checkmarks:after {
            display: block;
        }

        .contain .checkmarks::after {
            left: 4px;
            top: 1px;
            width: 5px;
            height: 10px;
            border: solid #141414;
            border-width: 0 2px 2px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        .dropdown .dropdown-toggle {
            background: #f5f9fc !important;
            height: 40px;
            border: #dee3e7 1px solid !important;
            width: 250px;
            box-shadow: none !important;
            margin-left: 20px;
        }

        .bs3.bootstrap-select .dropdown-toggle .filter-option {
            padding-top: 5px;
        }

        .full-revo .dropdown-menu.open {
            margin-left: 30px;
            padding: 10px 0;
            min-width: initial;
            width: 250px
        }

        .modal-dialog {
            max-width: 550px;
            margin-top: 170px;
        }

        .modal-body {
            padding: 30px;
        }

        .modal-body p {
            font-size: 13px;
            margin: 0;
        }

        .modal-content {
            -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
            border: none;
        }

        .modal-body img {
            margin: 50px auto 0;
            display: block;
        }

        button.close {
            padding: 0px 9px 5px;
            cursor: pointer;
            background: #000;
            border: 0;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            font-weight: 100;
            font-size: 26px;
            opacity: 1;
            color: #fff;
        }

        .close:focus, .close:hover {
            color: #fff;
            opacity: 1;
        }
        .apart.ui-slider.ui-corner-all.ui-slider-horizontal.ui-widget.ui-widget-content {
            cursor: pointer;
        }
        .calc .form-control {
            font-size: 16px;
        }

        label {
            margin-bottom: 9px;
        }

        .modal-backdrop {
            background-color: transparent;
        }

        .bootstrap-select .dropdown-toggle .filter-option-inner-inner {
            font-weight: 400;
        }

        #errorModal button.cust-reno-link.btn.btn-primary {
            background: #20303f;
            color: #fff;
        }

        ul.nav.nav-tabs.md-tabs {
            border: navajowhite;
            width: 100%;
            padding: 0;
            border-bottom: 7px solid #002c5d;
        }

        li.nav-item:first-child {
            margin-left: 0;
        }

        li.nav-item {
            background: #fff;
            margin-bottom: 0px;
        }

        li.nav-item.active a.nav-link {
            background: #002c5d;
            color: #fff;
        }

        li.nav-item.active a.nav-link:after {
            content: "";
            position: relative;
            bottom: -60px;
            left: -40%;
            border: 15px solid transparent;
            border-top-color: #002c5d;
        }

        li.nav-item a.nav-link:hover, li.nav-item a.nav-link:focus {
            background: #20303f;
            text-decoration: none;
            color: #fff;
            border: 0;
        }

        li.nav-item a.nav-link:focus {
            background: #002c5d;
        }

        li.nav-item a.nav-link {
            border: none;
            padding: 18px 25px;
            color: #000;
            background: #eee;
            border-radius: 0;
            text-decoration: none;
        }

        .tab-pane {
            margin-top: 30px;
        }

        a.btn.show-info.float-left {
            padding: 10px 20px;
        }

        a.btn.show-info.float-left:hover, a.btn.show-info.float-left.focus {
            background-color: #002c5d;
            color: #fff;
        }
    </style>
    <p class="progress-p" style="width:20%"></p>
    <section class="calc whitebgc btndevice">
        <div class="container">
            <?php $roomname = '';?>
            @switch($rooms->name)
                @case($rooms->name == 'Sauna')
                    <?php $roomname = 'saunaremonttiisi'; ?>
                    @break

                @case($rooms->name == 'Kylpyhuone')
                    <?php $roomname = 'kylpyhuoneremonttiisi'; ?>
                    @break
                @case($rooms->name == 'Pintaremontti')
                    <?php $roomname = 'pintaremonttiisi'; ?>
                    @break
                @case($rooms->name == 'Keittiö')
                    <?php $roomname = 'keittiöremonttiisi'; ?>
                    @break

                @case($rooms->name == 'WC')
                    <?php $roomname = 'WC remonttiisi'; ?>
                    @break
                @case($rooms->name == 'Huoneistoremontti')
                    <?php $roomname = 'huoneistoremonttiisi'; ?>
                    @break
            @endswitch

            {{ html()->form('POST', route('frontend.calculated-renovation-cost', str_replace(' ','-',$roomname) ))->id('calculator-form')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
            <input type="hidden" name="portion_type" value="<?= $rooms->name ?>">

            <div class="calculatorbox" id="step-1">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                        @if($roomname == '')
                            <span>Something went wrong, please try again</span>
                        @endif
                        <h4>Mitä etsit {{ $roomname }}?</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="salemonthly reno-calculator-steps">
                            <div class="sale averageinput">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary check-work">
                                        <input type="radio" name="looking_for" id="option1" value="Työ"> Työ
                                    </label>
                                    <label class="btn btn-primary check-work active">
                                        <input type="radio" name="looking_for" id="option2" value="materiaali" checked>
                                        materiaali
                                    </label>
                                    <label class="btn btn-primary check-work">
                                        <input type="radio" name="looking_for" id="option3" value="Työ ja materiaali"> Työ ja materiaali
                                    </label>
                                </div>
                                <p class="error error-area"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" class="r-rooms" name="rooms[]" value="<?= $rooms->id ?>">

            <div class="calculatorbox" style="display: none" id="step-2">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 text-left">
                        @switch($rooms->name)
                            @case($rooms->name == 'Sauna')
                                <h4 data-toggle="modal">Syötä saunasi mittatiedot</h4>
                                @break

                            @case($rooms->name == 'Kylpyhuone')
                                <h4 data-toggle="modal">Syötä kylpyhuoneesi mittatiedot</h4>
                                @break
                            @case($rooms->name == 'Pintaremontti')
                                <h4 data-toggle="modal">Syötä huoneidesi mittatiedot</h4>
                                @break
                            @case($rooms->name == 'Keittiö')
                                <h4 data-toggle="modal">Syötä Keittiösi mittatiedot ja muoto</h4>
                                @break

                            @case($rooms->name == 'WC')
                               <h4 data-toggle="modal">Syötä WC:si mittatiedot</h4>
                                @break
                            @case($rooms->name == 'Huoneistoremontti')
                                <h4 data-toggle="modal">Syötä {{ $roomname }} mittatiedot</h4>
                                @break

                            @default
                                <span></span>
                        @endswitch
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 size-data">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">katso kokotaulukko</a>
                    </div>
                </div>
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">

                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <p>seinä(m<sup>2</sup>) = Pituus * korkeus * 2 + leveys * korkeus * 2</p>

                                <p>Lattia(m<sup>2</sup>) = Pituus leveys</p>

                                <p>Katto(m<sup>2</sup>) = Pituus leveys</p>
                                <img src="{{asset('images/sizechart-custom.jpg')}}">
                            </div>

                        </div>

                    </div>
                </div>
                <div class="row  my-input">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label>Leveys</label>

                        <div class="calcbox">
                            <div class="calcinput">
                                <input type="number" name="portion_width[<?= $rooms->id ?>]" placeholder="Syötä leveys"
                                       min="0"
                                       class="input-row form-control" id="portion-width">
                                <span> Cm</span>
                            </div>
                            <p class="error-portion_width error"></p>

                            <div id="portion-width-val" class="apart"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label>Pituus</label>

                        <div class="calcbox">
                            <div class="calcinput">
                                <input type="number" name="portion_length[<?= $rooms->id ?>]" placeholder="Syötä pituus"
                                       min="0"
                                       class="input-row form-control" id="portion-length">
                                <span> Cm</span>
                            </div>
                            <p class="error-portion_length error"></p>

                            <div id="portion-length-val" class="apart"></div>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label>Korkeus</label>

                        <div class="calcbox">
                            <div class="calcinput">
                                <input type="number" name="portion_height[<?= $rooms->id ?>]" placeholder="Syötä korkeus"
                                       min="0"
                                       class="input-row form-control" id="portion-height">
                                <span> Cm</span>
                            </div>
                            <p class="error-portion_height error"></p>

                            <div id="portion-height-val" class="apart"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <p class="vlu">Lattia: <span id="floor-area">0</span> <b>m</b><sup>2</sup></p>
                        <input name="floor_area[<?= $rooms->id ?>]" id="floor-area-input" value="" type="hidden">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <p class="vlu">Seinäpinta-ala: <span id="wall-area">0</span> <b>m</b><sup>2</sup></p>
                        <input name="wall_area[<?= $rooms->id ?>]" id="wall-area-input" value="" type="hidden">
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <p class="vlu">Kattoalue: <span id="roof-area">0</span> <b>m</b><sup>2</sup></p>
                        <input name="roof_area[<?= $rooms->id ?>]" id="roof-area-input" value="" type="hidden">
                    </div>
                </div>
                <?php if($rooms->id == 2) { ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                        <h4>Valitse keittiömalli ja kaapin leveys</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Keittiömalli</label>

                        <div class="calcbox">
                            <div class="">
                                <select class="input-row form-control" name="kitchen_model" id="kitchen_model">
                                    <option value="">Valitse Keittiömalli</option>
                                    <option value="i">I</option>
                                    <option value="l">L</option>
                                    <option value="u">U</option>
                                    <option value="Saareke">Saareke</option>
                                </select>

                                <p class="error-kitchen_model error"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Kaapin leveys</label>

                        <div class="calcbox">
                            <div class="calcinput" style="margin-left: 0;">
                                <input type="number" name="cabinet_width" value="0" min="0"
                                       class="input-row form-control" id="cabinet_width">
                                <span> MM</span>
                            </div>
                            <p class="error-cabinet_width error"></p>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="calculatorbox" style="display: none" id="step-3">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="text-left s3-hdng">
                            <h4>Valitse palvelutaso</h4>
                        </div>
                        <div class="salemonthly reno-calculator-steps">
                            <div class="sale averageinput">
                                <div class="btn-group" data-toggle="buttons">
                                    <div class="">
                                        <a href="javascript:void(0)" class="btn show-info float-left"  attr-val="basic"><i class="fa fa-info"></i> </a>
                                        <label class="btn btn-primary  float-left">
                                            <input type="radio" name="budget" id="optionbasic1" value="Basic" style="display: none;"> Basic
                                        </label>
                                    </div>
                                    <div class="">
                                        <a href="javascript:void(0)" class="btn show-info float-left "  attr-val="exclusive"><i class="fa fa-info"></i> </a>
                                        <label class="btn btn-primary active float-left">
                                            <input type="radio" name="budget" id="optionexclusive2" value="Premium" checked style="display: none;"> Premium
                                        </label>
                                    </div>
                                </div>
                                <p class="error error-area"></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="display:none;" >
                        <div class="text-left s3-hdng">
                            <h4>Millaisen remontin haluat? </h4>
                        </div>
                        <div class="salemonthly reno-calculator-steps">
                            <div class="sale averageinput">
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary check-full active">
                                        <input type="radio" name="renovation_type" id="optionfull1" value="Täysremontti"
                                               checked> Täysremontti
                                    </label>
                                    <label class="btn btn-primary check-full ">
                                        <input type="radio" name="renovation_type" id="optionpartial2"
                                               value="Osaremontti"> Osaremontti
                                    </label> 
                                </div>
                                <p class="error error-area"></p>
                            </div>

                        </div>
                    </div>
                    
                </div>
                <div class="full-revo" style="width: 100%;">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left worklist">
                        <h5 class="selected_looking_for">Valitse työ</h5><br>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left materiallist">
                        <h5></h5><br>
                    </div>
                </div>
                <?php
                if(isset($both_array[$rooms->name]) && count($both_array[$rooms->name]) > 0){
                foreach($both_array[$rooms->name] as $both){ ?>
                <div class="row full-revo row-hover both-data">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left bothlist">
                        <div class="parent-item">
                            <label class="contain work-check-box" for="both_{{$both['id']}}">
                                <input class="both_input" type="checkbox" name="both[<?= $rooms->name ?>][]"
                                       id="both_{{$both['id']}}"
                                       value="{{$both['id']}}">{{$both['name']}}
                                <span class="checkmarks"></span>
                            </label>
                        </div>
                        <?php if(isset($bt_array[$rooms->name][$both['name']])){ ?>
                        <div class="child-item" style="display: none;">
                            <select class="selectpicker both_item_input" multiple
                                    name="both_item[<?= $rooms->name ?>][{{$both['id']}}][]">
                                <?php foreach($bt_array[$rooms->name][$both['name']] as $key => $child_both){ ?>
                                <option value="{{ $child_both['id'] }}">{{ $key }}</option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
                }
                } ?>
                <?php
                if(isset($metrial_array[$rooms->name]) && count($metrial_array[$rooms->name]) > 0){
                foreach($metrial_array[$rooms->name] as $metrial){ ?>
                <div class="row full-revo row-hover material-data">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left materiallist">
                        <div class="parent-item">
                            <label class="contain work-check-box" for="metr_{{$metrial['id']}}">
                                <input class="metrial_input" type="checkbox" name="metrial[<?= $rooms->name ?>][]"
                                       id="metr_{{$metrial['id']}}"
                                       value="{{$metrial['id']}}">{{$metrial['name']}}
                                <span class="checkmarks"></span>
                            </label>
                        </div>
                        <?php if(isset($mt_array[$rooms->name][$metrial['name']])){ ?>
                        <div class="child-item" style="display: none;">
                            <select class="selectpicker metrial_item_input" multiple
                                    name="metrial_item[<?= $rooms->name ?>][{{$metrial['id']}}][]">
                                <?php foreach($mt_array[$rooms->name][$metrial['name']] as $child_work){ ?>
                                <option value="{{ $child_work['id'] }}">{{ $child_work['name'] }}</option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
                }
                } ?>
                <?php if(isset($work_array[$rooms->name]) && count($work_array[$rooms->name]) > 0){
                foreach($work_array[$rooms->name] as $work){ ?>
                <div class="row  full-revo row-hover work-data">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left worklist">
                        <div class="parent-item">
                            <label class="contain work-check-box" for="work_{{$work['id']}}">
                                <input class="work_input" type="checkbox" name="work[<?= $rooms->name ?>][]"
                                       id="work_{{$work['id']}}"
                                       value="{{$work['id']}}">{{$work['name']}}
                                <span class="checkmarks"></span>
                            </label>
                        </div>
                        <?php if(isset($wr_array[$rooms->name][$work['name']])){ ?>
                        <div class="child-item" style="display: none;">
                            <select class="selectpicker work_item_input" multiple
                                    name="work_item[<?= $rooms->name ?>][{{$work['id']}}][]">
                                <?php foreach($wr_array[$rooms->name][$work['name']] as $child_work){ ?>
                                <option value="{{ $child_work['id'] }}">{{ $child_work['name'] }}</option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
                }
                }?>
                <?php
                if(isset($other_mt_array[$rooms->name]) && count($other_mt_array[$rooms->name]) > 0){ ?>
                <div class="row full-revo row-hover  other-metrial">
                    <div class="otr-mt">
                        <div class="my-textselect">
                            <label class="contain others-metrial" for="others-metrial">
                                <input type="checkbox" name="others-metrial[<?= $rooms->name ?>]" id="others-metrial"
                                       value="others-metrial">Muut materiaalit (mukaan lukien kokoonpanotyöt)
                                <span class="checkmarks"></span>
                            </label>
                        </div>
                        <div id="oth_mat" style="display: none;">
                            <div class="my-select">
                                <select class="selectpicker" multiple name="other_materials[<?= $rooms->name ?>][]">
                                    @foreach($other_mt_array[$rooms->name] as $othermat)
                                        <option value="{{ $othermat['id'] }}">{{ $othermat['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="calculatorbox" style="display: none" id="step-4">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left s4-hdng ct-form-pd">
                        <h4>Missä asunto sijaitsee?</h4>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label>Valitse kaupunki</label>
                                        <select class="input-row form-control" name="city" required>
                                            <option value="">Valitse kaupunki</option>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->id }}">{{$city->name}}</option>
                                            @endforeach
                                        </select>

                                        <p class="error-city error"></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label>Postinumero</label>
                                        <input type="number" class="input-row form-control" name="postal_code" maxlength="6">

                                        <p class="error-code error"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label>Asunnon tyyppi</label>

                                        <select class="input-row form-control" name="appartment_type" required>
                                            <option value="">Valitse yksi</option>
                                            <option value="kerrostalo">Kerrostalo</option>
                                            <option value="Omakotitalo">Omakotitalo</option>
                                            <option value="Rivitalo">Rivitalo</option>
                                            <option value="Paritalo">Paritalo</option>
                                            <option value="Muu">Muu</option>
                                        </select>

                                        <p class="error-appartment-type error"></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label>Kerros</label>
                                        <input type="text" class="input-row form-control" name="floor" maxlength="10">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left s4-hdng ct-form-pd">
                        <h4>Täytätkö yhteystietosi? </h4>

                        <div class="row contact-detail">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label>Etunimi</label>
                                        <input type="text" class="input-row form-control" name="name" maxlength="50">

                                        <p class="error-name error"></p>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <label>Sukunimi</label>
                                        <input type="text" class="input-row form-control" name="last_name" maxlength="50">

                                        <p class="error-last-name error"></p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                                <label>Puhelin</label>
                                <input type="number" class="input-row form-control" name="phone" minlength="10" maxlength="10">

                                <p class="error-phone error"></p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <label>Sähköposti</label>
                                <input type="email" class="input-row form-control" name="email" maxlength="100">

                                <p class="error-email error"></p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left s4-hdng">
                        <div class="ct-hd-pd">
                            <h4>Haluatko lisätä lisätietoja?</h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ct-form-pd">
                                <label>Viesti</label>
                                <textarea class="input-row form-control" name="message"></textarea>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ct-form-pd">
                                <label>Liite</label>
                                <div class="form-group">
                                <div class="file-select">
                                    <input type="file" name="appartment_photo" id="attachment">
                                    <label for="attachment">
                                        <i class="icon-attachment"></i>
                                        <span class="filename">Ei valittua tiedostoa</span>
                                        <span class="clear">+</span>
                                    </label>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-md-12">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label class="light" for="termsR">
                                    <input type="checkbox" class="custom-check" id="termsR" name="termsR" required=""><span class="checkmark"></span>{{ translateText($langtextarr, 'Olen lukenut Flipkodin') }}  <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link"> {{ translateText($langtextarr, 'tietosuojaselosteen') }}</a> {{ translateText($langtextarr, 'ja') }} <a href="{{ route('frontend.terms') }}" class="custom-link"> {{ translateText($langtextarr, 'käyttöehdot') }}</a>
                                </label>
                            </div>
                            <label class="error error-termsR"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="btndevice btn-ftr">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-sm-12">
                    <a href="javascript:void(0)" attr-show="step-1" attr-current="step-1" class="btn btn-primary back"
                       style="cursor: not-allowed;">< Takaisin</a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-sm-12">
                    <a href="javascript:void(0)" attr-show="step-2" attr-current="step-1"
                       class="btn btn-secondary reno-calculator-next next">Seuraava ></a>
                    <button class="btn btn-secondary pull-right" id="submit-btn" type="submit" style="display: none;">
                        LASKE HINTA
                    </button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="errorModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>Haluatko varmasti jatkaa <span id="cust-portion-type"></span>.</p>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="cust-reno-link btn btn-primary" data-dismiss="modal">kunnossa</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{ html()->form()->close() }}
    <div id="info-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div id="info-content">

                    </div>
                    <div id="info-image">
                        <img src="{{asset('images/sizechart-custom.jpg')}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
    if(isset($image_data[$rooms->id]['data']['work_basic'])){
         
         $bw = trim(preg_replace('/\s+/', ' ', $image_data[$rooms->id]['data']['work_basic']));
     }else if(isset($image_data[$rooms->id]['image']['work_basic'])){
         
        $bw = "<img src=".asset('images/'.$image_data[$rooms->id]['image']['work_basic'])." />";
     }


    if(isset($image_data[$rooms->id]['data']['work_exclusive'])){
        
        $ew = trim(preg_replace('/\s+/', ' ', $image_data[$rooms->id]['data']['work_exclusive']));
    }else if(isset($image_data[$rooms->id]['image']['work_exclusive'])){
        
        $ew = "<img src=".asset('images/'.$image_data[$rooms->id]['image']['work_exclusive'])." />";
    } 


    if(isset($image_data[$rooms->id]['data']['met_basic'])){
        
        $bw_img = trim(preg_replace('/\s+/', ' ', $image_data[$rooms->id]['data']['met_basic']));
    }else if(isset($image_data[$rooms->id]['image']['met_basic'])){
        
        $bw_img = "<img src=".asset('images/'.$image_data[$rooms->id]['image']['met_basic'])." />";
    } 

    if(isset($image_data[$rooms->id]['data']['met_exclusive'])){
        
        $ew_img = trim(preg_replace('/\s+/', ' ', $image_data[$rooms->id]['data']['met_exclusive']));
    }else if(isset($image_data[$rooms->id]['image']['met_exclusive'])){
        
        $ew_img = "<img src=".asset('images/'.$image_data[$rooms->id]['image']['met_exclusive'])." />";
    } 

     
 

   //print_r($image_data);die('kkk');
    @endphp
@endsection
@push('after-scripts')
    {!! script('js/jquery.ui.touch-punch.min.js') !!}

<script>
    $(document).ready(function () {
        $(document).on("click",".show-info",function () {
            var type_val = $('input[name="looking_for"]:checked').val();
            var click_val = $(this).attr('attr-val');
            var bw = '<?= $bw?>';
            //var bw_img = '<img src="asset('images/'.$image_data[$rooms->id]['met_basic']) " />';
            var bw_img = '<?= $bw_img ?>';
            var ew =  '<?= $ew?>';
            //var ew_img = '<img src=" asset('images/'.$image_data[$rooms->id]['met_exclusive']) " />';
            var ew_img = '<?= $ew_img ?>';
            if(click_val == 'basic'){
                if (type_val == 'Työ') {
                    $("#info-content").html("<p>"+bw+"</p>");
                    $("#info-image").html('');
                }else
                if (type_val == 'materiaali') {
                    $("#info-content").html("");
                    $("#info-image").html(bw_img);
                }else
                if (type_val == 'Työ ja materiaali') {
                    $("#info-content").html(bw);
                    $("#info-image").html(bw_img);
                }
                $("#info-modal").modal('show');
            }else if(click_val == 'exclusive'){
                if (type_val == 'Työ') {
                    $("#info-content").html("<p>"+ew+"</p>");
                    $("#info-image").html('');
                }else
                if (type_val == 'materiaali') {
                    $("#info-content").html("");
                    $("#info-image").html(ew_img);
                }else
                if (type_val == 'Työ ja materiaali') {
                    $("#info-content").html(ew);
                    $("#info-image").html(ew_img);
                }
                $("#info-modal").modal('show');
            }
        });
        $('#potentialform').validate({ // initialize the plugin
            rules: {
                name: {required: true},
                email: {required: true, email: true},
                phone: { required: true,   minlength: 10, maxlength: 15 /*laxphone:true*/},
                link_sale: {required: true, url: true},
                attach_sale: {required: true}
            },
            messages: {
                name: {required: 'Pakollinen tieto'},
                email: { required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite' },
                phone: { required: 'Pakollinen tieto',number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
                link_sale: {required: 'Pakollinen tieto'},
                attach_sale: {required: 'Pakollinen tieto'}
            }
        });

        $("#brokerage").change(function () {
            $("#broker").slider("value", this.value);
        });
        function calculateArea() {
            var length = $("#portion-length").val();
            var width = $("#portion-width").val();
            var height = $("#portion-height").val();
            if (length != '' || length > 0 && width != '' || width > 0) {
                var floorarea = ($("#portion-length").val() * $("#portion-width").val()) / 10000;
                $('#floor-area').html(floorarea);
                $('#floor-area-input').val(floorarea);
                $('#roof-area').html(floorarea);
                $('#roof-area-input').val(floorarea);
            }
            if (length != '' || length > 0 && width != '' || width > 0 && height != '' || height > 0) {
                var wallArea = ((length * height * 2) + (width * height * 2)) / 10000;
                $('#wall-area').html(wallArea);
                $('#wall-area-input').val(wallArea);
            }
        }

        $("#portion-width-val").slider({
            range: "min",
            min: 0,
            max: 1000,
            value: 0,
            slide: function (event, ui) {
                $("#portion-width").val(ui.value);
                calculateArea();
                if (ui.value != '' && ui.value > 0) {
                    $(".error-portion_width").html('');
                }
            }
        });
        $("#portion-width").change(function () {
            $("#portion-width-val").slider("value", this.value);
            calculateArea();
            var p_width = $(this).val();
            if (p_width != '' && p_width > 0) {
                $(".error-portion_width").html('');
            } else {
                $(".error-portion_width").html('Syötä leveys');
            }
        });
        $(document).on("input", "#portion-width", function () {
            $("#portion-width-val").slider("value", this.value);
            calculateArea();
            var p_width = $(this).val();
            if (p_width != '' && p_width > 0) {
                $(".error-portion_width").html('');
            }
        });
        $("#portion-length-val").slider({
            range: "min",
            min: 0,
            max: 1000,
            value: 0,
            slide: function (event, ui) {
                $("#portion-length").val(ui.value);
                calculateArea();
                if (ui.value != '' && ui.value > 0) {
                    $(".error-portion_length").html('');
                }
            }
        });
        $(document).on("change", "#portion-length", function () {
            $("#portion-length-val").slider("value", this.value);
            calculateArea();
            var p_length = $(this).val();
            if (p_length != '' && p_length > 0) {
                $(".error-portion_length").html('');
            } else {
                $(".error-portion_length").html('Syötä pituus');
            }
        });
        $(document).on('input', '#portion-length', function () {
            $("#portion-length-val").slider("value", this.value);
            calculateArea();
            var p_length = $(this).val();
            if (p_length != '' && p_length > 0) {
                $(".error-portion_length").html('');
            }
        });
        $("#portion-height-val").slider({
            range: "min",
            min: 0,
            max: 1000,
            value: 0,
            slide: function (event, ui) {
                $("#portion-height").val(ui.value);
                calculateArea();
                if (ui.value != '' && ui.value > 0) {
                    $(".error-portion_height").html('');
                }
            }
        });
        $(document).on("change", "#portion-height", function () {
            $("#portion-height-val").slider("value", this.value);
            calculateArea();
            var p_height = $(this).val();
            if (p_height != '' && p_height > 0) {
                $(".error-portion_height").html('');
            } else {
                $(".error-portion_height").html('Syötä korkeus');
            }
        });
        $(document).on("input", "#portion-height", function () {
            $("#portion-height-val").slider("value", this.value);
            calculateArea();
            var p_height = $(this).val();
            if (p_height != '' && p_height > 0) {
                $(".error-portion_height").html('');
            }
        });
        $(document).on('change', '#kitchen_model,#cabinet_width', function () {
            var kitchen_model = $("#kitchen_model").val();
            $(".error-kitchen_model").html('');
            $(".error-cabinet_width").html('');
            if (kitchen_model == '' || kitchen_model <= 0) {
                $(".error-kitchen_model").html("{{__('Valitse keittiön malli')}}");
            }
            var cabinet_width = $("#cabinet_width").val();
            if (cabinet_width == '' || cabinet_width <= 0) {
                $(".error-cabinet_width").html("{{__('Syötä kaapistojen kokonaisleveys')}}");
            }
        });
        $(document).on('input', '#cabinet_width', function () {
            $(".error-cabinet_width").html('');
            var cabinet_width = $("#cabinet_width").val();
            if (cabinet_width == '' || cabinet_width <= 0) {
                $(".error-cabinet_width").html("{{__('Syötä kaapistojen kokonaisleveys')}}");
            }
        });
        function validationStep2() {
            var p_width = $("#portion-width").val();
            var p_length = $("#portion-length").val();
            var p_height = $("#portion-height").val();
            var cabinet_width = $("#cabinet_width").val();
            var kitchen_model = $("#kitchen_model").val();
            var status = 1;
            $(".error-portion_width").html('');
            $(".error-portion_length").html('');
            $(".error-portion_height").html('');
            $(".error-kitchen_model").html('');
            $(".error-cabinet_width").html('');
            if (p_width == '' || p_width <= 0) {
                $(".error-portion_width").html("Syötä leveys");
                status = 0;
            }
            if (p_length == '' || p_length <= 0) {
                $(".error-portion_length").html("Syötä pituus");
                status = 0;
            }
            if (p_height == '' || p_height <= 0) {
                $(".error-portion_height").html("Syötä korkeus");
                status = 0;
            }
            if (kitchen_model == '') {
                $(".error-kitchen_model").html("{{__('Valitse keittiön malli')}}");
                status = 0;
            }
            if (cabinet_width == '' || cabinet_width <= 0) {
                $(".error-cabinet_width").html("{{__('Syötä kaapistojen kokonaisleveys')}}");
                status = 0;
            }
            return status;
        }
        function scrolldivtop(div_id){
            var width = $(window).width();
            if(width < 768){
                $('html, body').animate({
                    scrollTop: $(div_id).offset().top
                }, 100);
            }
        }
        $(document).on('click', '.back', function () {
            var next_show = $(this).attr('attr-show');
            var current_hide = $(this).attr('attr-current');
            $('.next').show();
            $('#submit-btn').hide();
            $('.progress-p').css('width', '33.0%');
            $(this).css('cursor', 'pointer');
            if (current_hide != 'step-1') {
                $("#" + next_show).fadeIn();
                $("#" + current_hide).hide();
                if (current_hide == 'step-2') {
                    $('.progress-p').css('width', '66.6%');
                    prev_div = 'step-1';
                    next_div = 'step-2';
                    current_div = 'step-1';
                    $(this).css('cursor', 'not-allowed');
                    scrolldivtop("div#step-1");
                }
                if (current_hide == 'step-3') {
                    $('.progress-p').css('width', '100%');
                    prev_div = 'step-1';
                    next_div = 'step-3';
                    current_div = 'step-2';
                    $('#submit-btn').hide();
                    $('.next').show();
                    scrolldivtop("div#step-2");
                }
                if (current_hide == 'step-4') {
                    $('.progress-p').css('width', '60%');
                    prev_div = 'step-2';
                    next_div = 'step-4';
                    current_div = 'step-3';
                    scrolldivtop("div#step-3");
                }
                $(this).attr('attr-show', prev_div);
                $(this).attr('attr-current', current_div);
                $('.next').attr('attr-show', next_div);
                $('.next').attr('attr-current', current_div);
            } else {
                $(this).css('cursor', 'not-allowed');
            }
        });
        $(document).on('click', '.next', function () {
            var next_show = $(this).attr('attr-show');
            var current_hide = $(this).attr('attr-current');
            $('.next').show();
            $('#submit-btn').hide();
            $('.back').css('cursor', 'pointer');
            if (current_hide != 'last') {
                if (current_hide == 'step-1') {
                    $('.progress-p').css('width', '40%');
                    prev_div = 'step-1';
                    next_div = 'step-3';
                    current_div = 'step-2';
                    scrolldivtop("div#step-1");
                }
                if (current_hide == 'step-2') {
                    if (validationStep2() == 0) {
                        return false;
                    }
                    $('.progress-p').css('width', '60%');
                    prev_div = 'step-2';
                    next_div = 'step-4';
                    current_div = 'step-3';
                    if ($('input[name="looking_for"]:checked').val() == 'Työ') {
                        $('.selected_looking_for').html("{{__('Valitse työ')}}");
                        $(".work-data").show();
                        $('.other-metrial').hide();
                        $(".material-data").hide();
                        $(".both-data").hide();
                    }
                    if ($('input[name="looking_for"]:checked').val() == 'materiaali') {
                        $('.selected_looking_for').html('{{__("Valitse materiaali")}}');
                        $(".work-data").hide();
                        $('.other-metrial').show();
                        $(".material-data").show();
                        $(".both-data").hide();

                    }
                    if ($('input[name="looking_for"]:checked').val() == 'Työ ja materiaali') {
                        $('.selected_looking_for').html('Valitse haluamasi työt ja materiaalit');
                        $(".work-data").hide();
                        $('.other-metrial').show();
                        $(".material-data").hide();
                        $(".both-data").show();
                    }
                    $('.full-revo').hide();
                    scrolldivtop("div#step-2");
                }
                if (current_hide == 'step-3') {
                    var error = 0;
                    if ($('input[name="looking_for"]:checked').val() == 'materiaali') {

                        // if ($('.metrial_input:checked').length == 0 && $('input[name="renovation_type"]:checked').val() != 'full') {
                        //     $('#errorModal .modal-body p').html("{{__('Please select atleast one material')}}");
                        //     $('#errorModal').modal('show');
                        //     return false;
                        // }
                        // else if ($('.metrial_input:checked').length > 0) {
                        if ($('.metrial_input:checked').length > 0) {
                            $('.metrial_input:checked').each(function (index, value) {
                                if ($('#' + this.id).parent().parent().parent().find('.child-item').find('.filter-option-inner-inner').html() == 'Nothing selected') {
                                    error++;
                                }
                            });
                            if (error > 0) {
                                $('#errorModal .modal-body p').html('{{__("Valitse valitulle materiaalille vähintään yksi alamateriaali")}}');
                                $('#errorModal').modal('show');
                                return false;
                            }

                        }
                    }
                    else {
                        if ($('input[name="looking_for"]:checked').val() == 'Työ ja materiaali') {
                            // if ($('.both_input:checked').length == 0 && $('input[name="renovation_type"]:checked').val() != 'full') {
                            //     $('#errorModal .modal-body p').html('{{__("Select the Work & Material")}}');
                            //     $('#errorModal').modal('show');
                            //     return false;
                            // }
                            // else if ($('.both_input:checked').length > 0) {
                            if ($('.both_input:checked').length > 0) {
                                $('.both_input:checked').each(function (index, value) {
                                    if ($('#' + this.id).parent().parent().parent().find('.child-item').find('.filter-option-inner-inner').html() == 'Nothing selected') {
                                        error++;
                                    }
                                });
                                if (error > 0) {
                                    $('#errorModal .modal-body p').html("{{__('Valitse vähintään yksi materiaali valitulle työlle')}}");
                                    $('#errorModal').modal('show');
                                    return false;
                                }

                            }

                        }
                        else {
                            var error = 0;
                            // if ($('.work_input:checked').length == 0 && $('input[name="renovation_type"]:checked').val() != 'full') {
                            //     $('#errorModal .modal-body p').html("{{__('Please select atleast one work phase')}}");
                            //     $('#errorModal').modal('show');
                            //     return false;
                            // }
                            // else if ($('.work_input:checked').length > 0) {
                            if ($('.work_input:checked').length > 0) {
                                $('.work_input:checked').each(function (index, value) {
                                    if ($('#' + this.id).parent().parent().parent().find('.child-item').find('.filter-option-inner-inner').html() == 'Nothing selected') {
                                        error++;
                                    }
                                });
                                if (error > 0) {
                                    $('#errorModal .modal-body p').html("{{__('Valitse vähintään yksi materiaali valitulle työlle')}}");
                                    $('#errorModal').modal('show');
                                    return false;
                                }

                            }

                        }

                    }
                    $('.progress-p').css('width', '80%');
                    prev_div = 'step-3';
                    next_div = 'step-5';
                    current_div = 'step-4';
                    $('#submit-btn').show();
                    $('.next').hide();
                    scrolldivtop("div#step-3");
                }
                if (current_hide == 'step-4') {
                    $('.progress-p').css('width', '1000%');
                    //$('#submit-btn').show();
                    //$('.next').hide();
                    $('#submit-btn').show();
                    $('.next').hide();
                    prev_div = 'step-3';
                    next_div = 'step-4';
                    current_div = 'step-3';
                }
                $("#" + next_show).fadeIn();
                $("#" + current_hide).hide();
                $(this).attr('attr-show', next_div);
                $(this).attr('attr-current', current_div);
                $('.back').attr('attr-show', prev_div);
                $('.back').attr('attr-current', current_div);
            } else {
                $('.progress-p').css('width', '20%');
            }
        });

        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }

        $(document).on("click", ".check-full", function () {
            var val = $(this).find('input').val();
            if (val == 'full') {
                $(".full-revo").hide();
            } else {
                $(".full-revo").show();
                var val = $(".check-work  input:checked").val();
                if (val == 'work') {
                    $(".work-data").show();
                    $('.other-metrial').hide();
                    $(".material-data").hide();
                    $(".both-data").hide();
                } else if (val == 'material') {
                    $(".work-data").hide();
                    $('.other-metrial').show();
                    $(".material-data").show();
                    $(".both-data").hide();
                } else {
                    $(".work-data").hide();
                    $('.other-metrial').show();
                    $(".material-data").hide();
                    $(".both-data").show();
                }
            }

        });
        $(document).on("click", ".work-check-box", function () {
            if ($(this).find('input').is(":checked")) {
                $(this).parent().parent().find('.child-item').show();
            } else {
                $(this).parent().parent().find('.child-item').hide();
            }
        });
        $(document).on("click", ".others-metrial", function () {
            if ($(this).find('input').is(":checked")) {
                $("#oth_mat").show();
            } else {
                $("#oth_mat").hide();
            }
        });
        $(document).on("click", ".check-work", function () {
            var val = $(this).find('input').val();
            if (val == 'work') {
                $(".work-data").show();
                $('.other-metrial').hide();
                $(".material-data").hide();
                $(".both-data").hide();
            } else if (val == 'material') {
                $(".work-data").hide();
                $('.other-metrial').show();
                $(".material-data").show();
                $(".both-data").hide();
            } else {
                $(".work-data").hide();
                $('.other-metrial').show();
                $(".material-data").hide();
                $(".both-data").show();
            }
        });
        function validateCal() {
            var email = $("#email").val();
            var status = true;
            var postal_code = $("#postal_code").val();
            var phone = $("#phone").val();
            var city = $("select[name='city']").val();
            $(".error-code").html('');
            $(".error-email").html('');
            $(".error-phone").html('');
            if (postal_code.trim() == '' || postal_code.length > 5) {
                $(".error-code").html('Syötä postinumero');
                status = false;
            }
            if (email.trim() == '' || IsEmail(email.trim()) == false) {
                $(".error-email").html("{{__('Anna oikea sähköpostiosoite!')}}");
                status = false;
            }
            if (phone.trim() == '' || phone.length < 9) {
                $(".error-phone").html("{{__('Anna kelvollinen puhelin!')}}");
                status = false;
            }
            if (city.trim() == '') {
                $(".error-city").html( "{{__('Valitse kaupunki')}}" );
                status = false;
            }
            return status;
        }

        $(document).on('click', '#submit-btn', function () {
            var email = $("input[name='email']").val();
            var name = $("input[name='name']").val();
            var postal_code = $("input[name='postal_code']").val();
            var phone = $("input[name='phone']").val();
            var city = $("select[name='city']").val();
            var appartment_type = $("select[name='appartment_type']").val();
            var termsR = $("input[name='termsR']");
            $(".error-code").html('');
            $(".error-email").html('');
            $(".error-phone").html('');
            $(".error-termsR").html('');
            
            if (city.trim() == '' || city == 'Select city') {
                $(".error-city").html( "{{__('Valitse kaupunki')}}" );
                $("select[name='city']").focus();
                return false;
            }
            if (postal_code.trim() == '' || postal_code.length > 6) {
                $(".error-code").html('Syötä postinumero');
                $(".error-city").html('');
                $("input[name='postal_code']").focus();
                return false;
            }
            if (appartment_type.trim() == '' || appartment_type.trim() == 'Select one') {
                $(".error-appartment-type").html("{{__('Valitse asunnon tyyppi!')}}");
                $(".error-code").html('');
                $("select[name='appartment_type']").focus();
                return false;
            }
            if (name.trim() == '') {
                $(".error-name").html('Syötä nimi');
                $(".error-appartment-type").html('');
                $("input[name='name']").focus();
                return false;
            }
            if (email.trim() == '' || IsEmail(email.trim()) == false) {
                $(".error-email").html("{{__('Anna oikea sähköpostiosoite!')}}");
                $(".error-name").html('');
                $("input[name='email']").focus();
                return false;
            }
            if (phone.trim() == '' || phone.length < 9) {
                $(".error-phone").html("{{__('Anna kelvollinen puhelin!')}}");
                $(".error-email").html('');
                $("input[name='phone']").focus();
                return false;
            }
            if (!termsR.is(':checked')) {
                $(".error-termsR").html( "{{__('Hyväksy ehdot ja ehdot')}}" );
                return false;
            }

            $(".error-phone").html('');
            $("#calculator-form").submit();
        });
        $(document).on('change', 'input[name="looking_for"]', function () {
            // $('input[name="renovation_type"]').eq(0).trigger('click');
            $('.check-full').removeClass('active');
            $('.check-full').eq(0).addClass('active');
        });
    });
</script>
@endpush