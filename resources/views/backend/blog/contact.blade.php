@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Property Management')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Property Management <small class="text-muted">Property Contact</small>
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
                            <th>Property</th>
                            <th>Viewed</th>
                            <th>Replied</th>
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
                                <td>{{ $property_contact->property->name }}</td>
                                <td>{{ $property_contact->viewed }}</td>
                                <td>{{ $property_contact->replied }}</td>
                                <td>{{ $property_contact->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
                                        <a href="{{ route('admin.property.contactshow', $property_contact->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.property.contactreply', $property_contact->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
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
