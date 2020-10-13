<!-- @extends('backend.layouts.app') -->
@if( $bid_type == 'offer' )
	@section('title', app_name() . ' | ' . 'Material Offer Bids')
@else
	@section('title', app_name() . ' | ' . 'Material Request Bids')
@endif



@section('breadcrumb-links')

    @include('backend.marketplace.offer-breadcrumb-links')

@endsection



@section('content')
<style>
a.btn-success.float-right {
    padding: 10px 20px 10px 20px;
}
</style>
<div class="card"> 
        <div class="card-body">
            <div class="row" style="border-bottom: 1px solid #eee;padding-bottom: 10px;">
            	@if(session()->has('msg'))
					    <div class="alert alert-success">
					        {{ session()->get('msg') }}
					    </div>
				@endif
                <div class="col-sm-12"> 
				<h4 class="card-title mb-0">
					@if( $bid_type == 'offer' )
						Material Offer Bids
					@else
						Material Request Bids
					@endif
                </h4>
                      <table class="table">
						<thead>
						  <tr>
							<th>Contact Name</th>
							<th>Email Address</th>
							<th>Contact Number</th>
							<th>Quote</th>
							<th>Quantity</th>
							<th>Action</th>
						  </tr>
						</thead>
						<tbody>
						@if(count($workBid) >0)
						  @foreach($workBid as $textdata)      
						  <tr class="success">
							<td>{{$textdata->contact_name}}</td> 
							<td>{{$textdata->email_address}}</td>
							<td>{{$textdata->contact_number}}</td>
							<td>{{$textdata->quote_per_unit}} €/{{ $materialData->unit }}</td>
							<td>{{$textdata->quantity}} {{ $materialData->unit }}</td>
							<td>
								@if( $bid_type == 'offer' )
									<a href="{{ route('admin.marketplace.materialOfferBidDetail',['id'=>$textdata->id,'bidId'=>$textdata->material_post_id]) }}" data-toggle="tooltip" data-placement="top" data-original-title="View" class="btn btn-info">
									<i class="fas fa-eye"></i>
									</a>
								@else
									<a href="{{ route('admin.marketplace.materialRequestBidDetail',['id'=>$textdata->id,'bidId'=>$textdata->material_post_id]) }}" data-toggle="tooltip" data-placement="top" data-original-title="View" class="btn btn-info">
									<i class="fas fa-eye"></i>
									</a>
								@endif
								
							</td>
						  </tr>
						  @endforeach
						  @else
							<tr class="success">
							<td>No Data found!</td>
						  </tr> 
						@endif	  
						   </tbody>
					  </table>
                </div><!--col-->
                <div class="col-sm-7">
                </div><!--col-->
            </div><!--row-->
        </div>
         <!--card-body-->
    </div>
    
@endsection