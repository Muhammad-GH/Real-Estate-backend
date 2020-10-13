@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Marketplace - Material')

@section('breadcrumb-links')
    @include('backend.marketplace.material.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Professional Property
                    
                </h4>
            </div><!--col-->
        </div><!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th style="width:350px;">Service Type</th>
                            <td>{{ $professionalProperties->service_type }}</td>
                        </tr>
                        <tr>
                            <th>Property Address</th>
                            <td>{{ $professionalProperties->property_address }}</td>
                        </tr>
                        <tr>
                            <th>Year Of Built</th>
                            <td>{{ $professionalProperties->year_of_built }}</td>
                        </tr>
                        <tr>
                            <th>Area of Block (m<sup>2</sup>)</th>
                            <td>{{ $professionalProperties->area_of_block }}</td>
                        </tr>
                        <tr>
                            <th>Number of Appartments</th>
                            <td>{{ $professionalProperties->no_of_appartments }}</td>
                        </tr>
                        <tr>
                            <th>Property area (m<sup>2</sup>)</th>
                            <td>{{ $professionalProperties->property_area }}</td>
                        </tr>
                        <tr>
                            <th>Common Area (m<sup>2</sup>)</th>
                            <td>{{ $professionalProperties->common_area }}</td>
                        </tr>
                        <tr>
                            <th>Number of floors</th>
                            <td>{{ $professionalProperties->no_of_floors }}</td>
                        </tr>
                        <tr>
                            <th>Renovation Done</th>
                            <td>{{ $professionalProperties->renovation_done }}</td>
                        </tr>
                        <tr>
                            <th>Renovation Year</th>
                            <td>{{ $professionalProperties->renovation_year }}</td>
                        </tr>
                        <tr>
                            <th>Contact Person Name</th>
                            <td>{{ $professionalProperties->contact_person_name }}</td>
                        </tr>
                        <tr>
                            <th>Contact Email</th>
                            <td>{{ $professionalProperties->contact_email }}</td>
                        </tr>
                        <tr>
                            <th>Phone Number</th>
                            <td>{{ $professionalProperties->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Desired Start Date</th>
                            <td>{{ $professionalProperties->desired_start_date }}</td>
                        </tr>
                        
                    </table>
                </div>
            </div><!--table-responsive-->
        </div>
    </div><!--card-body-->

</div><!--card-->
@endsection
