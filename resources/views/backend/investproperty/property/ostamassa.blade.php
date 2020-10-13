@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Property Management')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Property Management <small class="text-muted">Ostamassa Property</small>
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>App. Min Size</th>
                            <th>App. Max Size</th>
                            <th>Room min</th>
                            <th>Room max</th>
                            <th>Construction min year</th>
                            <th>Construction max year</th>
                            <th>Approved</th>
                            <!-- <th>Replied</th> -->
                            <th>Created</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($propertyContacts as $property_contact)
                            <tr>
                                <!-- <td><pre>@php print_r($property_contact) @endphp</pre></td> -->
                                <td>{{ $property_contact->name }}</td>
                                <td>{{ $property_contact->phone }}</td>
                                <td>{{ $property_contact->email }}</td>
                                <td>{{ $property_contact->city }}</td>
                                <td>{{ $property_contact->appartment_min_size }}</td>
                                <td>{{ $property_contact->appartment_max_size }}</td>
                                <td>{{ $property_contact->rooms_min }}</td>
                                <td>{{ $property_contact->rooms_max }}</td>
                                <td>{{ $property_contact->construction_year_min }}</td>
                                <td>{{ $property_contact->construction_year_max }}</td>
                                <td>
                                    @if($property_contact->approved)
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    @endif
                                </td>
                                <td>{{ $property_contact->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
                                        <a href="{{ route('admin.property.ostamassa_view', $property_contact->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.property.ostamassa_edit', $property_contact->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                         @if(!$property_contact->approved)
                                            <a href="{{ route('admin.property.ostamassa_approve', $property_contact->id) }}" title="Are you sure you want to approve this item?" data-trans-title="Are you sure you want to approve this item?" class="btn btn btn-primary">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('admin.property.ostamassa_disapprove', $property_contact->id) }}"  title="Are you sure you want to disapprove this item?" data-trans-title="Are you sure you want to disapprove this item?" class="btn btn-danger">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
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
                    {!! $propertyContacts->total() !!} {{ trans_choice('Property total|Properties total', $propertyContacts->total()) }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $propertyContacts->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
