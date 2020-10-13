@extends('frontend.layouts.app')

@section('title','Markkinapaikka')

@section('content')

@php
    $simages = [];
    if(!empty($material->slider_images)){
        $simages = json_decode($material->slider_images);
    }
    $diff = datetimeDiff($material->post_expiry_date);
    $time_left = '';
    if($diff['day'] == 0){
        $time_left .=  $diff['hour'].' h';
    }else{
        $time_left .=  $diff['day'].' d '.$diff['hour'].' h';
    }
    $delivery_type_cost = '';
    if(!empty($material->delivery_type_cost)){
        $deliverytype_cost = json_decode($material->delivery_type_cost);
        foreach($deliverytype_cost as $type=>$cost):
            if(!empty($type) && !empty($cost))
               $delivery_type_cost .= __($type)." - $cost, ";
        endforeach;

        $delivery_type_cost = substr($delivery_type_cost, 0, strlen($delivery_type_cost)-2);
    }
                                  
@endphp
<div class="markitplace-details">
    @include('includes.partials.messages')
    <div class="container padding-80">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="content">
                            <div class="owl-carousel owl-theme slider">
                            @foreach($simages as $key => $image)        
                                <div class="item">
                                    <img src="{{ url('images/marketplace/material/'.$image) }}">
                                </div>
                            @endforeach
                            </div>
                            <div class="head">
                                <h4>{{ $material->title }}</h4>
                                <p>{{ __($material->post_type) }}</p>
                            </div>
                            <p>{{ $material->description }}</p>
                            <p>Kategoria <a href="#" class="badge">{{ $material->category->name }}</a></p>
                            
                            @if(!empty($material->attachment))
                                <a href="{{ url('images/marketplace/material/'.$material->attachment) }}" class="attachment" target="_blank"><i class="icon-attachment"></i>{{$material->attachment}}</a>
                            @endif

                            <table>
                                @if('Offer' == $material->post_type)
                                <tr>
                                    <th>Budjetti</th>
                                    <td>{{ formatNumber($material->cost_per_unit) }}€/{{ __($material->unit) }}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Quantity')}}</th>
                                    <td>{{ formatNumber($material->quantity) }}</td>
                                </tr>
                                <tr>
                                    <th>Sijainti</th>
                                    <td>{{ $material->pincode }} {{ $material->city }}</td>
                                </tr>
                                <tr>
                                    <th>Takuu</th>
                                    <td>{{ $material->warranty }} {{ __($material->warranty_type) }}</td>
                                </tr>
                                <tr>
                                    <th>{{__('Delivery')}}</th>
                                    <td>{{$delivery_type_cost}}</td>
                                </tr>
                                <tr>
                                    <th>Sulkeutuu</th>
                                    <td>{{$time_left}}</td>
                                </tr>
                                @else
                                    <tr>
                                        <th>Tarve</th>
                                        <td>{{ formatNumber($material->quantity) }} {{ __($material->unit) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sijainti</th>
                                        <td>{{ $material->pincode }} {{ $material->city }}</td>
                                    </tr>
                                    <tr>
                                        <th>Sulkeutuu</th>
                                        <td>{{$time_left}}</td>
                                    </tr>
                                @endif
                                
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="rightbar">
                            @include('frontend.marketplace.material_bid_form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('after-scripts')
<script>
    $('#material-bid-form').validate({ // initialize the plugin
        rules: {
            quote: { required: true },
            quantity: { required: true},
            contact_name: { required: true,/*laxphone:true*/},
            company_name: { required: true },
            email_address: { required: true, email: true  },
            contact_number: { required: true },
            shipping_location: { required: true },
            delivery_type: { required: true },
            delivery_charges: { required: true },
            warranty: { required: true },
            message: { required: true }
        },
        messages: {
            quote: { required: 'Pakollinen tieto' },
            quantity: { required: 'Pakollinen tieto' },
            contact_name: { required: 'Pakollinen tieto', minlength:'Tarkastathan, että numerosi on oikenin'},
            company_name: { required: 'Pakollinen tieto' },
            email_address: { required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite' },
            contact_number: { required: 'Pakollinen tieto' },
            shipping_location: { required: 'Pakollinen tieto' },
            delivery_type: { required: 'Pakollinen tieto' },
            delivery_charges: { required: 'Pakollinen tieto' },
            warranty: { required: 'Pakollinen tieto' },
            message: { required: 'Pakollinen tieto' },
            
        },
        errorPlacement: function(error, element) {
            var type = $(element[0]).attr('name');
            
                error.insertAfter(element.parent());
            
        }
    });
</script>
@endpush