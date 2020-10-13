@extends('frontend.layouts.app')

@section('title',__('meta_title_myy-meille'))
@section('meta_description', __('meta_description_myy-meille') )
@section('meta_image',   url('images/meta/selltous-bg.jpg')  )


@section('content')
<div class="banner">
        <img class="d-none d-sm-block" src="{{ url('images/selltous-bg.jpg') }}">
        <img class="d-block d-sm-none" src="{{ url('images/myy-meille-mobi.jpg') }}">
        <div class="content">
            <h1>
                <span>Myy asuntosi Flipkodille</span>
            </h1>
        </div>
    </div>
    <div class="container padding-60">
        <div class="home-info">
            <p class="text-center">Haluatko päästä asunnostasi nopeasti eroon?</p>
        </div>
    </div>
    <section class="about-section right-align">
        <div class="container padding-100">
            <div class="row gutters-60">
                <div class="col-lg-5">
                    <!-- <h2>Myy huonokuntoinen asuntosi suoraan meille. </h2> -->
                    <h2>Myy alkuperäiskuntoinen tai pintaremontin tarpeessa oleva asuntosi suoraan meille </h2>
                    <div class="info">
                        <!-- <p>Joskus elämäntilanne on sellainen, että asunnosta pitää päästä nopeasti eroon. Aina ei ole mahdollisuutta tai aikaa remontoida asuntoa ja odottaa asunnon myymistä yleisillä markkinoilla. </p> -->
                        <p>Joskus elämäntilanne on sellainen, että asunnosta pitää päästä nopeasti eroon. Aina ei ole mahdollisuutta tai aikaa remontoida asuntoa ja odottaa asunnon myymistä. Myy asuntosi suoraan meille ja säästä välityspalkkio itsellesi. </p>
                        <br>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="img-box">
                        <img src="{{ url('images/sell-to-us.jpg') }}">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container padding-100">
        <div class="about-full">
            <img src="{{ url('images/about-full.jpg') }}">
            <div class="content">
                <h2>Flipkoti tarjoaa avun erilaisiin tilanteisiin.</h2>
                <p>Myymällä asuntosi suoraan meille:</p>
                <ul class="list">
                    <li><i class="icon-list-arrow"></i>Säästät aikaa ja rahaa</li>
                    <li><i class="icon-list-arrow"></i>Et maksa korkeita välityspalkkioita</li>
                    <li><i class="icon-list-arrow"></i>Nopeat kaupat ja rahat tilille heti</li>
                    <li><i class="icon-list-arrow"></i>Voit myös asua asunnossa vuokraa vastaan</li>
                </ul>
            </div>
        </div>
    </div>
    <section class="find-location">
        <div class="container">
            <h2>Anna meille asuntosi tiedot ja vastaanota ehdotuksemme nopeasti.</h2>
            @php
                $formURL = route('frontend.sellus-form');
                if(isset($_COOKIE['asuntosi-type']) && $_COOKIE['asuntosi-type'] == 'PikaFlip'){
                    $formURL = route('frontend.pikaflip-lomake');
                }
            @endphp
            <form action="{{ $formURL }}" method="post">
                @csrf
                <label>Missä asuntosi sijaitsee?</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="postalCode" placeholder="Lisää sijainti tai postinumero" required>
                    <button class="btn btn-bordered" type="submit">Jatka</button>
                </div>
            </form>
        </div>
    </section>
@endsection