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
                    <small class="text-muted">Deleted Property</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                   <table class="table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Name</th>
                            <th>Buying Price</th>
                            <th>Selling Price</th>
                            <th>Created</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($investProperties as $property)
                            <tr>
                                <td>{{ $property->title }}</td>
                                <td>{{ $property->name }}</td>
                                <td>{{ $property->price }}</td>
                                <td>{{ $property->selling_price }}</td>
                                <td>{{ $property->created_at->diffForHumans() }}</td>
                                <td>@include('backend.investproperty.includes.actions', ['investproperty' => $property])</td>
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
                    {!! $investProperties->total() !!} {{ trans_choice('Invest Property total|Invest  Properties total', $investProperties->total()) }}
                </div>
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $investProperties->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
