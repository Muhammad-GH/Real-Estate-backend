@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Veiw Work Offer')

@section('breadcrumb-links')

    @include('backend.marketplace.offer-breadcrumb-links')

@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                     Marketplace
                     <small class="text-muted">View work offer</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th style="width:350px;">Title</th>
                            <td>{{ $workData->title }}</td>
                        </tr>
						<tr>
                            <th>Category Name</th>
                            <td>{{ $workDataCat->name }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $workData->description }}</td>
                        </tr>
                        <tr>
                            <th>Budget</th>
                            <td>{{ $workData->budget }}</td>
                        </tr>
                        <tr>
                            <th>Available From</th>
                            <td>{{ $workData->available_from }}</td>
                        </tr>
                        <tr>
                            <th>Available To</th>
                            <td>{{ $workData->available_to }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{ $workData->city }}</td>
                        </tr>
                        <tr>
                            <th>Pincode</th>
                            <td>{{ $workData->pincode }}</td>
                        </tr>
                        <tr>
                            <th>Post Expiry Date</th>
                            <td>{{ $workData->post_expiry_date }}</td>
                        </tr>
                        <tr>
                            <th>Attachment</th>
                            <td>
								@php
                                    $image = url('/images/marketplace/work/'.$workData->attachment);
                                @endphp
								<img src="{{ $image }}" style="width:250px" alt="Propert picture">
							</td>
                        </tr>
						<tr>
                            <th>Featured Image</th>
                            <td>
								@php
                                    $image = url('/images/marketplace/work/'.$workData->featured_image);
                                @endphp
								<img src="{{ $image }}" style="width:250px" alt="Propert picture">
							</td>
                        </tr>
                        <tr>
                            <th>Slider Images</th>
                            <td>
								@php
                                   $sliderImgs = explode(",",$workData->slider_images);
                                @endphp
								@foreach($sliderImgs as $propImage)
                                    @php
                                        $image = url('/images/marketplace/work/'.$propImage);
                                    @endphp
                                    <img src="{{ $image }}" style="width:250px" alt="Propert picture">
                                @endforeach
							</td>
                        </tr>
                        
                    </table>
                </div>
            </div><!--table-responsive-->
        </div>
    </div><!--card-body-->

</div><!--card-->
@endsection
