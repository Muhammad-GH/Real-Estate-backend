@extends('backend.layouts.app')

@section('title', __('labels.backend.category.management') . ' | ' . __('labels.backend.category.edit'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($category, 'PATCH', route('admin.category.update', $category->category_id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.category.management')
                        <small class="text-muted">@lang('labels.backend.category.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('labels.backend.category.table.name'))->class('col-md-2 form-control-label')->for('first_name') }}

                        <div class="col-md-10">
                            {{ html()->text('category_name')
                                ->class('form-control')
                                ->placeholder(__('labels.backend.category.table.name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
 
                        {{ html()->label(__('labels.backend.category.table.parent'))->class('col-md-2 form-control-label')->for('parent') }}

                        <div class="col-md-10">
                        {!! html()->select('category_parent_id', [0=>'Select'] + $categories,$category->category_parent_id)->class('form-control') !!}
                          
                        </div><!--col-->
                    </div><!--form-group-->

                     

                     
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.category.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
