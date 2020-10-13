<!-- @extends('backend.layouts.app') -->

@section('title', app_name() . ' | ' . 'Calculator Management')

@section('breadcrumb-links')
    @include('backend.setting.includes.breadcrumb-calculator-link')
@endsection

@section('content')
<div class="card-body">
    <div class="row">
        <div class="col-12">
{{ html()->form('POST', route('admin.calculator.import-workrates'))->class('form-horizontal')->id('upload-workrate-form')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
<div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;margin-top: 20px;">
    <h4 class="col-lg-3">Import Work Prices</h4>
    <label class="col-lg-3">Select Csv File (upload only .csv file) </label>
    <div class="col-lg-2">
        <input type="file" name="upload-workrates" id="upload-workrates" accept=".csv">
        <span class="error-upload"></span>
    </div>
    <div class="col-lg-2">
        <button type="submit" id="upload-workrates-btn" class="btn btn-success btn-sm" name="upload">Import</button>
    </div>
    <div class="col-lg-2">
        <a href="<?= url('/');?>/samples/sample-work-rates.csv" target='_blank' class="btn btn-warning btn-sm"><i
                    class="fa fa-download"></i> Sample File</a>
    </div>
</div>
{{ html()->form()->close() }}
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-12">
            {{ html()->form('POST', route('admin.calculator.import-materialsrates'))->class('form-horizontal')->id('upload-materialrates-form')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
            <div class="row" style="border-bottom: 2px solid #eee;padding-bottom: 10px;margin-top: 20px;">
                <h4 class="col-lg-3">Import Materials Prices</h4>
                <label class="col-lg-3">Select Csv File (upload only .csv file) </label>
                <div class="col-lg-2">
                    <input type="file" name="upload-materials-rates" id="upload-materials-rates" accept=".csv">
                    <span class="error-upload-materials"></span>
                </div>
                <div class="col-lg-2">
                    <button type="submit" id="upload-materialsrates-btn" class="btn btn-success btn-sm" name="upload">Import</button>
                </div>
                <div class="col-lg-2">
                    <a href="<?= url('/');?>/samples/sample-material-rates.csv" target='_blank' class="btn btn-warning btn-sm"><i
                                class="fa fa-download"></i> Sample File</a>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </div>
</div>
    @endsection