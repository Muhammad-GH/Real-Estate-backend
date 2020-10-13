@extends('backend.layouts.app')

@section('title', 'Page Management' . ' | ' . 'Create Page')

@section('breadcrumb-links')
    <li class="breadcrumb-menu">
        <div class="btn-group" role="group" aria-label="Button group">
            <div class="dropdown">
                <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Pages
                </a>

            </div><!--dropdown-->
        </div><!--btn-group-->
    </li>
    <li class="breadcrumb-menu">
        <div class="btn-group" role="group" aria-label="Button group">
            <div class="dropdown">
                <a class="dropdown-item" href="{{ route('admin.pages.create') }}">
                    Create Page
                </a>
            </div><!--dropdown-->
        </div><!--btn-group-->
    </li>

@endsection

@section('content')
    {{ html()->form('POST', route('admin.pages.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Create Page
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
                                   href="#nav-metrial-{{$language->id}}" role="tab" aria-controls="nav-metrial-{{$language->name}}"
                                   aria-selected="true">{{$language->name}}</a>
                                <?php $i++; ?>
                            @endforeach
                        </div>
                    </nav>

                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <?php $i = 0; ?>
                        @foreach($languages as $language)
                                <?php
                                    $bannerid = 'banner-'.$language->id;
                                    $id = 'editor-'.$language->id; ?>
                        <div class="tab-pane <?php if ($i == 0) echo 'active'; ?>"
                             id="nav-metrial-{{$language->id}}"
                             role="tabpanel" aria-labelledby="nav-nav-metrial-{{$language->name}}-tab">
                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <div class="form-group row">
                                        {{ html()->label('Page Title')->class('col-md-2 form-control-label')->for('name['.$language->id.']') }}
                                        <div class="col-md-10">
                                            {{ html()->text('name['.$language->id.']')
                                                ->class('form-control')
                                                ->placeholder('Page Title')
                                                ->attribute('maxlength', 191)
                                                ->attribute('rows', 191)
                                                ->id('name['.$language->id.']')
                                                ->required()
                                                ->autofocus() }}
                                        </div><!--col-->
                                    </div><!--form-group-->
                                    <div class="form-group row">
                                        {{ html()->label('Banner Title')->class('col-md-2 form-control-label')->for('banner_title['.$language->id.']') }}
                                        <div class="col-md-10">
                                            {{ html()->textarea('banner_title['.$language->id.']')
                                                ->class('form-control tb-editor')
                                                ->id($bannerid)
                                                ->placeholder('Banner Title')
                                                ->required() }}
                                        </div><!--col-->
                                    </div><!--form-group-->
                                    <div class="form-group row">
                                        {{ html()->label('Banner Image')->class('col-md-2 form-control-label')->for('banner['.$language->id.']') }}
                                        <div class="col-md-10">
                                            {{ html()->file('banner['.$language->id.']')
                                                ->class('form-control')
                                                ->id('banner['.$language->id.']')
                                                ->required() }}
                                        </div><!--col-->
                                    </div><!--form-group-->
                                    <div class="form-group row">
                                        {{ html()->label('Page Content')->class('col-md-2 form-control-label')->for('content') }}

                                        <div class="col-md-10">
                                            {{ html()->textarea('content['.$language->id.']')
                                                ->class('form-control t-editor')
                                                ->id($id)
                                                ->placeholder('Page Content')
                                                ->required() }}
                                                    <!-- ->attribute('maxlength', 191) -->
                                        </div><!--col-->
                                    </div><!--form-group-->
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
                        {{ form_cancel(route('admin.pages.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection

@push('after-styles')
{{ style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css') }}
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
{!! script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js') !!}
{!! script('js/summernote.js') !!}

<script>
    $("textarea.tb-editor").summernote({
        height: 150,                 // set editor height
        minHeight: 100,             // set minimum height of editor
        maxHeight: null,
        focus: true
    });
    $("textarea.t-editor").summernote({
        height: 250,                 // set editor height
        minHeight: 100,             // set minimum height of editor
        maxHeight: null,
        focus: true
    });
</script>
@endpush