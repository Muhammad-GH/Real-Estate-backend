@extends('frontend.layouts.app')

@section('title',__('meta_title_markkinapaikka'))
@section('meta_description', __('meta_description_markkinapaikka') )
@section('meta_image',   url('images/meta/banner-marketplace.jpg')  )

@section('content')
<?php
    $langtextarr = Session::get('langtext');
?>
    <div class="banner">
        <img class="d-none d-sm-block" src="{{ url('images/banner-marketplace.jpg') }}">
        <img class="d-block d-sm-none" src="{{ url('images/markkinapaikka-mobi.jpg') }}">
        <div class="content">
            <h1>
                <span>Ammattilaisten markkinapaikka </span><br> <span>kustannustehokkaaseen liiketoimintaan</span>
            </h1>
        </div>
    </div>
    <div class="container padding-60">
        <div class="home-info text-center">
            <p>Ekosysteemin isoille ja pienemmille toimijoille töitä, tekijöitä, materiaaleja samasta alustasta.</p>
        </div>
    </div>
    <section class="markitplace container" style="background-image:url('images/materials-bg.png');">
        <div class="content">
            <h2>Materiaalit</h2>
            <p>Löydä materiaalit tarpeisiisi ilman välikäsiä parhaaseen hintaan. Tarjoa materiaalejasi verkostolle.</p>
            <ul>
                <li><i class="icon-list-arrow"></i> Sisustus</li>
                <li><i class="icon-list-arrow"></i> Laminaatit</li>
                <li><i class="icon-list-arrow"></i> Graniitit</li>
                <li><i class="icon-list-arrow"></i> Kaapistot</li>
                <li><i class="icon-list-arrow"></i> Lattiat</li>
                <li><i class="icon-list-arrow"></i> Ulkotuotteet</li>
                <li><i class="icon-list-arrow"></i> Vinyylit</li>
                <li><i class="icon-list-arrow"></i> Muut</li>
            </ul>
            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#join">Liity verkostoon</a>
        </div>
    </section>
    <div class="markitplace-post-grid">
        <div class="container">
            <h3>Uusimmat materiaalipyynnöt ja -tarjoukset</h3>
            <div class="row gutters-40">
            @php
            foreach($material['request'] as $request):
                $diff = datetimeDiff($request->post_expiry_date);
                $time_left = '';
                if($diff['day'] == 0){
                    $time_left .=  $diff['hour'].' h';
                }else{
                    $time_left .=  $diff['day'].' d '.$diff['hour'].' h';
                }
            @endphp
                <div class="col-xl-3 col-md-6">
                    <div class="item">
                        <div class="image-box">
                            <img src="{{ url('images/marketplace/material/'.$request->featured_image) }}">
                            <span class="type">Ostetaan</span>
                        </div>
                        <div class="info">
                            <h3>{{ $request->title }}</h3>
                            <ul>
                                <li>
                                    <span class="cl-light">Määrä</span>
                                    <span>{{ formatNumber($request->quantity) }} {{ __($request->unit) }}</span>
                                </li>
                                <li>
                                    <span class="cl-light">Aikaa jäljellä</span>
                                    <span>{{ $time_left }}</span>
                                </li>
                            </ul>
                            <a href="{{ route('frontend.marketplace.materialdetail', $request->id) }}" class="btn btn-bordered">Lisätiedot</a>
                        </div>
                    </div>
                </div>
            @php
                endforeach;
            foreach($material['offer'] as $offer):
                $diff = datetimeDiff($offer->post_expiry_date);
                $time_left = '';
                if($diff['day'] == 0){
                    $time_left .=  $diff['hour'].' h';
                }else{
                    $time_left .=  $diff['day'].' d '.$diff['hour'].' h';
                }
            @endphp
                <div class="col-xl-3 col-md-6">
                    <div class="item">
                        <div class="image-box">
                            <img src="{{ url('images/marketplace/material/'.$offer->featured_image) }}">
                            <span class="type">Myydään</span>
                        </div>
                        <div class="info">
                            <h3>{{ $offer->title }}</h3>
                            <ul>
                                <li>
                                    <span class="cl-light">Budjetti</span>
                                    <span>{{ formatNumber($offer->cost_per_unit) }}€/{{ __($offer->unit) }} </span>
                                </li>
                                <li>
                                    <span class="cl-light">{{__('Quantity')}}</span>
                                    <span>{{ formatNumber($offer->quantity) }}</span>
                                </li>
                                <li>
                                    <span class="cl-light">Aikaa jäljellä</span>
                                    <span>{{ $time_left }}</span>
                                </li>
                            </ul>
                            <a href="{{ route('frontend.marketplace.materialdetail', $offer->id) }}" class="btn btn-bordered">Lisätiedot</a>
                        </div>
                    </div>
                </div>
            @php
                endforeach;
            @endphp
            </div>
        </div>
    </div>
    <section class="markitplace container" style="background-image:url('images/work-bg.png');">
        <div class="content">
            <h2>Työt ja tekijät</h2>
            <p>Löydä töitä itsellesi tai työntekijöillesi, tai löydä tekijä työlle</p>
            <ul>
                <li><i class="icon-list-arrow"></i> Urakoitsija tai kevytyrittäjä</li>
                <li><i class="icon-list-arrow"></i> LVIS</li>
                <li><i class="icon-list-arrow"></i> Timpuri</li>
                <li><i class="icon-list-arrow"></i> Kuljetus </li>
                <li><i class="icon-list-arrow"></i> Maalari</li>
                <li><i class="icon-list-arrow"></i> Insinööri </li>
                <li><i class="icon-list-arrow"></i> Purkutyöt</li>
                <li><i class="icon-list-arrow"></i> Valvoja</li>
                <li><i class="icon-list-arrow"></i> Suunnittelija </li>
                <li><i class="icon-list-arrow"></i> muut </li>
            </ul>
            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#join">Liity verkostoon</a>
        </div>
    </section>
    <div class="markitplace-post-grid">
        <div class="container">
            <h3>Uusimmat työt ja tekijät</h3>
            <div class="row gutters-40">
            @php
            foreach($work['request'] as $request):
                $diff = datetimeDiff($request->post_expiry_date);
                $time_left = '';
                if($diff['day'] == 0){
                    $time_left .=  $diff['hour'].' h';
                }else{
                    $time_left .=  $diff['day'].' d '.$diff['hour'].' h';
                }
            @endphp

                <div class="col-xl-3 col-md-6">
                    <div class="item">
                        <div class="image-box">
                            <img src="{{ url('images/marketplace/work/'.$request->featured_image) }}">
                            <span class="type">Haetaan</span>
                        </div>
                        <div class="info">
                            <h3>{{ $request->title }}</h3>
                            <ul>
                                <li>
                                    <span class="cl-light">Budjetti</span>
                                    <span>{{ formatNumber($request->rate) }}€ @php echo __(budgetTypeFormat($request->budget)); @endphp</span>
                                </li>
                                <li>
                                    <span class="cl-light">Aikaa jäljellä</span>
                                    <span>{{ $time_left }}</span>
                                </li>
                            </ul>
                            <a href="{{ route('frontend.marketplace.workdetail', $request->id) }}" class="btn btn-bordered">Lisätiedot</a>
                        </div>
                    </div>
                </div>

            @php
                endforeach;
            foreach($work['offer'] as $offer):
                $diff = datetimeDiff($offer->post_expiry_date);
                $time_left = '';
                if($diff['day'] == 0){
                    $time_left .=  $diff['hour'].' h';
                }else{
                    $time_left .=  $diff['day'].' d '.$diff['hour'].' h';
                }
            @endphp
                <div class="col-xl-3 col-md-6">
                    <div class="item">
                        <div class="image-box">
                            <img src="{{ url('images/marketplace/work/'.$offer->featured_image) }}">
                            <span class="type">Myydään</span>
                        </div>
                        <div class="info">
                            <h3>{{ $offer->title }}</h3>
                            <ul>
                                <li>
                                    <span class="cl-light">Budjetti</span>
                                    <span>@php 
                                        echo ( ($offer->budget=='per_m2') ? budgetTypeFormat($offer->budget) : __($offer->budget)  );
                                    @endphp</span>
                                </li>
                                <li>
                                    <span class="cl-light">Aikaa jäljellä</span>
                                    <span>{{$time_left}}</span>
                                </li>
                            </ul>
                            <a href="{{ route('frontend.marketplace.workdetail', $offer->id) }}" class="btn btn-bordered">Lisätiedot</a>
                        </div>
                    </div>
                </div>
            @php
                endforeach;
            @endphp
                
            </div>
        </div>
    </div>
    <!-- join our network, Modal -->
    <div class="modal fade join-modal" id="join" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="head">
                        <h3>Liity verkostoon</h3>
                    </div>
                    <div class="join-form">
                        <form method="post" action="{{ route('frontend.professional-enquiry') }}" id="marketplace-network">
                            @csrf
                            <input type="hidden" name="type" value="Marketplace" >
                            <div class="row gutters-24">
                                <div class="col-md-6">
                                    <div class="row gutters-16">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Etunimi</label>
                                                <input class="form-control" type="text" name="first_name"  required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sukunimi</label>
                                                <input class="form-control" type="text" name="last_name"  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sähköposti</label>
                                        <input class="form-control" type="text" name="email"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Puhelinnumero</label>
                                        <input class="form-control" type="text" name="phone"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Yrityksen nimi</label>
                                        <input class="form-control" type="text" name="housing_association">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Haluttu yhteydenottotapa</label>
                                        <div class="radio">
                                            <label for="radio1"><input type="radio" id="radio1" name="contact_method" value="phone" checked><span class="checkmark"></span>Puhelin</label>
                                            <label for="radio2"><input type="radio" id="radio2" name="contact_method" value="email"><span class="checkmark"></span>Sähköposti</label>
                                            <label for="radio3"><input type="radio" id="radio3" name="contact_method" value="both"><span class="checkmark"></span>Molemmat</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Paras aika tavoitella</label>
                                        <div class="time-selecter">
                                            <label for="frame1"><input type="radio" id="frame1" value="9-12" name="contact_time"> <span class="form-control">9-12</span></label>
                                            <label for="frame2"><input type="radio" id="frame2" value="12-15" name="contact_time"> <span class="form-control">12-15</span></label>
                                            <label for="frame3"><input type="radio" id="frame3" value="15-18" name="contact_time" checked> <span class="form-control">15-18</span></label>
                                            <label for="frame4"><input type="radio" id="frame4" value="18-21" name="contact_time"> <span class="form-control">18-21</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Viesti</label>
                                        <textarea class="form-control" name="message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label class="light" for="terms"><input type="checkbox" class="custom-check" id="terms" name="terms" required=""><span class="checkmark"></span>{{ translateText($langtextarr, 'Olen lukenut Flipkodin') }}  <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link"> {{ translateText($langtextarr, 'tietosuojaselosteen') }}</a> {{ translateText($langtextarr, 'ja') }} <a href="{{ route('frontend.terms') }}" class="custom-link"> {{ translateText($langtextarr, 'käyttöehdot') }}</a></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-bordered" type="submit">Liity</button>
                                </div>
                                <p id="response-text"></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-scripts')
<script>

    $('#marketplace-network').validate({ // initialize the plugin
        rules: {
            first_name: {required: true, maxlength: 50, alphanumeric: true },
            last_name: {required: true, maxlength: 50, alphanumeric: true  },
            email: {required: true, email: true},
            phone: { required: true,   minlength: 10, maxlength: 15 /*laxphone:true*/},
            terms: {required: true},
            housing_association: {maxlength: 100 },
            message: {maxlength: 1000 }
        },
        messages: {
            first_name: {required: 'Pakollinen tieto', maxlength:'Kirjoita korkeintaan 50 merkkiä.' , alphanumeric: 'Vain kirjaimet, numerot ja alaviivat'},
            last_name: {required: 'Pakollinen tieto', maxlength:'Kirjoita korkeintaan 50 merkkiä.', alphanumeric: 'Vain kirjaimet, numerot ja alaviivat'},
            email: {required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite'},
            phone: {required: 'Pakollinen tieto', number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
            terms: {required: 'Pakollinen tieto'},
            housing_association: { maxlength:'Kirjoita korkeintaan 100 merkkiä.'},
            message: { maxlength:'Kirjoita korkeintaan 1000 merkkiä.'}
        }

    });

    $('#marketplace-network').submit(function(){
        event.preventDefault();
        if($('#marketplace-network').valid() == true){
            var text = $('#marketplace-network button[type="submit"]').text();
            $('#marketplace-network button[type="submit"]').text(loadingText);
            $('#marketplace-network button[type="submit"]').attr('disabled','disabled');
            var url = $('#marketplace-network').attr('action');

             $.ajax({
                type: 'POST',
                url: url,
                data: $('#marketplace-network').serialize(),
                success:function(response){
                    $('#marketplace-network button[type="submit"]').text(text);
                    $('#marketplace-network button[type="submit"]').removeAttr('disabled');
                    //$('#response-text').html(response.success);
                    //showToastNotification('success', response.success);
                    window.location.href = "{{ route('frontend.kiitos') }}";
                },
                error:function(){
                    $('#marketplace-network button[type="submit"]').text(text);
                    $('#marketplace-network button[type="submit"]').removeAttr('disabled');
                    showToastNotification('error', errorText);
                }
            });
        }
    });
</script>
@endpush
