@extends('backend.layouts.app')

@if( $bid_type == 'offer' )
	@section('title', app_name() . ' | ' . 'Work Offer Bid Detail')
@else
	@section('title', app_name() . ' | ' . 'Work Request Bid Detail')
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
						Work Offer Bid Detail
					 @else
						Work Request Bid Detail
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
                            <td>{{ $workBid->quote }} €</td>
                        </tr>
						<tr>
                            <th>Name</th>
                            <td>{{ $workBid->name }}</td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td>{{ $workBid->email_address }}</td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td>{{ $workBid->contact_number }}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{ $workBid->message }}</td>
                        </tr>
                        
                    </table>
                </div>
            </div><!--table-responsive-->
        </div>
    </div><!--card-body-->

</div><!--card-->
@endsection
