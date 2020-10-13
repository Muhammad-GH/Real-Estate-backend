@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Professional Enquiries')

@section('breadcrumb-links')
    @include('backend.marketplace.material.offer-breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Professional Enquiries
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
                            <th>Service Type</th>
                            <th>Property Address</th>
                            <th>Contact Person</th>
                            <th>Contact Email</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($professionalProperties as $professionalProperty)
                        <tr>
                            <td>{{ $professionalProperty->service_type }}</td>
                            <td>{{ $professionalProperty->property_address }}</td>
                            <td>{{ $professionalProperty->contact_person_name }}</td>
                            <td>{{ $professionalProperty->contact_email }}</td>
                            <td> 
                                <a href="{{ route('admin.professional-properties.show', $professionalProperty->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
                                <i class="fas fa-eye"></i>
                                </a>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $professionalProperties->links() }}
                </div>
            </div><!--col-->
        </div><!--row-->
        
    </div><!--card-body-->
</div><!--card-->
@endsection
