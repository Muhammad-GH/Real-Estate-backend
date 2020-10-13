@extends('frontend.layouts.others')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<?php
    $langtextarr = Session::get('langtext');
?>
	<section id="buybanner" class="investing-banner">
        <div class="container">
            <h1>{{ translateText($langtextarr,'Parempaa tuottoa pääomallesi') }}</h1>
        </div>
    </section>
    <section  class="left-tabs-1">
		<div class="container">
		    <div class="tabs-heading">
		        <h3>{{ translateText($langtextarr,'Asuntosijoittajaksi pääsee nyt pienellä pääomalla, hajautetulla riskillä, ilman huolta ja vaivannäköä asuntojen vuokrauksesta tai arvon kehityksestä.') }}</h3>
		        <p>{{ translateText($langtextarr,'Flipkoti auttaa pieniä ja isompia toimijoita sijoittamaan asuntoihin tuotot maksimoiden.') }}</p>
			</div>
		    <div class="tab">
		        <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">{{ translateText($langtextarr,'Asuntojen hankinta') }}</button>
                <button class="tablinks" onclick="openCity(event, 'Paris')">{{ translateText($langtextarr,'Selaa asuntoja') }}</button>
                <button class="tablinks" onclick="openCity(event, 'Tokyo')">{{ translateText($langtextarr,'Selaa asuntoja') }}</button>
                <button class="tablinks" onclick="openCity(event, 'Tokyo1')">{{ translateText($langtextarr,'Nosta tuottosi') }}</button>
                <button class="tablinks" onclick="openCity(event, 'Tokyo2')">{{ translateText($langtextarr,'Nosta sijoituksesi') }}</button>
		    </div>
		    <div id="London" class="tabcontent">
                <p>{{ translateText($langtextarr,'Flipkodin asiantuntijat ja verkosto etsivät asuntoja ympäri Suomen ja tulevaisuudessa myös kansainvälisesti. Teemme sijoituksia vain, jos itsekin sijoitamme. Näin haluamme osoittaa, että sijoitukset ovat huolella analysoituja ja me teemme sijoituksia vain, kun tiedämme, mitä olemme ostamassa ja mitä sijoituksella tullaan tekemään.') }}</p> 
                <!--p>@lang('strings.frontend.stationing.station_text_6') </p-->
		    </div>
		    <div id="Paris" class="tabcontent">
		        <p>{{ translateText($langtextarr,'Hankintapäätöstä tehdessä Flipkoti analysoi sijoituskohdetta teknisesti ja taloudellisesti. Ottaen huomioon alueellisen kehittymisen kuin myös tekniset riskit. Kun tekniset ja taloudelliset riskit on analysoitu ja kohde todettu kriteerit täyttäväksi, otamme kohteen alustaamme. Julkaisemme kohteen sijoittajillemme laskelmin ja suunnitelmin.Teemme sijoituksen, kun kohteeseen on löydetty halukkaat sijoittajat.') }}</p>
		    </div>
		    <div id="Tokyo" class="tabcontent">
		        <p>{{ translateText($langtextarr,'Voit ilmoittaa meille halukkuutesi joka ottamalla meihin yhteyttä tai liittymällä investoijalistalle. Se ei sido sinua mihinkään. Saat meidän kartoittamista kohteista tietoa sähköpostiisi, ja päätät itse haluatko sijoittaa vai et. Meillä on kohteita useilta paikkakunnilta, joten voit hajauttaa salkkuasi valitsemalla kohteita eri alueilta.') }}</p>
		    </div>
            <div id="Tokyo1" class="tabcontent">
                <p>{{ translateText($langtextarr,'Voit nostaa tuottosi välittömästi Flipkohteen myynnin jälkeen. Tai nostaa vuokratuotot esim kerran kuukaudessa. Sinä päätät tuottojesi käytöstä.') }}</p>
            </div>
            <div id="Tokyo2" class="tabcontent">
                <p>{{ translateText($langtextarr,'Sijoituksen kesto määritellään kohdekohtaisesti. Tavoittelemme sijoitusten nopeaa kiertoa ja tätä kautta korkeaa vuosittaista pääomantuottoa.') }}</p>
            </div>
        </div>
    </section>
    
    <section class="investorcontentblock">
            <div class="container">
                <div class="headersblock"><h3>{{ translateText($langtextarr,'Voit jättää halutessasi myös varasi (sijoitus ja tuotto) meidän hallinnoimalle tilille jatkosijoituksia varten, jolloin olet etusijalla uusien kohteiden sijoittajista.') }}</h3>

                <p class="para">{{ translateText($langtextarr,'Hankintapäätöstä tehdessä Flipkoti analysoi sijoituskohdetta teknisesti ja taloudellisesti. Otamme huomioon alueellisen kehittymisen kuin myös tekniset riskit. Kun tekniset ja taloudelliset riskit on analysoitu ja kohde todettu kriteerit täyttäväksi, otamme kohteen alustaamme. Julkaisemme kohteen sijoittajillemme laskelmin ja suunnitelmin.') }}</p>
                </div>

                

            </div>
        </section>

    @if(count($investProperty) > 0)
    <section class="slider-box">
		<h5 class="slide-h">{{ translateText($langtextarr,'Helppo tapa sijoittaa ja hajauttaa riskiä') }}</h5>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                @foreach($investProperty as $key => $property )
                    @php
                        $image = url('/img/frontend/slider_1img.png');
                        if(isset($property->investmentImage) && count($property->investmentImage) > 0 ){
                            $theImage = $property->investmentImage[0];
                            $image = url('/images/investProperty/'.$property->id.'/'.$theImage->name);
                        }
                    @endphp
                <div class="item <?php if($key == 0){ ?> active <?php } ?>">
                    <div class="img-slide">
                        <img src="{{ $image }}" alt="" style="width:100%;">
                        <div class="hosue-box">
                            <h3>{{ $property->title }}</h3>
                            <div >
                                <span>
                                    {{ $property->location }}
                                </span>
                                <span>
                                    {{ $property->appartment_type }}
                                </span>
                            </div>
                            <!-- <span class="bg-span">@lang('strings.frontend.stationing.residential')</span> -->
                            <span class="light-text">{{  (strlen($property->details) > 160 ? substr($property->details,0,160)."..." : $property->details) }}</span>
                            <div class="price-box_n">
                                <p class="left-p">€ {{ $property->invest_price }} <br><span>{{ translateText($langtextarr,'Sijoitettu') }}</span></p>
                                <p class="right-p">€ {{ $property->target_price }} <br><span>{{ translateText($langtextarr,'Target') }}</span></p>
                            </div>
                            @guest
                                <a class="investr-btn" href="{{ route('frontend.auth.login') }}"  >{{ translateText($langtextarr,'Katso lisätietoja') }}</a>
                            @else
                                <a class="investr-btn" href="{{ route('frontend.user.investment_view', $property->id) }}">
                                {{ translateText($langtextarr,'Katso lisätietoja') }}</a>
                            @endguest 
                            
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">{{ translateText($langtextarr,'Edellinen') }}</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">{{ translateText($langtextarr,'Edellinen') }}</span>
            </a>
        </div>
		
		<div class="slide-bottom">
		    <p>{{ translateText($langtextarr,'Katso sijoituskohteemme tai tilaa maksuton viikottainen uutiskirjeemme sähköpostiin.') }}</span></p>
		    <a href="{{ route('frontend.investment_case') }}" >{{ translateText($langtextarr,'KATSO KAIKKI KOHTEET') }}</a>
		</div>
    </section>
    @endif
    <section class="works">
        <div class="container">
            <h3>{{ translateText($langtextarr,'Miten sijoittaminen toimii ?') }}</h3>
            <div class="img-boxes left-s">
                <div class="img-boxes left-n">
                    <img src="{{url('/img/frontend/how_1.png')}}">
                    <span>{{ translateText($langtextarr,'Analysoimme markkinoilla olevia ja meille tarjottuja kohteita.') }}</span>
                </div>
            </div>
            <div class="img-boxes right-s">
                <div class="img-boxes right-n">
                    <span>{{ translateText($langtextarr,'Näytämme kannattavuus ja riskianalyysit läpäisseet kohteet sijoittajille.') }}</span>
                    <img src="{{url('/img/frontend/how_2.png')}}">
                </div>
            </div>
            <div class="img-boxes left-s">
                <div class="img-boxes left-n">
                    <img src="{{url('/img/frontend/how_3.png')}}">
                    <span>{{ translateText($langtextarr,'Ostamme korkean tuottopotentiaalin kohteen yhdessä sijoittajien kanssa.') }}</span>
                </div>
            </div>
            <div class="img-boxes right-s">
                <div class="img-boxes right-n">
                    <span>{{ translateText($langtextarr,'Remontoimme asunnon kustannustehokkaasti luotettavien yhteistyökumppaneiden kanssa.') }}</span>
                    <img src="{{url('/img/frontend/how_4.png')}}">
                </div>
            </div>
            <div class="img-boxes left-s">
                <div class="img-boxes left-n">
                    <img src="{{url('/img/frontend/how_5.png')}}">
                    <span>{{ translateText($langtextarr,'Myymme tai vuokraamme kohteen.') }}</span>
                </div>
            </div>
            <div class="img-boxes right-s">
                <div class="img-boxes right-n">
                    <span>{{ translateText($langtextarr,'Saat pääomallesi tuottoa.') }}</span>
                    <img src="{{url('/img/frontend/how_6.png')}}">
                </div>
            </div>
        </div>

        <div class="tabs-heading summeryhead">
          <h3>{{ translateText($langtextarr,'Huolehdimme sijoituksestasi, kuten omista.') }}</h3>
            </div>


    </section>
    <section class="work-bottm">
        <div class="container">
            <div class="work-btm-left">
                <h3>{{ translateText($langtextarr,'Tehokkaiden prosessien avulla tavoittelemme yli 30% pääoman vuosittaista tuottoa.') }}</h3>
            </div>
            <div class="work-btm-right">
                <a href="#" data-toggle="modal" data-target="#contactmodel">{{ translateText($langtextarr,'Liity sijoittajalistalle') }}</a>
            </div>
        </div>
    </section>

<!-- ContactModel -->
<div class="modal fade" id="contactmodel" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				{{ html()->form('POST', route('frontend.stationing'))->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->id('contactform')->open() }}
				<input type="text" value="contact" name="type" class="form-control left " style="display:none" >
				<div class="form-group width-50">
					<label for="name">{{ translateText($langtextarr,'Nimi') }}</label>
					<input type="text" name="name" class="form-control left" >
				</div>
				<div class="form-group width-50">
					<label for="phone">{{ translateText($langtextarr,'Puhelinnumero') }}</label>
					<input type="text" name="phone" class="form-control left" >
				</div>
				<div class="form-group width-100">
					<label for="email">{{ translateText($langtextarr,'Sähköposti') }}</label>
					<input type="email" name="email" class="form-control left" >
				</div>
				<h4 class="border-h">{{ translateText($langtextarr,'Yhteydenotto') }}</h4>
                <input type="hidden" name="subject" value="Yhteydenottolomake">
				{{--<div class="form-group width-100">
					<label for="subject">{{ translateText($langtextarr,'Aihe') }}</label>
					<select class="form-control"  name="subject" id="sel1" placeholder="Searching real estate investment cases">
                        <option value="Haluan saada sijoittajaviestit säahköpostiini">{{ translateText($langtextarr,'Haluan saada sijoittajaviestit säahköpostiini') }}</option>
                        <option value="Haluan tehdä investoinnin heti avoinna olevaan kohteeseen">{{ translateText($langtextarr,'Haluan tehdä investoinnin heti avoinna olevaan kohteeseen') }}</option>
						<!-- <option value="Haluan lisätietoa Flipkoti toimintaperiaatteista" >Haluan lisätietoa Flipkoti toimintaperiaatteista.</option>
						<option value="Haluan liittyä verkostoon palvelun tarjoajana" >Haluan liittyä verkostoon palvelun tarjoajana</option>
						<option value="Haluan tarjota huoneistoa tai kiinteistöä Flipkodille" >Haluan tarjota huoneistoa tai kiinteistöä Flipkodille</option>
						<option value="Haluan tehdä +50000€ kertainvestoinnin vauhdittaakseni tuottojen saamista" >Haluan tehdä +50000€ kertainvestoinnin vauhdittaakseni tuottojen saamista</option>
						<option value="Muu" >Muu</option> -->
					</select>
				</div>--}}
				<div class="form-group width-100">
					<label for="message">{{ translateText($langtextarr,'Viesti') }}</label>
					<textarea  name="message" class="form-control text-area" rows="5" id="comment"></textarea>
				</div>
				<button type="submit" class="btn-sbmt" >{{ translateText($langtextarr,'Lähetä') }}</button>
				{{ html()->form()->close() }}
			</div>
		</div>
	</div>
</div>
<!-- @lang('strings.frontend.welcome_to', ['place' => app_name()]) -->
@endsection

@push('after-scripts')
<script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();

    $(document).ready(function () {
        /*$.validator.addMethod("laxphone", function(value, element) {
            return this.optional( element ) || /^\+|0(?:[0-9] ?){6,14}[0-9]$/.test( value );
        }, 'Anna voimassa oleva yhteysnumero');*/
        $('#contactform').validate({ // initialize the plugin
            rules: {
                name: { required: true },
                email: { required: true, email: true },
                phone: { required: true,   minlength: 10, maxlength: 15 /*laxphone:true*/},
                subject: { required: true },
                message: { required: true }
            },
            messages: {
                name: { required: 'Pakollinen tieto' },
                email: { required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite' },
                phone: { required: 'Pakollinen tieto',number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
                subject: { required: 'Pakollinen tieto' },
                message: { required: 'Pakollinen tieto' }
            }
        });
    
    });
</script>
@endpush
<!-- @lang('strings.frontend.home.know_value') -->