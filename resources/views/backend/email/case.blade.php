@extends('backend.layouts.app')

@section('title', 'Case Management' . ' | ' . 'Create Content')

@section('breadcrumb-links')
    <li class="breadcrumb-menu">
        <div class="btn-group" role="group" aria-label="Button group">
            <div class="dropdown">
                <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    All Content
                </a>

            </div><!--dropdown-->
        </div><!--btn-group-->
    </li>

    

@endsection

@section('content')
    
    {{ html()->form('POST', route('admin.emails.store_case'))->class('form-horizontal')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5">
                        <h4 class="card-title mb-0">
                            @lang('labels.backend.access.users.case')
                            <small class="text-muted">@lang('labels.backend.access.users.email_cre')</small>
                        </h4>
                    </div><!--col-->
                </div><!--row-->

                <hr>

                <div class="row mt-4 mb-4">
                    <div class="col">

                        <div class="form-group row">
                            {{ html()->label(__('validation.attributes.backend.access.general.case'))->class('col-md-2 form-control-label')->for('case') }}
                            
                            <div class="col-md-10">{{ html()->text('case')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.general.case'))
                                ->attribute('maxlength', 191)
                                ->required()
                                ->autofocus() }}
                            </div>
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-body-->

            <div class="card-footer clearfix">
                <div class="row">
                    <div class="col">
                        {{ form_cancel(route('admin.emails.index'), __('buttons.general.cancel')) }}
                    </div><!--col-->

                    <div class="col text-right">
                        {{ form_submit(__('buttons.general.crud.create')) }}
                    </div><!--col-->
                </div><!--row-->
            </div><!--card-footer-->
        </div><!--card-->
    {{ html()->form()->close() }}

    <div class="row mt-4">
            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead>
                    <tr>
                        <th style="text-align: center">Cases</th>
                        <th style="text-align: center">@lang('labels.general.actions')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($for as $item)
                            <tr>
                                <td style="text-align: center">{{ $item->email_case }}</td>
                                <td style="text-align: center"><div class="btn-group" role="group" aria-label="User Actions">
                                        <a href="{{ route('admin.emails.destroy_case', $item->id) }}" data-method="get" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" data-trans-button-cancel="@lang('buttons.general.cancel')" data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="@lang('strings.backend.general.are_you_sure')" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                </table>
            </div>
        </div><!--col-->
    </div><!--row-->


@endsection
