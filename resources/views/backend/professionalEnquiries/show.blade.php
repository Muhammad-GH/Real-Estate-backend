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
                    Professional Enquiry
                    <small class="text-muted">( {{$professionalEnquiry->type}} )</small>
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
                            <td>{{ $professionalEnquiry->first_name }} {{ $professionalEnquiry->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $professionalEnquiry->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $professionalEnquiry->phone }}</td>
                        </tr>
                        <tr>
                            <th>Company Name</th>
                            <td>{{ $professionalEnquiry->housing_association }}</td>
                        </tr>
                        <tr>
                            <th>Contact Method</th>
                            <td>{{ $professionalEnquiry->contact_method }}</td>
                        </tr>
                        <tr>
                            <th>Contact Time</th>
                            <td>{{ $professionalEnquiry->contact_time }}</td>
                        </tr>
                        <tr>
                            <th>Enquiry Type</th>
                            <td>{{ $professionalEnquiry->type }}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{ $professionalEnquiry->message }}</td>
                        </tr>
                        
                    </table>
                </div>
            </div><!--table-responsive-->
        </div>
    </div><!--card-body-->

</div><!--card-->
@endsection
