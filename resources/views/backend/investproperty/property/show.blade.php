@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Property Management')

@section('breadcrumb-links')
    @include('backend.property.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Property Management
                    <small class="text-muted">View Property</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <hr>

        <div class="row mt-4 mb-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <tr>
                            <th style="width:350px;">Property title</th>
                            <td>{{ $property->title }}</td>
                        </tr>
                        <tr>
                            <th>Property name</th>
                            <td>{{ $property->name }}</td>
                        </tr>
                        <tr>
                            <th>Property Appartment Type</th>
                            <td>{{ $property->appartment_type }}</td>
                        </tr>
                        <tr>
                            <th>Property details</th>
                            <td>{{ $property->details }}</td>
                        </tr>
                        <tr>
                            <th>Property area</th>
                            <td>{{ $property->area }}</td>
                        </tr>
                        <tr>
                            <th>Property address</th>
                            <td>{{ $property->address }}</td>
                        </tr>
                        <tr>
                            <th>Property size</th>
                            <td>{{ $property->size }}</td>
                        </tr>
                        <tr>
                            <th>Property rooms</th>
                            <td>{{ $property->rooms }}</td>
                        </tr>
                        <tr>
                            <th>Property price</th>
                            <td>{{ $property->price }}</td>
                        </tr>
                        <tr>
                            <th>Property Manager Name</th>
                            <td>{{ $property->manager_name }}</td>
                        </tr>
                        <tr>
                            <th>Property Built Year</th>
                            <td>{{ $property->built_year }}</td>
                        </tr>
                        <tr>
                            <th>Property Apartment no</th>
                            <td>{{ $property->apartment_no }}</td>
                        </tr>
                        <tr>
                            <th>Property Planned Renovation</th>
                            <td>{{ $property->planned_renovation }}</td>
                        </tr>
                        <tr>
                            <th>Property Done Renovation</th>
                            <td>{{ $property->done_renovation }}</td>
                        </tr>
                        <tr>
                            <th>Property land ownership</th>
                            <td>{{ $property->land_ownership }}</td>
                        </tr>
                        <tr>
                            <th>Property land area</th>
                            <td>{{ $property->land_area }}</td>
                        </tr>
                        <tr>
                            <th>Property heating method</th>
                            <td>{{ $property->heating_method }}</td>
                        </tr>
                        <tr>
                            <th>Property monthly appartment cost</th>
                            <td>{{ $property->month_appartment_cost }}</td>
                        </tr>
                        <tr>
                            <th>Property monthly appartment capital</th>
                            <td>{{ $property->month_appartment_capital }}</td>
                        </tr>
                        <tr>
                            <th>Property water cost</th>
                            <td>{{ $property->water_cost }}</td>
                        </tr>
                        <tr>
                            <th>Property other appartment cost</th>
                            <td>{{ $property->other_appartment_cost }}</td>
                        </tr>
                        <tr>
                            <th>Property Images</th>
                            <td>
                                @if(isset($property->primaryImage->name) &&!empty($property->primaryImage->name))
                                    @php
                                        $image = url('/images/property/'.$property->id.'/'.$property->primaryImage->name);
                                    @endphp
                                @endif
                                <img src="{{ $image }}" style="width:250px" alt="Propert picture">
                                @if( count($property->propertyImage) > 0 )
                                    @foreach($property->propertyImage as $propImage)
                                        @php
                                            $image = url('/images/property/'.$property->id.'/'.$propImage->name);
                                        @endphp
                                        <img src="{{ $image }}" style="width:250px" alt="Propert picture">
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
