@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Sellus service view')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Sellus service request
                    <small class="text-muted">View</small>
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
                            <td>{{ $contactForm->name }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $contactForm->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $contactForm->email }}</td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>{{ $contactForm->subject?$contactForm->subject:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{ $contactForm->message?$contactForm->message:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Condition of the housing association</th>
                            <td>{{ $contactForm->additional_requests?$contactForm->additional_requests:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Apartment Size</th>
                            <td>{{ $contactForm->apartment_size?$contactForm->apartment_size:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Apartment price</th>
                            <td>{{ $contactForm->appartment_max_price?$contactForm->appartment_max_price:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Year Built</th>
                            <td>{{ $contactForm->built_year?$contactForm->built_year:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Property Type</th>
                            <td>{{ $contactForm->property_type?$contactForm->property_type:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Number of rooms</th>
                            <td>{{ $contactForm->no_rooms?$contactForm->no_rooms:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $contactForm->address?$contactForm->address:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Apartment Conditions</th>
                            <td>{{ $contactForm->condition?$contactForm->condition:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Additional Selection</th>
                            <td>{{ $contactForm->additional_selection?$contactForm->additional_selection:'--' }}</td>
                        </tr>
                        <tr>
                            <th>Created At</th>
                            <td>{{ $contactForm->created_at->diffForHumans() }}</td>
                        </tr>
                    </table>
                </div>
            </div><!--table-responsive-->
        </div>
        @if($services)
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Sellus services
                </h4>
            </div><!--col-->
        </div><!--row-->
        <hr>
            @foreach($services as $service)
            <ul>
                <li> {{$service->name}} <strong>{{$service->price}}€@php echo budgetTypeFormat($service->price_type) @endphp</strong></li>
            </ul>
            @endforeach
        @endif
    </div><!--card-body-->
</div><!--card-->
@endsection
