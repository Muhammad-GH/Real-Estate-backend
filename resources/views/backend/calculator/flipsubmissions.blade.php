<!-- @extends('backend.layouts.app') -->

@section('title', app_name() . ' | ' . 'Flip Submission Data')

@section('breadcrumb-links')
    @include('backend.setting.includes.breadcrumb-calculator-link')
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Flip Submission Data
                    </h4>
                </div><!--col-->

                <div class="col-sm-7">
                </div><!--col-->
            </div><!--row-->

            <div class="row mt-4">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Submitted On</th>
                                <th>@lang('labels.general.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($renovationData as $renovation)
                                <tr>
                                    <td>{{ $renovation->email }}</td>
                                    <td>{{ $renovation->phone }}</td>
                                    <td>{{ $renovation->created_at }}</td>
                                    <td><div class="btn-group" role="group" aria-label="User Actions">
                                            <a href="{{ route('admin.calculator.flip-view',$renovation->id ) }}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-info" data-original-title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.calculator.destroysubmission', $renovation->id) }}" data-method="get" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" data-trans-button-cancel="@lang('buttons.general.cancel')" data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="@lang('strings.backend.general.are_you_sure')" class="btn btn-danger">
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
            <div class="row">
                <div class="col-7">
                    <div class="float-left">
                        {!! $renovationData->count() !!} {{ trans_choice( 'total| total', $renovationData->total()) }}
                    </div>
                </div><!--col-->

                <div class="col-5">
                    <div class="float-right">
                        {!! $renovationData->render() !!}
                    </div>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
    </div><!--card-->
@endsection
