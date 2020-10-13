@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Marketplace - Material')

@section('breadcrumb-links')
    @include('backend.marketplace.material.offer-breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Marketplace
                    <small class="text-muted">View material offer</small>
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
                            <td>{{ $material->title }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{ $material->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $material->description }}</td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td>{{ $material->quantity }} {{ $material->unit }}</td>
                        </tr>
                        <tr>
                            <th>Cost/Unit</th>
                            <td>{{ $material->cost_per_unit }}/{{ $material->unit }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{ $material->city }}</td>
                        </tr>
                        <tr>
                            <th>Pin code</th>
                            <td>{{ $material->pincode }}</td>
                        </tr>
                        <tr>
                            <th>Warranty</th>
                            <td>{{ $material->warranty }} {{ $material->warranty_type }}</td>
                        </tr>
                        <tr>
                            <th>Delivery type</th>
                            <td>
                                @php
                                if(!empty($material->delivery_type_cost)){
                                $deliverytype_cost = json_decode($material->delivery_type_cost);
                                    foreach($deliverytype_cost as $type=>$cost){
                                    if(!empty($type) && !empty($cost))
                                        echo "By $type - $cost <br>";
                                    }
                                }
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <th>post expires in</th>
                            @php
                            $diff = datetimeDiff($material->post_expiry_date);
                            @endphp
                            <td>{{ $diff['day'] }} day, {{$diff['hour']}} hour</td>
                        </tr>
                         <tr>
                            <th>Attachment</th>
                            <td>
                                @if(!empty($material->attachment))
                                    @php
                                        $file = url('/images/marketplace/material/'.$material->attachment);
                                    @endphp
                                    <i class="fa fa-paperclip"></i>
                                    <a href="{{$file}}" target="_blank">{{$material->attachment}}</a>
                                @endif
                                
                            </td>
                        </tr>
                        <tr>
                            <th>Featured Images</th>
                            <td>
                                @if(isset($material->featured_image) &&!empty($material->featured_image))
                                    @php
                                        $image = url('/images/marketplace/material/'.$material->featured_image);
                                    @endphp
                                    <img src="{{ $image }}" style="width:250px" alt="Featured image">
                                @endif
                                
                            </td>
                        </tr>
                        <tr>
                            <th>Slider Images</th>
                            <td>
                                @php
                                $slider_images = [];
                                if(!empty($material->slider_images)){
                                    $slider_images = json_decode($material->slider_images);
                                }
                                @endphp
                                @if( count($slider_images) > 0 )
                                    @foreach($slider_images as $sliderimage)
                                        @php
                                            $image = url('/images/marketplace/material/'.$sliderimage);
                                        @endphp
                                        <img src="{{ $image }}" style="width:250px" alt="picture">
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        
                    </table>
                </div>
            </div><!--table-responsive-->
        </div>
    </div><!--card-body-->

</div><!--card-->
@endsection
