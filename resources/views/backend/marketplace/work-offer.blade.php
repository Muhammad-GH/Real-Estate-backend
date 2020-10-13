<!-- @extends('backend.layouts.app') -->

@section('title', app_name() . ' | ' . 'Work Offer')

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
                    Work Offer
                    <small class="text-muted">Active Offer</small>
                </h4>
				<a href="{{route('admin.marketplace.addworkoffer')}}" class="btn-success float-right"><i class="fas fa-plus-circle"></i></a>
                      <table class="table">
						<thead>
						  <tr>
							<th>Title</th>
							<th>Budget</th>
							<th>Available From</th>
							<th>Available To</th>
							<th>City</th>
							<th>Post Expiry Date</th>
							<th>Action</th>
						  </tr>
						</thead>
						<tbody>
						@if(count($workoffer) >0)
						  @foreach($workoffer as $textdata)      
						  <tr class="success">
							<td>{{$textdata->title}}</td> 
							<td>{{$textdata->budget}}</td>
							<td>{{$textdata->available_from}}</td>
							<td>{{$textdata->available_to}}</td>
							<td>{{$textdata->city}}</td>
							@php
								$dateFrmt = DateTime::createFromFormat("Y-m-d H:i:s",$textdata->post_expiry_date)->format("Y-m-d");
							@endphp
							<td>{{$dateFrmt}}</td>
							<td>
								<a href="{{ route('admin.marketplace.workOfferBidListing', ['id' => $textdata->id]) }}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-success" data-original-title="Bid">
										<i class="fas fa-gavel"></i>
								</a>
								<a href="{{ route('admin.marketplace.editworkoffer', ['id' => $textdata->id]) }}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-primary" data-original-title="Edit">
										<i class="fas fa-edit"></i>
								</a>
								<a href="{{ route('admin.marketplace.viewworkoffer', ['id' => $textdata->id]) }}" data-toggle="tooltip" data-placement="top" data-original-title="View" class="btn btn-info">
									<i class="fas fa-eye"></i>
								</a>
								<a href="{{ route('admin.marketplace.deleteworkoffer', $textdata->id) }}" data-method="get" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" data-trans-button-cancel="@lang('buttons.general.cancel')" data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="@lang('strings.backend.general.are_you_sure')" class="btn btn-danger">
									<i class="fas fa-trash"></i>
								</a>
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