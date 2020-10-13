<!-- @extends('backend.layouts.app') -->

@section('title', app_name() . ' | ' . 'Work Requests')


@section('breadcrumb-links')

    @include('backend.marketplace.request-breadcrumb-links')

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
                    Work Requests
                    <small class="text-muted">Active Requests</small>
                </h4>
				<a href="{{route('admin.marketplace.WorkRequests.create')}}" class="btn-success float-right"><i class="fas fa-plus-circle"></i></a>
                      <table class="table">
						<thead>
						  <tr>
							<th>Title</th>
							<th>Budget</th>
							<th>Rate</th>
							<th>Available From</th>
							<th>Available To</th>
							<th>City</th>
							<th>Post Expiry Date</th>
							<th>Action</th>
						  </tr>
						</thead>
						<tbody>
						@if(count($workRequests) >0)
						  @foreach($workRequests as $textdata)      
						  <tr class="success">
							<td>{{$textdata->title}}</td> 
							<td>{{$textdata->budget}}</td>
							<td>{{$textdata->rate}} €</td>
							<td>{{$textdata->available_from}}</td>
							<td>{{$textdata->available_to}}</td>
							<td>{{$textdata->city}}</td>
							<td>{{$textdata->post_expiry_date}}</td>
							<td>
								
								<a href="{{ route('admin.marketplace.workRequestBidListing', ['id' => $textdata->id]) }}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-success" data-original-title="Bid">
										<i class="fas fa-gavel"></i>
								</a>
								<a href="{{ route('admin.marketplace.WorkRequests.edit', ['id' => $textdata->id]) }}" data-toggle="tooltip" data-placement="top" title="" class="btn btn-primary" data-original-title="Edit">
										<i class="fas fa-edit"></i>
								</a>
								<a href="{{ route('admin.marketplace.WorkRequests.view', ['id' => $textdata->id]) }}" data-toggle="tooltip" data-placement="top" data-original-title="View" class="btn btn-info">
									<i class="fas fa-eye"></i>
								</a>
								<a href="{{ route('admin.marketplace.WorkRequests.delete', $textdata->id) }}" data-method="get" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.delete')" data-trans-button-cancel="@lang('buttons.general.cancel')" data-trans-button-confirm="@lang('buttons.general.crud.delete')" data-trans-title="@lang('strings.backend.general.are_you_sure')" class="btn btn-danger">
									<i class="fas fa-trash"></i>
								</a>
                            </td>
						  </tr>
						  @endforeach
						  {{ $workRequests->links() }}
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