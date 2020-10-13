@extends('frontend.layouts.app')

@section('title',__('meta_title_palveluntarjoajalle'))
@section('meta_description', __('meta_description_palveluntarjoajalle') )
@section('meta_image',   url('images/meta/banner-service-provider.jpg')  )

@section('content')

<?php
    $langtextarr = Session::get('langtext');
?>
<div class="banner">
        <img class="d-none d-sm-block" src="{{ url('images/banner-service-provider.jpg') }}">
        <img class="d-block d-sm-none" src="{{ url('images/palveluntarjoajalle-mobi.jpg') }}">
        <div class="content">
            <img src="{{ url('images/flipkoti-pro-wt.png') }}">
            <h1>
                <span>{{ translateText($langtextarr,'Työt, materiaalit ja työkalut') }}</span><br>
                <span>{{ translateText($langtextarr,'Palveluntarjoajalle') }}</span>
            </h1>
        </div>
    </div>
    <section class="service-provider">
        <div class="container padding-30">
            <div class="row">
                <div class="col-lg-5">
                    <div class="job-img">
                        <img src="images/jobs.jpg">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="content">
                        <h2>{{ translateText($langtextarr,'Työt') }}</h2>
                        <p>{{ translateText($langtextarr,'Flipkoti Pro luottourakoitsijana saat isoja ja pienempiä rakennus- ja remontointiprojekteja Suomen suurimpien kaupunkien alueelta.') }}</p>
                        <ul>
                            <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Työt ilman markkinointi- ja myyntiponnisteluja.') }}</li>
                            <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Yhtenäiset toimintatavat ja hiotut prosessit läpi arvoketjun.') }}</li>
                            <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Tyytyväinen loppuasiakas: ei reklamaatioita, ei hukkuneita dokumentteja, ei arvuuttelua eikä alalle tyypillisiä mysteerejä.') }}</li>
                            <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Ole osana kehittämässä toimialaa avoimempaan, tuottavampaan ja laadukkaampaan suuntaan.') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="tool-img">
                        <img src="images/business-tools.png">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="content">
                        <h2>{{ translateText($langtextarr,'Liiketoiminnan työkalut') }}</h2>
                        <p>{{ translateText($langtextarr,'Flipkoti Pro on rakennus- ja remontointiliiketoimintaan suunniteltu toiminnanohjaustyökalu. Sen avulla pystyt helposti hoitamaan liiketoiminnan ydintoiminnnot tarjouksen teosta laskutukseen ja kirjanpitoon saakka. Ajasta, paikasta ja päätelaitteesta riippumatta.') }}</p>
                        <ul>
                            <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Vastaanota tarjouspyynnöt ja anna tarjoukset koostetusti') }}</li>
                            <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Luo, solmi ja arkistoi sopimukset') }}</li>
                            <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Suunnittele ja johda projektit sekä resurssit') }}</li>
                            <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Kommunikoi ja pidä ajan tasalla kumppanit sekä asiakkaat kätevästi yhdessä paikassa') }}</li>
                            <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Laskuta projektit') }}</li>
                            <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Liitäntä taloushallintajärjestelmään - hoida liiketoiminnan kirjanpito vaivattomasti') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="building-materials">
        <div class="container">
            <h2>{{ translateText($langtextarr,'Rakennusmateriaalit') }}</h2>
            <p>{{ translateText($langtextarr,'Flipkoti Pro:ssa on keskitetty hankinta- ja maahantuontikanava valikoiduille rakennusmateriaaleille.') }}</p>
            <div class="content">
                <div class="row gutters-120 align-items-center">
                    <div class="col-lg-6">
                        <ul class="list">
                           <li>{{ translateText($langtextarr,'Paranna projektiesi kannattavuutta hankkimalla materiaalit yhdessä edullisemmin') }}</li>
                           <li>{{ translateText($langtextarr,'Erottaudu ja kasvata kilpailukykyä täsmällisillä materiaalitoimituksilla') }}</li>
                           <li>{{ translateText($langtextarr,'Jatkuvasti kasvava tuotevalikoima suoraan globaaleista lähteistä') }}</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="products">
                            <div  class="item logo">
                                <img src="{{ url('images/pro-logo.png') }}">
                            </div>
                            <div  class="item">
                                <a href="{{ route('frontend.marketplace.index') }}">
                                    <img src="{{ url('images/product1.jpg') }}">
                                    <p>{{ translateText($langtextarr,'Lattiat') }}</p>
                                </a>
                            </div>
                            <div  class="item">
                                <a href="{{ route('frontend.marketplace.index') }}">
                                    <img src="{{ url('images/product2.jpg') }}">
                                    <p>{{ translateText($langtextarr,'Luonnokivet') }}</p>
                                </a>
                            </div>
                            <div  class="item">
                                <a href="{{ route('frontend.marketplace.index') }}">
                                    <img src="{{ url('images/product3.jpg') }}">
                                    <p>{{ translateText($langtextarr,'Muut') }}</p>
                                </a>
                            </div>
                            <div  class="item">
                                <a href="{{ route('frontend.marketplace.index') }}">
                                    <img src="{{ url('images/product4.jpg') }}">
                                    <p>{{ translateText($langtextarr,'Kattotuotteet') }}</p>
                                </a>
                            </div>
                            <div  class="item">
                                <a href="{{ route('frontend.marketplace.index') }}">
                                    <img src="{{ url('images/product5.jpg') }}">
                                    <p style="font-size: 13px;">{{ translateText($langtextarr,'Julkisivumateriaalit') }}</p>
                                </a>
                            </div>
                            <div  class="item">
                                <a href="{{ route('frontend.marketplace.index') }}">
                                    <img src="{{ url('images/product6.jpg') }}">
                                    <p>{{ translateText($langtextarr,'Laatat') }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="network container" style="background-image:url('images/network-bg.png');">
        <div class="content">
            <h2>{{ translateText($langtextarr,'Asiantuntijaverkosto') }}</h2>
            <p>{{ translateText($langtextarr,'Flipkoti Pro:n kasvavasta ja valikoidusta asiantuntijaverkostosta löydät tilanteeseen kuin tilanteeseen tarvittavan avun.') }}</p>
            <ul>
                <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Sisustussuunnittelijat') }}</li>
                <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Lakimiehet') }}</li>
                <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Rakennusinsinöörit') }}</li>
                <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Kiinteistönvälittäjät') }}</li>
                <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Arkkitehdit') }}</li>
                <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Freelancerit') }}</li>
                <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Valvojat') }}</li>
                <li><i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Muut asiantuntijat') }}</li>
            </ul>
        </div>
    </section>
    <section class="service-info">
        <div class="container">
            <h2>{{ translateText($langtextarr,'Tehdään asumisen alasta aidosti asiakaslähtöinen') }}</h2>
            <ul>
                <li><i class="icon-list-arrow"></i>{{ translateText($langtextarr,'Loppuasiakkaan on aika olla liiketoiminnan keskiössä.') }}</li>
                <li><i class="icon-list-arrow"></i>{{ translateText($langtextarr,'Uudet toimintatavat ja teknologia mahdollistavat sen ilman, että liiketoiminta kärsii.') }}</li>
                <li><i class="icon-list-arrow"></i>{{ translateText($langtextarr,'Ei reklamaatioita, ei yllätyksiä vaan ammattimaista ja kannattavaa toimintaa.') }}</li>
            </ul>
        </div>
    </section>
    <section class="presentation-rqst">
        <div class="container">
            <h2>{{ translateText($langtextarr,'Liity palveluntarjoajaksi') }}</h2>
            <p>{{ translateText($langtextarr,'Yrityksille ja kevytyrittäjille') }}</p>
            <div class="request-form">
                <form method="post" action="{{ route('frontend.professional-enquiry') }}" id="service-form">
                    @csrf
                     <input type="hidden" name="type" value="service provider" >
                    <div class="row gutters-24">
                        <div class="col-lg-6">
                            <div class="row gutters-16">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ translateText($langtextarr,'Etunimi') }}</label>
                                        <input class="form-control" type="text" name="first_name"  required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ translateText($langtextarr,'Sukunimi') }}</label>
                                        <input class="form-control" type="text" name="last_name"  required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ translateText($langtextarr,'Sähköposti') }}</label>
                                <input class="form-control" type="email" name="email"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ translateText($langtextarr,'Puhelinnumero') }}</label>
                                <input class="form-control" type="text" name="phone"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ translateText($langtextarr,'Yrityksen nimi') }}</label>
                                <input class="form-control" type="text" name="housing_association"  required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ translateText($langtextarr,'Haluttu yhteydenottotapa') }}</label>
                                <div class="radio">
                                    <label for="radio1"><input type="radio" id="radio1" name="contact_method" checked value="phone"><span class="checkmark"></span>{{ translateText($langtextarr,'Puhelin') }}</label>
                                    <label for="radio2"><input type="radio" id="radio2" name="contact_method" value="email"><span class="checkmark"></span>{{ translateText($langtextarr,'Sähköposti') }}</label>
                                    <label for="radio3"><input type="radio" id="radio3" name="contact_method" value="both"><span class="checkmark"></span>{{ translateText($langtextarr,'Molemmat') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{ translateText($langtextarr,'Paras aika tavoitella') }}</label>
                                <div class="time-selecter">
                                    <label for="frame1"><input type="radio" id="frame1" name="contact_time" value="9-12"> <span class="form-control">9-12</span></label>
                                    <label for="frame2"><input type="radio" id="frame2" value="12-15" name="contact_time"> <span class="form-control">12-15</span></label>
                                    <label for="frame3"><input type="radio" id="frame3" value="15-18" name="contact_time" checked> <span class="form-control">15-18</span></label>
                                    <label for="frame4"><input type="radio" id="frame4" value="18-21" name="contact_time"> <span class="form-control">18-21</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>{{ translateText($langtextarr,'Viesti') }}</label>
                                <textarea class="form-control" name="message" ></textarea>
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
                            <button class="btn btn-bordered" type="submit">{{ translateText($langtextarr,'Lähetä') }}</button>
                        </div>
                        <p id="response-text"></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@push('after-scripts')
<script>
    $('#service-form').submit(function(){
            event.preventDefault();
            var text = $('#service-form button[type="submit"]').text();
            $('#service-form button[type="submit"]').text(loadingText);
            if($('#service-form').valid() == true){
                var url = $('#service-form').attr('action');
                 $.ajax({
                    type: 'POST',
                    url: url,
                    data: $('#service-form').serialize(),
                    success:function(response){
                        $('#response-text').html(response.success);
                        $('#service-form button[type="submit"]').text(text);
                        window.location.href = "{{ route('frontend.palveluntarjoajalle-kiitos') }}";
                    },
                    error:function(){
                        $('#response-text').html(errorText);
                        showToastNotification('error', "{{__('Something went wrong.')}}");
                    }
                });
            }
        });
</script>
@endpush
