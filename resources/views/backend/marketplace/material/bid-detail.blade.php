@extends('backend.layouts.app')

@if( $bid_type == 'offer' )
	@section('title', app_name() . ' | ' . 'Material Offer Bid Detail')
@else
	@section('title', app_name() . ' | ' . 'Material Request Bid Detail')
@endif

@section('breadcrumb-links')

    @include('backend.marketplace.offer-breadcrumb-links')

@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                     @if( $bid_type == 'offer' )
						Material Offer Bid Detail
					 @else
						Material Request Bid Detail
					 @endif
                </h4>
            </div><!--col-->
        </div><!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th style="width:350px;">Quote</th>
                            <td>{{ $workData->quote_per_unit }} €/{{ $materialData->unit }}</td>
                        </tr>
						<tr>
                            <th>Quantity</th>
                            <td>{{ $workData->quantity }} {{ $materialData->unit }}</td>
                        </tr>
                        <tr>
                            <th>Contact Name</th>
                            <td>{{ $workData->contact_name }}</td>
                        </tr>
						<tr>
                            <th>Contact Number</th>
                            <td>{{ $workData->contact_number }}</td>
                        </tr>
						<tr>
                            <th>Email Address</th>
                            <td>{{ $workData->email_address }}</td>
                        </tr>
                        <tr>
                            <th>Company Name</th>
                            <td>{{ $workData->company_name }}</td>
                        </tr>
                        
						<tr>
							@if( $bid_type == 'offer' )
								<th>Shipping To</th>
							@else
								<th>Shipping From</th>
							@endif
                            
                            <td>{{ $workData->shipping_location }}</td>
                        </tr>
						<tr>
                            <th>Delivery</th>
                            <td>{{ $workData->delivery_type }} - {{ $workData->delivery_charges }}</td>
                        </tr>
						<tr>
                            <th>Warranty</th>
                            <td>{{ $workData->warranty }} {{ $workData->warranty_type }}</td>
                        </tr>
						<tr>
                            <th>Message</th>
                            <td>{{ $workData->message }}</td>
                        </tr>
                    </table>
                </div>
            </div><!--table-responsive-->
        </div>
    </div><!--card-body-->

</div><!--card-->
@endsection
