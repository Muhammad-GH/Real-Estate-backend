@extends('frontend.layouts.app')

@section('title','Markkinapaikka')

@section('content')

@php
    $simages = [];
    if(!empty($work->slider_images)){
        $simages = explode(",",$work->slider_images);
    }
    $diff = datetimeDiff($work->post_expiry_date);
    $time_left = '';
    if($diff['day'] == 0){
        $time_left .=  $diff['hour'].' h';
    }else{
        $time_left .=  $diff['day'].' d '.$diff['hour'].' h';
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
                                    <img src="{{ url('images/marketplace/work/'.$image) }}">
                                </div>
                            @endforeach
                            </div>
                            <div class="head">
                                <h4>{{ $work->title }}</h4>
                                <p>{{ __($work->post_type) }}</p>
                            </div>
                            <p>{{ $work->description }}</p>
                            <p>Kategoria <a href="#" class="badge">{{ $work->category->name }}</a></p>
                            
                            @if(!empty($work->attachment))
                                <a href="{{ url('images/marketplace/work/'.$work->attachment) }}" class="attachment" target="_blank"><i class="icon-attachment"></i>{{$work->attachment}}</a>
                            @endif

                            <table>
                                <tr>
                                    <th>Budjetti</th>
                                    <td>
                                    @php 
                                        echo ( ($work->budget=='per_m2') ? budgetTypeFormat($work->budget) : __($work->budget)  );
                                    @endphp
                                    </td>
                                </tr>
                                @if('Request' == $work->post_type)
                                <tr>
                                    <th>Hinta</th>
                                    <td>{{ formatNumber($work->rate) }}€</td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Sijainti</th>
                                    <td>{{ $work->pincode }} {{ $work->city }}</td>
                                </tr>
                                @if('Offer' == $work->post_type)
                                <tr>
                                    <th>{{__('Availability')}}</th>
                                    <td>{{ dateDisplay($work->available_from, 'M d, Y') }} - {{ dateDisplay($work->available_to, 'M d, Y') }}</td>
                                </tr>
                                @else
                                <tr>
                                    <th>Työn aloitus</th>
                                    <td>{{ dateDisplay($work->available_from, 'M d, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Työn lopetus</th>
                                    <td>{{ dateDisplay($work->available_to, 'M d, Y') }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Sulkeutuu</th>
                                    <td>{{$time_left}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="rightbar">
                            @include('frontend.marketplace.work_bid_form')
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
    $('#work-bid-form').validate({ // initialize the plugin
        rules: {
            quote: { required: true },
            name: { required: true },
            email_address: { required: true, email: true /*laxphone:true*/},
            contact_number: { required: true },
            message: { required: true },
            terms: { required: true }
            
        },
        messages: {
            quote: { required: 'Pakollinen tieto' },
            name: { required: 'Pakollinen tieto' },
            email_address: { required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite'},
            contact_number: { required: 'Pakollinen tieto' },
            message: { required: 'Pakollinen tieto' },
            terms: { required: 'Pakollinen tieto' }             
        },
        errorPlacement: function(error, element) {
            var type = $(element[0]).attr('name');
            
                error.insertAfter(element.parent());
            
        }
    });
</script>
@endpush