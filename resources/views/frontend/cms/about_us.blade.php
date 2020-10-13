@extends('frontend.layouts.app')

@section('title',__('meta_title_Meista'))
@section('meta_description', __('meta_description_Meista') )
@section('meta_image',   url('images/meta/your-home-bg.jpg')  )


@section('content')
  <?php
    $langtextarr = Session::get('langtext');
?>
    <div class="banner">
        <img class="d-none d-sm-block" src="{{ url('images/your-home-bg.jpg') }}">
        <img class="d-block d-sm-none" src="{{ url('images/home-mobi.jpg') }}">
        <div class="content">
            <h1>
                <span>{{ translateText($langtextarr,'Kotiasi varten') }}</span>
            </h1>
        </div>
    </div>
    <div class="container padding-60">
        <div class="home-info">
            <p>{{ translateText($langtextarr,'Flipkoti sai alkunsa unelmasta, missä asumisen ala muuttuisi aidosti asiakaslähtöiseksi. Sellaiseksi, jossa asunnon osto, remontointi ja myynti eivät aiheuttaisi päänsärkyä.') }}</p>
            <p>{{ translateText($langtextarr,'Yhdistimme alan ekosysteemin uudella tavalla, mikä tekee siitä läpinäkyvämmän, kustannustehokkaamman ja laadukkaamman.') }} </p>
            <p>{{ translateText($langtextarr,'Vuosien saatossa kehittyneet tuloksekkaat toimintatavat, teknologia ja tarkkaan valikoitu verkosto on nyt valjastettu palvelemaan Sinua.') }} </p>
            <p>{{ translateText($langtextarr,'Sinun kotiasi varten.') }}</p>
        </div>
    </div>
    <section class="home-grid">
        <div class="container padding-60">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ url('images/img14.jpg') }}">
                </div>
                <div class="col-md-6">
                    <div class="info">
                        <h3>{{ translateText($langtextarr,'Asunnon ostajalle') }}</h3>
                        <p>{{ translateText($langtextarr,'Flipkodin avulla voit löytää mieltymyksesi ja budjettisi mukaisen asunnon. Etsit sitten uutta unelmiesi kotia tai sijoitusasuntoa, me palvelemme yli 10 vuoden kokemuksella.') }}</p>
                        <a href="{{ route('frontend.sale') }}">{{ translateText($langtextarr,'Aloita ostaminen') }} <i class="icon-right-arrow-long"></i></a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ url('images/img15.jpg') }}">
                </div>
                <div class="col-md-6">
                    <div class="info">
                        <h3>{{ translateText($langtextarr,'Remontoijalle') }}</h3>
                        <p>{{ translateText($langtextarr,'Me hoidamme koko remonttiprosessin puolestasi. Laske remontille hinta-arvio remonttilaskurilla ja rentoudu. Kohta pääset nauttimaan unelmiesi kodista.') }} </p>
                        <a href="{{ route('frontend.renovation-calculator') }}">{{ translateText($langtextarr,'Aloita remontointi') }} <i class="icon-right-arrow-long"></i></a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ url('images/img16.jpg') }}">
                </div>
                <div class="col-md-6">
                    <div class="info">
                        <h3>{{ translateText($langtextarr,'Asunnon myyjälle') }}</h3>
                        <p>{{ translateText($langtextarr,'Asunnon myyjä saa maksimoitua asuntonsa arvon ja minimoitua myyntiajan, kun asunto flipataan ostajaehdokkaan tarpeisiin sopivaksi.') }}</p>
                        <a href="{{ route('frontend.sell') }}">{{ translateText($langtextarr,'Aloita myyminen') }} <i class="icon-right-arrow-long"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="services-section">
        <div class="container padding-40">
            <img class="services-logo" src="{{ url('images/flipkoti-pro.png') }}">
            <h2>{{ translateText($langtextarr,'Flipkoti ammattilaisille') }}</h2>
            <p>{{ translateText($langtextarr,'Flipkoti tarjoaa mahdollisuuksia, työkaluja ja laajan verkoston asumisen alan eri ammattilaisille. Halusitpa tarjota remonttipalvelua, sijoittaa kiinteistöihin tai laittaa taloyhtiön asiat kuntoon, meillä on tarjota hyviä ratkaisuja.') }}</p>
            <div class="gird">
                <div class="item">
                    <div class="image">
                        <img src="{{ url('images/img7.jpg') }}">
                    </div>
                    <div class="text">
                        <h3>{{ translateText($langtextarr,'Palveluntarjoajalle') }}</h3>
                        <p>{{ translateText($langtextarr,'Työt, materiaalit ja liiketoiminnan työkalut yhdestä paikasta.') }}</p>
                        <a href="{{ route('frontend.FKPro-Palveluntarjoajalle') }}">{{ translateText($langtextarr,'Lue lisää') }} <i class="icon-right-arrow-long"></i></a>
                    </div>
                </div>
                <div class="item">
                    <div class="image">
                        <img src="{{ url('images/img8.jpg') }}">
                    </div>
                    <div class="text">
                        <h3>{{ translateText($langtextarr,'Kiinteistöille & taloyhtiöille') }}</h3>
                        <p>{{ translateText($langtextarr,'Kustannustehokas digihallinto, remonttien, huollon ja ylläpidon kilpailutukset sekä paljon muuta. Ota kiinteistön ja taloyhtiön hoitodossa kanssamme digiloikka tähän päivään.') }}</p>
                        <a href="{{route('frontend.FKPro-kiinteistoille-taloyhtioille')}}">{{ translateText($langtextarr,'Lue lisää') }} <i class="icon-right-arrow-long"></i></a>
                    </div>
                </div>
                <div class="item">
                    <div class="image">
                        <img src="{{ url('images/img9.jpg') }}">
                    </div>
                    <div class="text">
                        <h3>{{ translateText($langtextarr,'Sijoittamassa asuntoihin') }}</h3>
                        <p>{{ translateText($langtextarr,'Uusi ja huoleton tapa sijoittaa asuntoihin. Saat pääomallesi loistavan vuosituoton verrattuna perinteiseen vuokratuottomalliin.') }}</p>
                        <a href="{{route('frontend.FK-Pro-Sijoittajalle')}}">{{ translateText($langtextarr,'Tutustu ratkaisuumme') }} <i class="icon-right-arrow-long"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- @lang('strings.frontend.welcome_to', ['place' => app_name()]) -->
@endsection
