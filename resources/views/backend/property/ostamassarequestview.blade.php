@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Ostamassa Property Request View')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Ostamassa Property Request
                    <small class="text-muted">Ostamassa Property Request View</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th style="width:350px;">Requester Name</th>
                            <td>{{ $requestData->name }}</td>
                        </tr>
                        <tr>
                            <th>Requester Phone</th>
                            <td>{{ $requestData->phone }}</td>
                        </tr>
                        <tr>
                            <th>Requester Email</th>
                            <td>{{ $requestData->email }}</td>
                        </tr>
                        <tr>
                            <th style="width:350px;">Property By Name</th>
                            <td>{{ $propertyContact->name }}</td>
                        </tr>
                        <tr>
                            <th>Property By Phone</th>
                            <td>{{ $propertyContact->phone }}</td>
                        </tr>
                        <tr>
                            <th>Property By Email</th>
                            <td>{{ $propertyContact->email }}</td>
                        </tr>
                        <tr>
                            <th>Property City</th>
                            <td>{{ $propertyContact->city }}</td>
                        </tr>
                        <tr>
                            <th>Property type</th>
                            <td>{{ $propertyContact->property_type }}</td>
                        </tr>
                        <tr>
                            <th>Property Condition</th>
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
                            <th>Property Created At</th>
                            <td>{{ $propertyContact->created_at->diffForHumans() }}</td>
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
