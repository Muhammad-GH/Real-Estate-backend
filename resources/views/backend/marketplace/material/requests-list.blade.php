@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Material Management')

@section('breadcrumb-links')
    @include('backend.marketplace.material.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Material Requests <small class="text-muted">Active Requests</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.marketplace.material.header-buttons')
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
                            <th>Volume Need</th>
                            <th>City</th>
                            <th>Pin</th>
                            <th>Expire In</th>
                            <th>Created</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($requests as $material)
                            <tr>
                                <td>{{ $material->title }}</td>
                                <td> {{ $material->category->name }} </td>
                                <td>{{ $material->quantity }} {{$material->unit}}</td>
                                <td>{{ $material->city }}</td>
                                <td>{{ $material->pincode }}</td>
                                @php
                                    $diff = datetimeDiff($material->post_expiry_date);
                                @endphp
                                <td>{{ $diff['day'] }} day, {{$diff['hour']}} hour</td>
                                <td>{{ $material->created_at->diffForHumans() }}</td>
                                <td>@include('backend.marketplace.material.actions', ['material' => $material])</td>
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
                    {!! $requests->total() !!} {{ trans_choice('total|total', $requests->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $requests->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
