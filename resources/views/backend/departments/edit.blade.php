@extends('backend.layouts.app')

@section('title', 'Department Management' . ' | ' . 'Update Department')

@section('breadcrumb-links')
    <li class="breadcrumb-menu">
        <div class="btn-group" role="group" aria-label="Button group">
            <div class="dropdown">
                <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Departments
                </a>

            </div><!--dropdown-->
        </div><!--btn-group-->
    </li>
    <li class="breadcrumb-menu">
        <div class="btn-group" role="group" aria-label="Button group">
            <div class="dropdown">
                <a class="dropdown-item" href="#">
                    Update Department
                </a>
            </div><!--dropdown-->
        </div><!--btn-group-->
    </li>

@endsection

@section('content')
    {{ html()->form('POST', route('admin.departments.update',$department_id))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Update Department
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
                            $department_name = $sort_name = '';
                            if(isset($data[$language->lang_code])){
                                $sort_name = $data[$language->lang_code]['sort_name'];
                                $department_name = $data[$language->lang_code]['department_name'];
                            }
                            ?>
                            <div class="tab-pane <?php if ($i == 0) echo 'active'; ?>"
                                 id="nav-metrial-{{$language->lang_code}}"
                                 role="tabpanel" aria-labelledby="nav-nav-metrial-{{$language->name}}-tab">
                                <div class="row mt-4 mb-4">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="<?= 'department_name['.$language->lang_code.']' ?>">Department Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="<?= 'department_name['.$language->lang_code.']' ?>"  value="<?= $department_name ?>" placeholder="Name" required>
                                            </div><!--col-->
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 form-control-label" for="<?= 'sort_name['.$language->lang_code.']' ?>">Sort Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="<?= 'sort_name['.$language->lang_code.']' ?>"  value="<?= $sort_name ?>" placeholder="Sort Name" required>
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
                    {{ form_cancel(route('admin.departments.index'), __('buttons.general.cancel')) }}
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