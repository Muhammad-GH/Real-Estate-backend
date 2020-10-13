@extends('backend.layouts.app')

@section('title', 'Page Management' . ' | ' . 'Update Page')

@section('breadcrumb-links')
    <li class="breadcrumb-menu">
        <div class="btn-group" role="group" aria-label="Button group">
            <div class="dropdown">
                <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Jobs
                </a>

            </div><!--dropdown-->
        </div><!--btn-group-->
    </li>
    <li class="breadcrumb-menu">
        <div class="btn-group" role="group" aria-label="Button group">
            <div class="dropdown">
                <a class="dropdown-item" href="#">
                    Update Page
                </a>
            </div><!--dropdown-->
        </div><!--btn-group-->
    </li>

@endsection

@section('content')
    {{ html()->form('POST', route('admin.jobs.update',$id))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Update Page
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <hr>
            <div class="row mt-4 tabination">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <?php $i = 0; ?>
                        @foreach($languages as $language)
                            <a class="nav-item nav-link <?php if ($i == 0) echo 'active'; ?>"
                               id="nav-metrial-{{$language->name}}-tab" data-toggle="tab"
                               href="#nav-metrial-{{$language->lang_code}}" role="tab" aria-controls="nav-metrial-{{$language->name}}"
                               aria-selected="true">{{$language->name}}</a>
                            <?php $i++; ?>
                        @endforeach
                    </div>
                </nav>

                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <?php $i = 0; ?>
                    @foreach($languages as $language)
                        <?php
                            $ide = 'editor-'.$language->lang_code;
                            $shortdescription = $description =  $status =  $designation = $vacancy = $title = $location = $department = $imagen = '';
                            $start_date = $end_date = time();
                            if(isset($data[$language->lang_code])){
                                $title = $data[$language->lang_code]['title'];
                                $shortdescription = $data[$language->lang_code]['short_description'];
                                $description = $data[$language->lang_code]['description'];
                                $designation = $data[$language->lang_code]['designation'];
                                $vacancy = $data[$language->lang_code]['vacancy'];
                                $imagen = $data[$language->lang_code]['image'];
                                $status = $data[$language->lang_code]['status'];
                                $start_date = $data[$language->lang_code]['start_date'];
                                $end_date = $data[$language->lang_code]['end_date'];
                                $departmentId = $data[$language->lang_code]['departmentId'];
                                $location = $data[$language->lang_code]['location'];
                            }
                            ?>
                            <div class="tab-pane <?php if ($i == 0) echo 'active'; ?>"
                                 id="nav-metrial-{{$language->lang_code}}"
                                 role="tabpanel" aria-labelledby="nav-nav-metrial-{{$language->name}}-tab">
                                <div class="row mt-4 mb-4">
                                    <div class="col">
                                        <div class="form-group row">
                                            {{ html()->label('Job Title')->class('col-md-2 form-control-label')->for('title['.$language->lang_code.']') }}
                                            <div class="col-md-10">
                                                {{ html()->text('title['.$language->lang_code.']')
                                                    ->class('form-control')
                                                    ->placeholder('Job Title')
                                                    ->id('title['.$language->lang_code.']')
                                                    ->value($title)
                                                    ->required()
                                                    ->autofocus() }}
                                            </div><!--col-->
                                        </div><!--form-group-->
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="<?= 'designation['.$language->lang_code.']' ?>">Designation</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="<?= 'designation['.$language->lang_code.']' ?>" value="<?= $designation ?>" placeholder="Designation" required>
                                            </div><!--col-->
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="<?= 'vacancy['.$language->lang_code.']' ?>">No. of Vacancies</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="<?= 'vacancy['.$language->lang_code.']' ?>" value="<?= $vacancy ?>"  placeholder="No. of Vacancies" required>
                                            </div><!--col-->
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="<?= 'departmentId['.$language->lang_code.']' ?>">Department</label>
                                            <div class="col-md-10">
                                                <select name="<?= 'departmentId['.$language->lang_code.']' ?>" class="form-control">
                                                   <?php if($department_data){
                                                        foreach($department_data as $key => $department){?>
                                                        <option value="<?= $key ?>"<?php if($departmentId == $key){ echo'selected'; } ?>><?= $department ?></option>
                                                    <?php
                                                        }
                                                    }
                                                        ?>
                                                </select>
                                            </div><!--col-->
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="<?= 'location['.$language->lang_code.']' ?>">Location</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="<?= 'location['.$language->lang_code.']' ?>"  value="<?= $location ?>" placeholder="Location" required>
                                            </div><!--col-->
                                        </div>
                                        <div class="form-group row">
                                            {{ html()->label('Image')->class('col-md-2 form-control-label')->for('image['.$language->lang_code.']') }}
                                            <div class="col-md-10">
                                                @if($imagen != '')
                                                    @php
                                                    $image = url('/images/jobs/'.$imagen);
                                                    @endphp
                                                    <span>
                                                    <img src="{{ $image }}"  alt="Propert picture" style='width:150px;height:100px;'>
                                                </span>
                                                @endif
                                                {{ html()->file('image['.$language->lang_code.']')
                                                    ->class('form-control')
                                                    ->id('image['.$language->lang_code.']')
                                                    ->required() }}
                                            </div><!--col-->
                                        </div><!--form-group-->
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="<?= 'short_description['.$language->lang_code.']' ?>">Short Description</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" rows="6" name="<?= 'short_description['.$language->lang_code.']' ?>" id="<?= 'short_description['.$language->lang_code.']' ?>" placeholder="Short Description" required=""><?= $shortdescription ?></textarea>
                                            </div><!--col-->
                                        </div>

                                        <div class="form-group row">
                                            {{ html()->label('Description')->class('col-md-2 form-control-label')->for('description') }}
                                            <div class="col-md-10">
                                                {{ html()->textarea('description['.$language->lang_code.']')
                                                    ->class('form-control t-editor')
                                                    ->id($ide)
                                                    ->value($description)
                                                    ->placeholder('Description')
                                                    ->required() }}
                                            </div><!--col-->
                                        </div><!--form-group-->
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="<?= 'start_date['.$language->lang_code.']' ?>">Publish Start Date</label>
                                            <div class="col-md-10">
                                                <input class="form-control start_datepicker" type="text" name="<?= 'start_date['.$language->lang_code.']' ?>" value="<?= date('d-m-Y',$start_date) ?>"   placeholder="Publish Start Date" required>
                                            </div><!--col-->
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="<?= 'end_date['.$language->lang_code.']' ?>">Publish End Date</label>
                                            <div class="col-md-10">
                                                <input class="form-control end_datepicker" type="text" name="<?= 'end_date['.$language->lang_code.']' ?>" value="<?= date('d-m-Y',$end_date) ?>" placeholder="Publish End Date" required>
                                            </div><!--col-->
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="<?= 'status['.$language->lang_code.']' ?>">Status</label>
                                            <div class="col-md-10">
                                                <select name="<?= 'status['.$language->lang_code.']' ?>"  class="form-control">
                                                    <option value="1" <?php if($status == 1){ echo'selected'; } ?>>Active</option>
                                                    <option value="0" <?php if($status == 0){ echo'selected'; } ?>>Inactive</option>
                                                </select>
                                            </div><!--col-->
                                        </div>
                                    </div><!--col-->
                                </div><!--row-->
                            </div>
                        <?php $i++; ?>
                    @endforeach
                </div>
            </div>

        </div><!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.jobs.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
    {{ html()->form()->close() }}
@endsection

@push('after-styles')
{{ style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css') }}
{{ style('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') }}
{{ style('css/summernote.css') }}
{{ style('css/bootstrap-editor.min.css') }}

<style>
    .bootstrap-tagsinput .tag{
        background: darkblue;
        padding: 3px;
        border-radius: 5px;
    }
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
@endpush

@push('after-scripts')
{!! script('https://code.jquery.com/jquery-1.12.4.js') !!}
{!! script('https://code.jquery.com/ui/1.12.1/jquery-ui.js') !!}
{!! script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js') !!}
{!! script('js/summernote.js') !!}

<script>
    $(document).ready(function(){
        $( ".start_datepicker" ).datepicker({
            dateFormat: "dd-mm-yy",
            minDate: -1
        });
        $( ".end_datepicker" ).datepicker({
            dateFormat: "dd-mm-yy",
            minDate: -1
        });
        /*$(document).on('change','.start_datepicker',function(){
            var str_date = $(this).val();
            $('.start_datepicker').val(str_date);
        });
        $(document).on('change','.end_datepicker',function(){
            var endr_date = $(this).val();
            $('.end_datepicker').val(endr_date);
        });*/
        $("textarea.t-editor").summernote({
            height: 250,                 // set editor height
            minHeight: 100,             // set minimum height of editor
            maxHeight: null,
            focus: true
        });
    });

</script>
@endpush