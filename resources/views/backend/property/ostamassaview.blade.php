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
                    <small class="text-muted">Ostamassa Property View</small>
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
                            <td>{{ $propertyContact->city }}</td>
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
                            <th>Appartment Min Size</th>
                            <td>{{ $propertyContact->appartment_min_size }}</td>
                        </tr>
                        <tr>
                            <th>Appartment Max Size</th>
                            <td>{{ $propertyContact->appartment_max_size }}</td>
                        </tr>
                        <tr>
                            <th>Room Min</th>
                            <td>{{ $propertyContact->rooms_min }}</td>
                        </tr>
                        <tr>
                            <th>Room Max</th>
                            <td>{{ $propertyContact->rooms_max }}</td>
                        </tr>
                        <tr>
                            <th>Construction Year Min</th>
                            <td>{{ $propertyContact->construction_year_min }}</td>
                        </tr>
                        <tr>
                            <th>Construction Year Max</th>
                            <td>{{ $propertyContact->construction_year_max }}</td>
                        </tr>
                        <tr>
                            <th>Appartment min price</th>
                            <td>{{ $propertyContact->appartment_min_price }}</td>
                        </tr>
                        <tr>
                            <th>Appartment max price</th>
                            <td>{{ $propertyContact->appartment_max_price }}</td>
                        </tr>
                        <tr>
                            <th>Additional Requests</th>
                            <td>{{ $propertyContact->additional_requests }}</td>
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
