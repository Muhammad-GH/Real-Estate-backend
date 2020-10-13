<!-- @extends('backend.layouts.app') -->

@if( $bid_type == 'offer' )
	@section('title', app_name() . ' | ' . 'Work Offer Bids')
@else
	@section('title', app_name() . ' | ' . 'Work Request Bids')
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
						Work Offer Bids
					@else
						Work Request Bids
					@endif
                </h4>
                      <table class="table">
						<thead>
						  <tr>
							<th>Quote</th>
							<th>Name</th>
							<th>Email Address</th>
							<th>Contact Number</th>
							<th>Action</th>
						  </tr>
						</thead>
						<tbody>
						@if(count($workBid) >0)
						  @foreach($workBid as $textdata)      
						  <tr class="success">
							<td>{{$textdata->quote}} €</td> 
							<td>{{$textdata->name}}</td>
							<td>{{$textdata->email_address}}</td>
							<td>{{$textdata->contact_number}}</td>
							<td>
								@if( $bid_type == 'offer' )
									<a href="{{ route('admin.marketplace.workOfferBidDetail',['id'=>$textdata->id,'bidId'=>$textdata->work_post_id]) }}" data-toggle="tooltip" data-placement="top" data-original-title="View" class="btn btn-info">
									<i class="fas fa-eye"></i>
									</a>
								@else
									<a href="{{ route('admin.marketplace.workRequestBidDetail',['id'=>$textdata->id,'bidId'=>$textdata->work_post_id]) }}" data-toggle="tooltip" data-placement="top" data-original-title="View" class="btn btn-info">
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