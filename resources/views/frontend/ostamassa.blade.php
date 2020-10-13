@extends('frontend.layouts.app')

@section('title',__('meta_title_ostamassa'))
@section('meta_description', __('meta_description_ostamassa') )
@section('meta_image',   url('images/meta/buying-bg.jpg')  )

@section('content')
<?php
    $langtextarr = Session::get('langtext');
?>
<div class="banner">
        <img class="d-none d-sm-block" src="{{ url('images/buying-bg.jpg') }}">
        <img class="d-block d-sm-none" src="{{ url('images/ostamassa-mobi.jpg') }}">
        <div class="content">
            <h1>
                <span>Löydä unelmiesi asunto</span>
            </h1>
        </div>
    </div>
    <div class="container padding-60">
        <div class="home-info">
            <p class="text-center">Ongelmia löytää asunto oikealla sijainnilla ja vaatimuksilla?<br> Asunnon kunto ja budjettisi eivät kohtaa?</p>
        </div>
    </div>
    <section class="about-section buying right-align">
        <div class="container padding-100">
            <div class="row gutters-60">
                <div class="col-lg-5">
                    <h2>Flipkodin avulla voit löytää asunnon, josta muokkaat unelmiesi kodin </h2>
                    <div class="info">
                        <p>Kerro meille tulevan kotisi vaatimukset, niin me etsimme puolestasi mieltymyksiisi ja budjettiisi sopivan ratkaisun. Aloita etsintä sivun alalaidasta. Jos olet jo löytänyt joitakin vaihtoehtoja, voit myös linkata ne meille analysoitavaksi. Palvelu on luottamuksellinen ja sinulle täysin maksuton. </p>
                        <p>Meillä on yli 10 vuoden kokemus muokata tarjolla olevista asunnoista asiakkaan elämäntilanteeseen sopiva koti. Etsitään sinulle koti jossa viihdyt, koti joka on taloudellisesti järkevä!</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="img-box">
                        <img src="{{ url('images/buying.jpg') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="investing-work howtoRenovate">
        <div class="container">
            <h3>Näin löydät unelmiesi asunnon</h3>
            <div class="grid">
                <div class="item">
                    <i class="icon-display-cart"></i>
                    <p>Täytä asuntokriteerit alla olevaan lomakkeeseen ja jätä anonyymi osto-ilmoitus. </p>
                </div>
                <div class="item">
                    <i class="icon-hand-chat"></i>
                    <p>Pyydämme tarvittaessa tarkentavia kysymyksiä.</p>
                </div>
                <div class="item">
                    <i class="icon-chart-search"></i>
                    <p>Analysoimme pyyntösi ja etsimme kriteerit täyttäviä asuntoja. </p>
                </div>
                <div class="item">
                    <i class="icon-sales-price"></i>
                    <p>Esittelemme flip -potentiaalit sekä valmiiksi kriteerejäsi vastaavat kohteet.</p>
                </div>
                <div class="item">
                    <i class="icon-refresh2"></i>
                    <p>Teemme ostotoimeksianto-sopimuksen. Maksat palkkion ainoastaan, mikäli ostat asunnon kauttamme.</p>
                </div>
                <div class="item">
                    <i class="icon-lovely-home"></i>
                    <p>Muuta unelmiesi kotiin!</p>
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
    <section class="find-location">
        <div class="container">
            <h2>Laadimme sopimuksen. Maksat meille palkkion ainoastaan, mikäli löydät haluamasi asunnon kauttamme ja teet kaupat</h2>
            <form>
                <label>Missä haluaisit asua?</label>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Lisää sijainti tai postinumero">
                    <button class="btn btn-bordered" type="submit">Jatka</button>
                </div>
            </form>
        </div>
    </section>
@endsection