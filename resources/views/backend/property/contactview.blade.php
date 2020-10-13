@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Property Management')

@section('breadcrumb-links')
    @include('backend.property.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Property Management
                    <small class="text-muted">Contact View</small>
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
                            <td>{{ $propertyContact->name }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $propertyContact->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $propertyContact->email }}</td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>{{ $propertyContact->subject }}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{ $propertyContact->message }}</td>
                        </tr>
                        <tr>
                            <th>Property</th>
                            <td>{{ $propertyContact->property->title }}</td>
                        </tr>
                    </table>
                </div>
            </div><!--table-responsive-->
        </div>
    </div><!--card-body-->
    
</div><!--card-->
@endsection
