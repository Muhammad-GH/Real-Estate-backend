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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company Name</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($professionalEnquiries as $professionalEnquiry)
                        <tr>
                            <td>{{ $professionalEnquiry->first_name }} {{ $professionalEnquiry->last_name }}</td>
                            <td>{{ $professionalEnquiry->email }}</td>
                            <td>{{ $professionalEnquiry->phone }}</td>
                            <td>{{ $professionalEnquiry->housing_association }}</td>
                            <td> 
                                <a href="{{ route('admin.professional-enquiries.show', $professionalEnquiry->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
                                <i class="fas fa-eye"></i>
                                </a>
                            </td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $professionalEnquiries->links() }}
                </div>
            </div><!--col-->
        </div><!--row-->
        
    </div><!--card-body-->
</div><!--card-->
@endsection
