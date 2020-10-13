@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Material Management')

@section('breadcrumb-links')
    @include('backend.marketplace.material.offer-breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Material Offers <small class="text-muted">Active Offers</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.marketplace.material.offer-header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Cost/Unit</th>
                            <th>City</th>
                            <th>Pin</th>
                            <th>Expire In</th>
                            <th>Created</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($offers as $material)
                            <tr>
                                <td>{{ $material->title }}</td>
                                <td> {{ $material->category->name }} </td>
                                <td>{{ $material->quantity }} {{$material->unit}}</td>
                                <td>{{ $material->cost_per_unit }}/{{ $material->unit }}</td>
                                <td>{{ $material->city }}</td>
                                <td>{{ $material->pincode }}</td>
                                @php
                                    $diff = datetimeDiff($material->post_expiry_date);
                                @endphp
                                <td>{{ $diff['day'] }} day, {{$diff['hour']}} hour</td>
                                <td>{{ $material->created_at->diffForHumans() }}</td>	
                                <td>@include('backend.marketplace.material.offer-actions', ['material' => $material])</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $offers->total() !!} {{ trans_choice('total|total', $offers->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $offers->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
