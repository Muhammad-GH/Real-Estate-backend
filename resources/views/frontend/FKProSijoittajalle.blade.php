@extends('frontend.layouts.app')

@section('title',__('meta_title_sijoittajalle'))
@section('meta_description', __('meta_description_sijoittajalle') )
@section('meta_image',   url('images/meta/coins.jpg')  )

@section('content')
<?php
    $langtextarr = Session::get('langtext');
?>
    <div class="banner">
        <div class="content">
            <img src="{{ url('images/coins.png') }}">
            <h1>
                <span>{{ translateText($langtextarr,'Parempaa tuottoa pääomallesi') }}</span>
            </h1>
        </div>
    </div>
    <section class="investor-section">
        <div class="container padding-50">
            <h2>{{ translateText($langtextarr,'Flipkoti auttaa pieniä ja isompia toimijoita sijoittamaan asuntoihin tuotot maksimoiden') }}</h2>
            <div class="gird">
                <div class="item">
                    <div class="card">
                        <h3>{{ translateText($langtextarr,'Asuntojen hankinta') }}</h3>
                        <i class="collapse-info"></i>
                        <div class="info">
                            <p>{{ translateText($langtextarr,'Flipkodin asiantuntijat ja verkosto etsivät asuntoja ympäri Suomen ja tulevaisuudessa myös kansainvälisesti. Teemme sijoituksia vain, jos itsekin sijoitamme. Näin haluamme osoittaa, että sijoitukset ovat huolella analysoituja ja me teemme sijoituksia vain, kun tiedämme, mitä olemme ostamassa ja mitä sijoituksella tullaan tekemään.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <h3>{{ translateText($langtextarr,'Selaa asuntoja') }}</h3>
                        <i class="collapse-info"></i>
                        <div class="info">
                            <p>{{ translateText($langtextarr,'Hankintapäätöstä tehdessä Flipkoti analysoi sijoituskohdetta teknisesti ja taloudellisesti. Ottaen huomioon alueellisen kehittymisen kuin myös tekniset riskit. Kun tekniset ja taloudelliset riskit on analysoitu ja kohde todettu kriteerit täyttäväksi, otamme kohteen alustaamme. Julkaisemme kohteen sijoittajillemme laskelmin ja suunnitelmin.Teemme sijoituksen, kun kohteeseen on löydetty halukkaat sijoittajat.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <h3>{{ translateText($langtextarr,'Investoi') }}</h3>
                        <i class="collapse-info"></i>
                        <div class="info">
                            <p>{{ translateText($langtextarr,'Voit ilmoittaa meille halukkuutesi joka ottamalla meihin yhteyttä tai liittymällä investoijalistalle. Se ei sido sinua mihinkään. Saat meidän kartoittamista kohteista tietoa sähköpostiisi, ja päätät itse haluatko sijoittaa vai et. Meillä on kohteita useilta paikkakunnilta, joten voit hajauttaa salkkuasi valitsemalla kohteita eri alueilta.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <h3>{{ translateText($langtextarr,'Nosta tuottosi') }}</h3>
                        <i class="collapse-info"></i>
                        <div class="info">
                            <p>{{ translateText($langtextarr,'Voit nostaa tuottosi välittömästi Flipkohteen myynnin jälkeen. Tai nostaa vuokratuotot esim kerran kuukaudessa. Sinä päätät tuottojesi käytöstä.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card">
                        <h3>{{ translateText($langtextarr,'Nosta sijoituksesi') }}</h3>
                        <i class="collapse-info"></i>
                        <div class="info">
                            <p>{{ translateText($langtextarr,'Sijoituksen kesto määritellään kohdekohtaisesti. Tavoittelemme sijoitusten nopeaa kiertoa ja tätä kautta korkeaa vuosittaista pääomantuottoa.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="investing-work">
        <div class="container">
            <h3>{{ translateText($langtextarr,'Miten sijoittaminen toimii ?') }}</h3>
            <div class="grid">
                <div class="item">
                    <i class="icon-home-search"></i>
                    <p>{{ translateText($langtextarr,'Analysoimme markkinoilla olevia ja meille tarjottuja kohteita.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-user-chart2"></i>
                    <p>{{ translateText($langtextarr,'Näytämme kannattavuus ja riskianalyysit läpäisseet kohteet sijoittajille.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-home-groth"></i>
                    <p>{{ translateText($langtextarr,'Ostamme korkean tuottopotentiaalin kohteen yhdessä sijoittajien kanssa.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-home-setting"></i>
                    <p>{{ translateText($langtextarr,'Remontoimme asunnon kustannustehokkaasti luotettavien yhteistyökumppaneiden kanssa.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-home-sale-rent"></i>
                    <p>{{ translateText($langtextarr,'Myymme tai vuokraamme kohteen.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-refresh2"></i>
                    <p>{{ translateText($langtextarr,'Saat pääomallesi tuottoa.') }}</p>
                </div>
                <div class="arrows">
                    <i class="icon-nextline"></i>
                    <i class="icon-nextline"></i>
                </div>
                <div class="arrows">
                    <i class="icon-nextline"></i>
                    <i class="icon-nextline"></i>
                </div>
            </div>
        </div>
    </section>
     <section class="presentation-rqst">
        <div class="container">
            <h2>{{ translateText($langtextarr,'Liity sijoittajalistalle') }}</h2>
            <p>{{ translateText($langtextarr,'Yrityksille ja yksityishenkilöille') }}</p>
            <div class="request-form">
                <form method="post" action="{{ route('frontend.professional-enquiry') }}" id="service-form">
                    @csrf
                     <input type="hidden" name="type" value="Investor" >
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
                                <input class="form-control" type="text" name="housing_association">
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
                                    <label for="frame1"><input type="radio" id="frame1" value="9-12" name="contact_time"> <span class="form-control">9-12</span></label>
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
    <script>
        $('#service-form').submit(function(){
            event.preventDefault();
            alert('asfasdf'); return false;
        });
    </script>
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
                        window.location.href = "{{ route('frontend.sijoittajalle-kiitos') }}";
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
