@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Contact Request View')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Contact Request
                    <small class="text-muted">Contact Request View</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th style="width:350px;">Name</th>
                            <td>{{ $requestData->name }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $requestData->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $requestData->email }}</td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>{{ $requestData->subject?$requestData->subject:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{ $requestData->message?$requestData->message:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Additional Selection</th>
                            <td>{{ $requestData->additional_selection?$requestData->additional_selection:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $requestData->created_at->diffForHumans() }}</td>
                        </tr>
                    </table>
                </div>
            </div><!--table-responsive-->
        </div>
    </div><!--card-body-->
</div><!--card-->
@endsection
