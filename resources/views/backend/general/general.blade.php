@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.general') . ' | ' . __('labels.backend.access.users.general'))



@section('content')
    {{ html()->form('POST', route('admin.global.store'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.users.general')
                            <small class="text-muted">Create</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.general.lang'))->class('col-md-2 form-control-label')->for('lang') }}

                            <div class="col-md-10">
                                <select name="lang" class="form-control"  id="lang">
                                    @foreach ($lang as $item)
                                        <option value="<?=$item->lang_code?>">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.general.page'))->class('col-md-2 form-control-label')->for('page') }}
                            <div class="col-md-10">
                                <select name="page" class="form-control"  id="page">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                </select>
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.general.title'))->class('col-md-2 form-control-label')->for('title') }}

                            <div class="col-md-10">
                                {{ html()->text('title')
                                    ->class('form-control')
                                    ->value($global->flipkoti)
                                    ->placeholder(__('validation.attributes.backend.access.general.title'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                        
                        <div class="form-group row">
                        {{ html()->label(__('Date Format'))->class('col-md-2 form-control-label')->for('date_format') }}

                            <div class="col-md-10">
                                <select name="date_format" class="form-control">
                                    <option value="d-m-Y H:i:s">d-m-Y H:i:s</option>
                                </select>
                                {{-- {{ html()->text('title')
                                    ->class('form-control')
                                    ->value($global->flipkoti)
                                    ->placeholder(__('validation.attributes.backend.access.general.title'))
                                    ->attribute('maxlength', 191)
                                    ->required() }} --}}
                            </div><!--col-->
                        </div><!--form-group-->

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.general.meta'))->class('col-md-2 form-control-label')->for('meta') }}

                            <div class="col-md-10">
                                {{ html()->textarea('meta')
                                    ->class('form-control')
                                    ->value($global->desciption)
                                    ->placeholder(__('validation.attributes.backend.access.general.meta'))
                                    ->attribute('maxlength', 191)
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection
