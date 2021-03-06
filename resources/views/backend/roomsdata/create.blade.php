@extends('backend.layouts.app')

@section('title', 'roomsData Management' . ' | ' . 'Create Rooms popup message')

@section('breadcrumb-links')
    <li class="breadcrumb-menu">
        <div class="btn-group" role="group" aria-label="Button group">
            <div class="dropdown">
                <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Add Rooms popup message
                </a>

            </div>
            <!--dropdown-->
        </div>
        <!--btn-group-->
    </li>
    <li class="breadcrumb-menu">
        <div class="btn-group" role="group" aria-label="Button group">
            <div class="dropdown">
                <a class="dropdown-item" href="{{ route('admin.roomsdata.create') }}">
                    Create Department
                </a>
            </div>
            <!--dropdown-->
        </div>
        <!--btn-group-->
    </li>

@endsection

@section('content')
    {{ html()->form('POST', route('admin.roomsdata.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Create Department
                    </h4>
                </div>
                <!--col-->
            </div>
            <!--row-->
            <hr>
            <div class="row mt-4 tabination">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <?php $i = 0; ?>
                        @foreach($languages as $language)
                            <a class="nav-item nav-link <?php if ($i == 0) echo 'active'; ?>"
                               id="nav-metrial-{{$language->name}}-tab" data-toggle="tab"
                               href="#nav-metrial-{{$language->lang_code}}" role="tab"
                               aria-controls="nav-metrial-{{$language->name}}"
                               aria-selected="true">{{$language->name}}</a>
                            <?php $i++; ?>
                        @endforeach
                    </div>
                </nav>

                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <?php $i = 0; ?>
                    @foreach($languages as $language)
                        <?php
                        $vacancy = 'vacancy-' . $language->lang_code;
                        $id = 'editor-' . $language->lang_code; ?>
                        <div class="tab-pane <?php if ($i == 0) echo 'active'; ?>"
                             id="nav-metrial-{{$language->lang_code}}"
                             role="tabpanel" aria-labelledby="nav-nav-metrial-{{$language->name}}-tab">
                            <div class="row mt-4 mb-4">
                                <div class="col">
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label"
                                               for="<?= 'room_id[' . $language->lang_code . ']' ?>">Select Room</label>

                                        <div class="col-md-10">
                                            <select class=" form-control"
                                                    name="<?= 'room_id[' . $language->lang_code . ']' ?>">
                                                @foreach($rooms as $room)
                                                    <option value="{{ $room->id}}">{{$room->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label"
                                               for="<?= 'type[' . $language->lang_code . ']' ?>">Select work type for</label>

                                        <div class="col-md-10">
                                            <select class=" form-control"
                                                    name="<?= 'work_type[' . $language->lang_code . ']' ?>">
                                                <option value="1">Work</option>
                                                <option value="2">Material</option>
                                            </select>
                                        </div>
                                        <!--col-->
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label"
                                               for="<?= 'type[' . $language->lang_code . ']' ?>">Select type for</label>

                                        <div class="col-md-10">
                                            <select class=" form-control"
                                                    name="<?= 'msgtype[' . $language->lang_code . ']' ?>">
                                                <option value="1">Basic</option>
                                                <option value="2">Exclusive</option>
                                            </select>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label"
                                               for="<?= 'type[' . $language->lang_code . ']' ?>">Select Room</label>

                                        <div class="col-md-10">
                                            <select class=" form-control select-type"
                                                    name="<?= 'type[' . $language->lang_code . ']' ?>">
                                                <option value="1">Text</option>
                                                <option value="2">Image</option>
                                            </select>
                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="form-group row type-text">
                                        <label class="col-md-2 form-control-label"
                                               for="<?= 'message[' . $language->lang_code . ']' ?>">Message</label>

                                        <div class="col-md-10">
                                            <textarea class="form-control" rows="6"
                                                      name="<?= 'message[' . $language->lang_code . ']' ?>"
                                                      placeholder="Message" required=""></textarea>

                                        </div>
                                        <!--col-->
                                    </div>
                                    <div class="form-group row type-image" style="display: none;">
                                        <label class="col-md-2 form-control-label"
                                               for="<?= 'image[' . $language->lang_code . ']' ?>">Image</label>

                                        <div class="col-md-10">
                                            {{ html()->file('image['.$language->lang_code.']')
                                                ->class('form-control')
                                                ->id('image['.$language->lang_code.']')
                                                ->required() }}
                                        </div>
                                        <!--col-->
                                    </div>

                                </div>
                                <!--col-->
                            </div>
                            <!--row-->
                        </div>
                        <?php $i++; ?>
                    @endforeach
                </div>
            </div>

        </div>
        <!--card-body-->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.roomsdata.index'), __('buttons.general.cancel')) }}
                </div>
                <!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div>
                <!--col-->
            </div>
            <!--row-->
        </div>
        <!--card-footer-->
    </div><!--card-->
    {{ html()->form()->close() }}
@endsection

@push('after-styles')

<style>
    .bootstrap-tagsinput .tag {
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

<script>
    $(document).ready(function () {
        $(document).on("change", ".select-type", function () {
            var val = $(this).val();
            if (val == 1) {
                $(this).parent().parent().parent().find(".type-text").show();
                $(this).parent().parent().parent().find(".type-image").hide();
            } else if (val == 2) {
                $(this).parent().parent().parent().find(".type-image").show();
                $(this).parent().parent().parent().find(".type-text").hide();
            }
        });
    });

</script>
@endpush