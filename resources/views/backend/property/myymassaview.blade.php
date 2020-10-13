@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Property Management')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Myymassa Query
                    <small class="text-muted">Myymassa Query View</small>
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
                            <th>City</th>
                            <td>{{ $propertyContact->city?$propertyContact->city:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $propertyContact->address?$propertyContact->address:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Property type</th>
                            <td>{{ $propertyContact->property_type }}</td>
                        </tr>
                        <tr>
                            <th>Condition</th>
                            <td>{{ $propertyContact->condition }}</td>
                        </tr>
                        <tr>
                            <th>Built Year</th>
                            <td>{{ $propertyContact->built_year }}</td>
                        </tr>
                        <tr>
                            <th>Appartment Price</th>
                            <td>{{ $propertyContact->appartment_max_price }}</td>
                        </tr>
                        <tr>
                            <th>Appartment Size</th>
                            <td>{{ $propertyContact->apartment_size }}</td>
                        </tr>
                        <tr>
                            <th>Rooms</th>
                            <td>{{ $propertyContact->no_rooms }}</td>
                        </tr>
                        <tr>
                            <th>Additional Requests</th>
                            <td>{{ $propertyContact->additional_requests }}</td>
                        </tr>
                        <tr>
                            <th>Additional Requests 2</th>
                            <td>{{ $propertyContact->additional_selection }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $propertyContact->created_at->diffForHumans() }}</td>
                        </tr>
                    </table>
                </div>
            </div><!--table-responsive-->
        </div>
    </div><!--card-body-->
</div><!--card-->
@endsection
