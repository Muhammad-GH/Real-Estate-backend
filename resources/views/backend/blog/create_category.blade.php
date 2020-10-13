@extends('backend.layouts.app')

@section('title', 'Blog Category Management' . ' | ' . 'Create Blog Category')

@section('breadcrumb-links')
    @include('backend.blog.includes.breadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.blog.category.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            Blog Category Management
                            <small class="text-muted">Create Blog Category</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>
                                    
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <div class="form-group row">
                            {{ html()->label('Name')->class('col-md-2 form-control-label')->for('name') }}

                            <div class="col-md-10">
                                {{ html()->text('name')
                                    ->class('form-control')
                                    ->placeholder('Name')
                                    ->attribute('maxlength', 191)
                                    ->required()
                                    ->autofocus() }}
                            </div><!--col-->
                        </div>


                        <!--form-group-->

                       
                        <div class="form-group row">
                            {{ html()->label('Details')->class('col-md-2 form-control-label')->for('details') }}

                            <div class="col-md-10">
                                {{ html()->textarea('details')
                                    ->class('form-control')
                                    ->placeholder('Details')
                                    ->required() }}
                                    <!-- ->attribute('maxlength', 191) -->
                            </div><!--col-->
                        </div><!--form-group-->

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.blog.category.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection