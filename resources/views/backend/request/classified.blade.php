@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Classified Request')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Classified Request
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Link Classified</th>
                            <th>Viewed</th>
                            <th>Created</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requestData as $requestdata)
                            <tr>
                                <td>{{ $requestdata->name }}</td>
                                <td>{{ $requestdata->phone }}</td>
                                <td>{{ $requestdata->email }}</td>
                                <td>{{ $requestdata->link_sale }}</td>
                                <td>
                                    @if($requestdata->viewed)
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    @endif
                                </td>
                                <td>{{ $requestdata->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
                                        <a href="{{ route('admin.request.classified_view', $requestdata->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
                                            <i class="fas fa-eye"></i>
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
                    {!! $requestData->total() !!} {{ trans_choice('Total', $requestData->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $requestData->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
