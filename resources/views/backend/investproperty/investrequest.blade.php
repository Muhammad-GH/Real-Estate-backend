@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . 'Invest Property Management')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Investment Request
                </h4>
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Investing User </th>
                            <th>User Email</th>
                            <th>User Contact No.</th>
                            <th>Investing On Property</th>
                            <th>Invest Price</th>
                            <th>Invest Type</th>
                            <th>Created</th>
                            <!-- <th>@lang('labels.general.actions')</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($propertyContacts as $property_contact)
                            <tr>
                                <!-- <td><pre>@php print_r($property_contact) @endphp</pre></td> -->
                                <td>{{ @$property_contact->user->first_name}} {{  @$property_contact->user->last_name }}</td>
                                <td>{{ @$property_contact->user->email }}</td>
                                <td>{{ @$property_contact->userDetails->phone }}</td>
                                <td>
                                    @if(isset($property_contact->investmentProperty))
                                        {{ $property_contact->investmentProperty->title }}
                                    @endif
                                </td>
                                <td>{{ $property_contact->price }}</td>
                                <td>{{ ($property_contact->investment_time)?$property_contact->investment_time:"Long time investment" }}</td>
                                <td>{{ $property_contact->created_at->diffForHumans() }}</td>
                                <!-- <td>
                                    <div class="btn-group" role="group" aria-label="@lang('labels.backend.access.users.user_actions')">
                                        <a href="{{ route('admin.property.myymassa_view', $property_contact->id) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td> -->
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
