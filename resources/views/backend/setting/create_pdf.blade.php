@extends('backend.layouts.app')

@section('title', 'PDF Management' . ' | ' . 'Create PDF')

@section('breadcrumb-links')
    @include('backend.setting.includes.pdfbreadcrumb-links')
@endsection

@section('content')
    {{ html()->form('POST', route('admin.setting.pdf.store'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            PDF Management
                            <small class="text-muted">Create PDF</small>
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
                        </div><!--form-group-->

                       
                        <div class="form-group row">
                            {{ html()->label('Page')->class('col-md-2 form-control-label')->for('page') }}

                            <div class="col-md-10">
                                {{
                                    html()->select('page', 
                                            [
                                                '' => 'Please Select',
                                                'Dashboard' => 'Dashboard',
                                                'Invest Page' => 'Invest Page',
                                            ]
                                        )
                                        ->class('form-control')
                                        ->id('p-Aihe')
                                        ->required()
                                }}
                                    <!-- ->attribute('maxlength', 191) -->
                            </div><!--col-->
                        </div><!--form-group-->
                        <div class="form-group row">
                            {{ html()->label('Document')->class('col-md-2 form-control-label')->for('document') }}

                            <div class="col-md-10">
                                {{ html()->text('document')
                                    ->class('form-control')
                                    ->placeholder('Name')
                                    ->attribute('type', 'file')
                                    ->required() }}
                            </div><!--col-->
                        </div><!--form-group-->

                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.setting.pdf.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}
@endsection