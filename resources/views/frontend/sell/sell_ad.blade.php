@extends('frontend.layouts.app')

@section('title',__('meta_title_myy-kiinteistosi'))
@section('meta_description', __('meta_description_myy-kiinteistosi') )
@section('meta_image',   url('images/meta/sell-property-bg.jpg')  )

@section('content')
	<!-- <section id="buybanner" class="selling-banner selling-bannerin">
		<div class="container">
  		    <h1>Myy asuntosi Flipkodille</h1>
 		</div>
	</section> -->
	<?php
        $langtextarr = Session::get('langtext');
    ?>
	 <div class="banner">
        <img class="d-none d-sm-block" src="{{ url('images/sell-property-bg.jpg') }}">
        <img class="d-block d-sm-none" src="{{ url('images/myy-kiinteistosi-mobi.jpg') }}">
        <div class="content">
            <h1>
                <span>Myy kiinteistösi meille</span><br>
                <span>tai flippaa se kanssamme</span>
            </h1>
        </div>
    </div>
    <div class="container padding-60">
        <div class="home-info">
            <p class="text-center">Haluatko irroittaa pääomasi kiinteistöstä? Meillä on ratkaisut erilaisiin tilanteisiin.</p>
        </div>
    </div>
    <section class="about-section">
        <div class="container padding-100">
            <div class="row gutters-60">
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="{{ url('images/about-property.jpg') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2>Myy kiinteistösi nopeasti tai maksimoi sen tuottopotentiaali meidän kanssamme.</h2>
                    <div class="info">
                        <p>Onko sinulla salkussasi kiinteistö, josta haluaisit päästä pian eroon?</p>
                        <p>Vai haluatko maksimoida kiinteistön myyntivoiton, mutta kiinnostusta, aikaa tai pääomaa koko kiinteistön kehitysprojektiin ei ole?</p>
                        <p>Meillä on ratkaisut molempiin tilanteisiin.</p>
                        <p>Voit joko myydä kiinteistösi suoraan meille tai flipata kiinteistön kanssamme.</p>
                        <a href="{{ route('frontend.sell-ad-form') }}" class="btn btn-primary">ANNA KIINTEISTÖSI TIEDOT </a>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="investing-work flip-property">
        <div class="container">
            <h3>Näin flippaat kiinteistösi kanssamme</h3>
            <div class="grid">
                <div class="item">
                    <i class="icon-home-search"></i>
                    <p>Anna kiinteistösi tiedot meille arvioitavaksi alla olevalla lomakkeella.</p>
                </div>
                <div class="item">
                    <i class="icon-user-chart2"></i>
                    <p>Analysoimme kiinteistösi tiedot ja arvioimme flippauspotentiaalin.</p>
                </div>
                <div class="item">
                    <i class="icon-home-groth"></i>
                    <p>Tavataan jos kiinteistössä on potentiaalia. Sovitaan Flippauksen yksityiskohdista. </p>
                </div>
                <div class="item">
                    <i class="icon-home-setting"></i>
                    <p>Remontointi suunnitelman mukaan, Flipkoti ottaa täyden vastuun remontista, markkinoinnista ja myynnistä. Sinä voit ottaa rennosti.</p>
                </div>
                <div class="item">
                    <i class="icon-home-sale-rent"></i>
                    <p>Myymme flipatun kiinteistösi parhaille ostajalle ja jaamme kanssasi tuotot 50/50.</p>
                </div>
                <div class="item">
                    <i class="icon-refresh2"></i>
                    <p>Teit juuri hyvät voitot kiinteistölläsi ja sait pääomasi irti kokonaisuudessaan!</p>
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
            <h2>Tarjoa kiinteistöäsi tai flippaa se kanssamme</h2>
            <form method="post" action="{{ route('frontend.sell-ad-form') }}">
                @csrf
                <label>Missä kiinteistösi sijaitsee?</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="postalCode" placeholder="Lisää sijainti tai postinumero">
                    <button class="btn btn-bordered" type="submit">Jatka</button>
                </div>
            </form>
        </div>
    </section>
   
   <!-- @lang('strings.frontend.welcome_to', ['place' => app_name()]) -->
@endsection
<!-- @lang('strings.frontend.home.know_value') -->
