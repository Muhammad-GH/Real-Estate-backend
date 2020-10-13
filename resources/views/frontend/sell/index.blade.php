@extends('frontend.layouts.app')

@section('title',__('meta_title_myy-asuntosi'))
@section('meta_description', __('meta_description_myy-asuntosi') )
@section('meta_image',   url('images/meta/sell-apartment-bg.jpg')  )

@section('content')
<?php
    $langtextarr = Session::get('langtext');
?>
    <div class="banner">
        <img class="d-none d-sm-block" src="{{ url('images/sell-apartment-bg.jpg') }}">
        <img class="d-block d-sm-none" src="{{ url('images/myy-asuntosi-mobi.jpg') }}">
        <div class="content">
            <h1>
                <span>{{ translateText($langtextarr,'Myy asuntosi helposti') }}</span><br>
                <span>{{ translateText($langtextarr,'remontoituna tai sellaisenaan') }}</span>
            </h1>
        </div>
    </div>
    <div class="container padding-60">
        <div class="home-info">
            <p class="text-center">{{ translateText($langtextarr,'Ongelmia asunnon myynnissä? Me tarjoamme ratkaisut erilaisiin tilanteisiin.') }}  </p>
        </div>
    </div>
     <section class="about-section">
        <div class="container padding-100">
            <div class="row gutters-60">
                <div class="col-lg-6">
                    <div class="img-box">
                        <img src="{{ url('images/sell-apartment.jpg') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2>{{ translateText($langtextarr,'Tutustu joustaviin Flip-paketteihin.') }}</h2>
                    <div class="info">
                        <p>{{ translateText($langtextarr,'Oletko koskaan miettinyt, että asuntosi arvo voisi olla jotakin ihan muuta ammattimaisesti remontoituna ja markkinoituna? Et kenties ole tarkalleen tiennyt miten remontti ja markkinointi kannattaisi tehdä, jotta saisit asunnostasi parhaan tuoton.') }}</p>
                        <p>{{ translateText($langtextarr,'Moni suomalainen istuu kultakimpaleen päällä tietämättään – ja luopuu siitä tietämättään.') }}</p>
                        <p>{{ translateText($langtextarr,'Me Flipkodilla olemme tehneet asuntokauppaa flippaamalla, eli osta-remontoi-myy -mallilla, jo yli 10 vuotta ja tiedämme sen mahdollisuudet. Järkevästi toteutettu remontti useimmiten kannattaa vastoin alan yleistä käsitystä.') }}</p>
                        <p>{{ translateText($langtextarr,'Nyt olemme organisoineet toimintatapamme helposti ostettaviksi paketeiksi, jonka avulla sinä voit maksimoida asuntosi arvon erilaisissa myyntitilanteissa. Voit myös myydä asuntosi suoraan meille, jos tavoitteenasi on nopeat kaupat.') }}</p>
                        <p>{{ translateText($langtextarr,'Olipa tilanteesi mikä hyvänsä, Flipkoti auttaa löytämään parhaan ratkaisun.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--<section class="service-packages">
        <div class="container padding-60">
            <div class="packages-details">
                <div class="row gutters-120">
                    <div class="col-lg-6">
                        <div class="card dark-blue">
                            <div class="card-header">
                                <h3>RÄÄTÄLÖI FLIPPAUS</h3>
                                <p>PYYDÄ RÄÄTÄLÖITY TARJOUS </p>
                            </div>
                            <div class="card-body">
                                <p>Räätälöi tilanteeseesi sopiva palvelukokonaisuus. Sopii hyvin esimerkiksi kodin omistajalle, joka haluaa säästää välityspalkkioissa, haluaa selvittää asunnon arvopotentiaalin tai haluaa remontoida asunnon myyväksi kustannustehokkaasti.</p>
                                <ul>
                                    <li><i class="icon-list-arrow"></i>Asunnon pohjakuvat</li>
                                    <li><i class="icon-list-arrow"></i>Stailaus ja valokuvaus</li>
                                    <li><i class="icon-list-arrow"></i>3D kuvat ja virtuaalikierrokset</li>
                                    <li><i class="icon-list-arrow"></i>Etuovi ja Oikotie -ilmoitukset</li>
                                    <li><i class="icon-list-arrow"></i>Asuntokaupan dokumentit: huoneistomyyntiesite, ostotarjouskaavake ja kauppakirjapohja</li>
                                    <li><i class="icon-list-arrow"></i>Sisustussuunnittelu</li>
                                    <li><i class="icon-list-arrow"></i>Materiaalien ja urakoitsijoiden kilpailutus remonttiin</li>
                                    <li><i class="icon-list-arrow"></i>Digi projektinjohtopalvelu</li>
                                    <li><i class="icon-list-arrow"></i>LKV konsultaatiota tarpeen mukaan</li>
                                    <li><i class="icon-list-arrow"></i>Lakimiespalvelut</li>
                                </ul>
                                <div class="buttons">
                                    <!--a href="#" data-toggle="modal" attr-plan="basic" data-target="#contactmodel" class="btn btn-dblue contactmodel-btn">{{ translateText($langtextarr,'Lakimiespalvelut') }}</a-->
                                    <a href="{{ route('frontend.sellus-form') }}"  class="btn btn-dblue contactmodel-btn">VALITSE </a>
                
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card light-blue">
                            <div class="card-header">
                                <h3>{{ translateText($langtextarr,'Flippaa asuntosi kanssamme') }}</h3>
                                <p>{{ translateText($langtextarr,'Jaetaan myyntivoitt') }} 50/50</p>
                            </div>
                            <div class="card-body">
                                <p>{{ translateText($langtextarr,'Maksimoi asuntosi tuotto helposti meidan kanssamme. hoidamme kaiken puolestasiaina remontin suunnittelusta asunnon myyntiin asti. Kannamme flippauksesta taloudellisen reskin. Vain valikoituihin asuntoihin.') }}</p>
                                <ul>
                                   <li><i class="icon-list-arrow"></i>{{ translateText($langtextarr,'Sisustussuunnittelu') }}</li>
                                   <li><i class="icon-list-arrow"></i>{{ translateText($langtextarr,'3D suunnitelmat ja myyntikuvat') }}</li>
                                   <li><i class="icon-list-arrow"></i>{{ translateText($langtextarr,'Materiaalien kilpailutus ja valinta') }}</li>
                                   <li><i class="icon-list-arrow"></i>{{ translateText($langtextarr,'Urakoitsijoiden kilpailutus ja valinta') }}</li>
                                   <li><i class="icon-list-arrow"></i>{{ translateText($langtextarr,'Sitovat sopimukset tai esisopimukset') }}</li>
                                   <li><i class="icon-list-arrow"></i>{{ translateText($langtextarr,'Remontin johtaminen, toteutus ja dokumentointi') }}</li>
                                   <li><i class="icon-list-arrow"></i>{{ translateText($langtextarr,'Asunnon myynti ja markkinointi') }}</li>
                                </ul>
                                <div class="buttons">
                                    <a href="{{ route('frontend.flip-calculator') }}"  class="btn btn-lblue contactmodel-btn">{{ translateText($langtextarr,'Selvita asuntosi potentiaali') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>--}}
    <div class="container text-center mt-5">
        <h2>Flippaus- ja myyntipalvelut asunnon omistajille</h2>
    </div>
    <section class="lkv-services">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item tabs-heading" role="presentation">
                    <a class="nav-link clr-2 active" id="maxiflip-tab" data-toggle="tab" href="#maxiflip" role="tab" aria-controls="maxiflip" aria-selected="false">MaxiFlip</a>
                </li>
                <li class="nav-item tabs-heading" role="presentation">
                    <a class="nav-link clr-1 " id="pikaflip-tab" data-toggle="tab" href="#pikaflip" role="tab" aria-controls="pikaflip" aria-selected="true">PikaFlip</a>
                </li>
                <!-- <li class="nav-item tabs-heading" role="presentation">
                    <a class="nav-link clr-3" id="lkvflip-tab" data-toggle="tab" href="#lkvflip" role="tab" aria-controls="lkvflip" aria-selected="false">LKVFlip</a>
                </li>
                <li class="nav-item tabs-heading" role="presentation">
                    <a class="nav-link clr-4" id="omaflip-tab" data-toggle="tab" href="#omaflip" role="tab" aria-controls="omaflip" aria-selected="false">OmaFlip</a>
                </li> -->
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade " id="pikaflip" role="tabpanel" aria-labelledby="pikaflip-tab">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Tee huippunopeat kaupat, myy asuntosi suoraan Flipkodille.</h3>
                            <p>Haluatko päästä asunnostasi nopeasti eroon?</p>
                            <p>Ostamme remontoitavia asuntoja, joissa näemme flippaus-potentiaalia.</p>
                            <p>Laadimme kauppakirjat ja hoidamme kaupantekotilaisuuden järjestelyt ketterästi.</p>
                            <p>Ei myyntityötä, välityspalkkioita, byrokratiaa tai ostajien etsintää.</p>
                            <h4>Tarjolla vain valikoituihin asuntoihin</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <div class="image-box">
                                    <img src="images/pika-flip.jpg">
                                </div>
                                <a class="btn btn-bordered navigatorSelector" data-type="PikaFlip"  href="{{ route('frontend.myy-meille') }}" >TUTUSTU TARKEMMIN</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="maxiflip" role="tabpanel" aria-labelledby="maxiflip-tab">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Flippaa asuntosi kanssamme, jaetaan tuotto 50/50</h3>
                            <p>Maksimoi asuntosi arvo helposti kanssamme. Hoidamme puolestasi remontin aina suunnittelusta toteutukseen. Asunnon myynnin hoitaa verkostomme luotettu ja ammattitaitoinen kiinteistönvälittäjä. </p>
                            <p>Paketissa muun muassa:</p>
                            <ul>
                                <li><i class="icon-list-arrow"></i> Materiaalien ja urakoitsijoiden kilpailutus</li>
                                <li><i class="icon-list-arrow"></i> Sitovat sopimukset</li>
                                <li><i class="icon-list-arrow"></i> Remontin johtaminen, toteutus, viestintä ja dokumentointi</li>
                                <li><i class="icon-list-arrow"></i> 3D-suunnitelmat ja valokuvat</li>
                                <li><i class="icon-list-arrow"></i> Laadukas myynti ja markkinointi</li>
                            </ul>
                            <h4>Tarjolla vain valikoituihin asuntoihin</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <div class="image-box">
                                    <img src="images/maxi-flip.jpg">
                                </div>
                                <a class="btn btn-bordered navigatorSelector" data-type="MaxiFlip"   href="{{ route('frontend.flip-calculator') }}" >SELVITÄ ASUNTOSI POTENTIAALI</a>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="tab-pane fade" id="lkvflip" role="tabpanel" aria-labelledby="lkvflip-tab">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Etkö halua remontoida ennen myyntiä? Myydään asunto sellaisenaan. Flipkoti kilpailuttaa kiinteistönvälittäjän puolestasi veloituksetta.</h3>
                            <p>Palvelumme:</p>
                            <ul>
                                <li><i class="icon-list-arrow"></i>Stailaus</li>
                                <li><i class="icon-list-arrow"></i>Valokuvaus</li>
                                <li><i class="icon-list-arrow"></i>Myynti-ilmoitukset Oikotie, Etuovi, Flipkodin kotisivut</li>
                                <li><i class="icon-list-arrow"></i>Markkinointi sosiaalisessa mediassa</li>
                            </ul>
                            <h4>Asunnon myynnistä vastaa Flipkodin kilpailuttama luotettu ja ammattitaitoinen kiinteistönvälittäjä. </h4>
                            <ul>
                                <li><i class="icon-list-arrow"></i>Yksiöt 4000 eur (sis.alv.)</li>
                                <li><i class="icon-list-arrow"></i>Kaksiot 5000 eur (sis.alv.)</li>
                                <li><i class="icon-list-arrow"></i>Kolmiot 6000 eur (sis.alv.)</li>
                                <li><i class="icon-list-arrow"></i>Suuremmat 8000 eur (sis.alv.)</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <div class="image-box">
                                    <img src="images/LKV-flip.jpg">
                                </div>
                                <a class="btn btn-bordered navigatorSelector" data-type="LKVFlip"  href="{{ route('frontend.lkvflip-lomake') }}" >OTA YHTEYTTÄ</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="omaflip" role="tabpanel" aria-labelledby="omaflip-tab">
                    <div class="row">
                        <div class="col-md-8">
                            <h3>Myy asuntosi itse. Hanki kauttamme vain ne palvelut jotka tarvitset</h3>
                            <p>Loistava vaihtoehto sinulle, jolla on jo kokemusta asuntojen myynnistä tai vaikkapa ostaja valmiina. Me autamme askeleen eteen päin!</p>
                            <p>Kauttamme muun muassa:</p>
                            <ul>
                                <li><i class="icon-list-arrow"></i>Stailauspalvelut</li>
                                <li><i class="icon-list-arrow"></i>Ostotarjouslomakkeet</li>
                                <li><i class="icon-list-arrow"></i>Valokuvaus</li>
                                <li><i class="icon-list-arrow"></i>Kauppakirjat</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <div class="image-box">
                                    <img src="images/oma-flip.jpg">
                                </div>
                                <a class="btn btn-bordered navigatorSelector" data-type="OmaFlip"  href="{{ route('frontend.omaflip-lomake') }}"  >VALITSE HALUAMASI PALVELUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="investing-work flip-property">
        <div class="container">
            <h3>{{ translateText($langtextarr,'Näin flippaat kanssamme') }}</h3>
            <div class="grid">
                <div class="item">
                    <i class="icon-home-search"></i>
                    <p>{{ translateText($langtextarr,'Selvitä asuntosi potentiaali Flippauslaskurin avulla.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-user-chart2"></i>
                    <p>{{ translateText($langtextarr,'Varaa puhelinaika Flipkodin asiantuntijan kalenteriin käydäksesi vaihtoehdot läpi.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-home-groth"></i>
                    <p>{{ translateText($langtextarr,'Sovi tapaaminen jos asunnossa on potentiaalia ja sovi Flippauksen yksityiskohdista.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-home-setting"></i>
                    <p>{{ translateText($langtextarr,'Remontointi suunnitelman mukaan, Flipkoti ottaa täyden vastuun remontista, markkinoinnista ja myynnistä. Sinä voit ottaa rennosti.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-sale-rent2"></i>
                    <p>{{ translateText($langtextarr,'Myymme flipatun asuntosi parhaalle ostajalle ja jaamme kanssasi tuotot 50/50.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-refresh2"></i>
                    <p>{{ translateText($langtextarr,'Tienasit juuri rahaa asunnollasi menettämisen sijaan! Helppoa, eikö?') }}</p>
                </div>
                <div class="arrows"><i class="icon-nextline"></i><i class="icon-nextline"></i></div>
                <div class="arrows"><i class="icon-nextline"></i><i class="icon-nextline"></i></div>
            </div>
        </div>
    </section>
    <section class="renovate-contact">
        <div class="container">
            <p>{{ translateText($langtextarr,'Tilaa asiantuntijamme paikalle ja tehdään unelmistasi totta.') }}<br>{{ translateText($langtextarr,'Tai aloita keskustelu saman tien tästä -') }}  <a href="https://wa.me/358405910540">whatsapp/chat +358405910540</a></p>
        </div>
    </section>
    <!-- <section class="sell-home-grid">
        <div class="container padding-60">
            <div class="row gutters-100 align-items-center">
                <div class="col-md-6">
                    <img src="{{ url('images/img23.jpg') }}">
                </div>
                <div class="col-md-6">
                    <div class="info">
                        <h3>{{ translateText($langtextarr,'Myy koti meille') }}</h3>
                        <p>{{ translateText($langtextarr,'Ei välityspalkkioita, ei lomakkeiden täyttöä, ei asiakkaiden etsintää.') }}</p>
                        <a href="{{ route('frontend.myy-meille')}}" class="btn btn-primary">{{ translateText($langtextarr,'Tutustu tarkemmin') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
  

        </div>
    </section>
 

<!-- ContactModel -->
<div class="modal fade" id="contactmodel" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
                <h4 class="border-h">{{ translateText($langtextarr,'Palveluiden tilaus') }}</h4>
				{{ html()->form('POST', route('frontend.sell'))->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->id('contactform')->open() }}
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
				
				<div class="form-group width-100">
					<label for="subject-plan">{{ translateText($langtextarr,'Valitse palvelutaso') }}</label>
					<select class="form-control"  name="subject"  id="subject-plan" readonly="readonly">
					</select>
                </div>

                 <div class="form-group width-100" id="hide-additional_selection">
                    <label for="additional_selection">{{ translateText($langtextarr,'Valitse') }}</label>
                    <select multiple="" class="form-control" id="additional_selection" name="additional_selection[]" title="Aihe" data-placeholder="Palvelut tarpeesi mukaan" placeholder="Palvelut tarpeesi mukaan">
                        <option value="Sisustussuunnittelu">{{ translateText($langtextarr,'Sisustussuunnittelu') }}</option>
                        <option value="Pohjakuvat">{{ translateText($langtextarr,'Pohjakuvat') }}</option>
                        <option value="Stailaus ja Valokuvaus">{{ translateText($langtextarr,'Stailaus ja Valokuvaus') }}</option>
                        <option value="3D kuvat ja virtuaalikierrokset">{{ translateText($langtextarr,'3D kuvat ja virtuaalikierrokset') }}</option>
                        <option value="Etuovi ja Oikotie ilmoitukset">{{ translateText($langtextarr,'Etuovi ja Oikotie ilmoitukset') }}</option>
                        <option value="Asuntokaupan dokumentit: huoneistomyyntiesite, ostotarjouskaavake ja kauppakirjapohja.">{{ translateText($langtextarr,'Asuntokaupan dokumentit: huoneistomyyntiesite, ostotarjouskaavake ja kauppakirjapohja.') }}</option>
                        <option value="Materiaalien ja urakoitsijoiden kilpailutus">{{ translateText($langtextarr,'Materiaalien ja urakoitsijoiden kilpailutus') }}</option>
                        <option value="LKV konsultaatiota tarpeen mukaan">{{ translateText($langtextarr,'LKV konsultaatiota tarpeen mukaan') }}</option>
                        <option value="Lakimiespalvelut">{{ translateText($langtextarr,'Lakimiespalvelut') }}</option>
                    </select>
                </div>
				<div class="form-group width-100">
					<label for="message">{{ translateText($langtextarr,'Viesti') }}</label>
					<textarea  name="message" class="form-control text-area" rows="5" placeholder="Voit kuvata tarpeita tai tilannettasi tarkemmin" id="comment"></textarea>
				</div>
                <button type="submit" class="btn-sbmt" >{{ translateText($langtextarr,'Lähetä') }}</button>
                
				{{ html()->form()->close() }}
			</div>
		</div>
	</div>
</div>
    <div class="form-group width-100" id="get-additional_selection" style="display: none;">
        <label for="additional_selection">{{ translateText($langtextarr,'Valitse') }}</label>
        <select multiple="" class="form-control" id="additional_selection" name="additional_selection[]" title="Aihe" data-placeholder="Palvelut tarpeesi mukaan" placeholder="Palvelut tarpeesi mukaan">
            <option value="Sisustussuunnittelu">{{ translateText($langtextarr,'Sisustussuunnittelu') }}</option>
            <option value="Pohjakuvat">{{ translateText($langtextarr,'Pohjakuvat') }}</option>
            <option value="Stailaus ja Valokuvaus">{{ translateText($langtextarr,'Stailaus ja Valokuvaus') }}</option>
            <option value="3D kuvat ja virtuaalikierrokset">{{ translateText($langtextarr,'3D kuvat ja virtuaalikierrokset') }}</option>
            <option value="Etuovi ja Oikotie ilmoitukset">{{ translateText($langtextarr,'Etuovi ja Oikotie ilmoitukset') }}</option>
            <option value="Asuntokaupan dokumentit: huoneistomyyntiesite, ostotarjouskaavake ja kauppakirjapohja">{{ translateText($langtextarr,'Asuntokaupan dokumentit: huoneistomyyntiesite, ostotarjouskaavake ja kauppakirjapohja') }}</option>
            <option value="Materiaalien ja urakoitsijoiden kilpailutus">{{ translateText($langtextarr,'Materiaalien ja urakoitsijoiden kilpailutus') }}</option>
            <option value="LKV konsultaatiota tarpeen mukaan">{{ translateText($langtextarr,'LKV konsultaatiota tarpeen mukaan') }}</option>
            <option value="Lakimiespalvelut">{{ translateText($langtextarr,'Lakimiespalvelut') }}</option>
        </select>
    </div>
<!-- @lang('strings.frontend.welcome_to', ['place' => app_name()]) -->
@endsection


@push('after-styles')
{{ style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css') }}   
@endpush

@push('after-scripts')
{!! script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js') !!}
<script>
    $(document).ready(function () {
        $(".tabs-heading a").click(function() {
            $('html, body').animate({
                scrollTop: $("#myTabContent").offset().top
            }, 2000);
        });


        // $('#contactmodel').on('shown.bs.modal', function (e) {
            
        // });
        /*$.validator.addMethod("laxphone", function(value, element) {
            return this.optional( element ) || /^\+|0(?:[0-9] ?){6,14}[0-9]$/.test( value );
        }, 'Anna voimassa oleva yhteysnumero');*/
        
        $('.navigatorSelector').click(function(e){
            e.preventDefault();
            $.cookie("asuntosi-type", $(this).attr('data-type'));
            window.location.href = $(this).attr('href');
        })
        // $.cookie("asuntosi-type", 'pikaflip');
        // console.log($.cookie("asuntosi-type"));

        $('#contactform').validate({ // initialize the plugin
            rules: {
                name: { required: true },
                email: { required: true, email: true },
                phone: { required: true,   minlength: 10, maxlength: 15 /*laxphone:true*/},
                subject: { required: true },
                'additional_selection[]': { required: true },
                message: { required: true }
            },
            messages: {
                name: { required: 'Pakollinen tieto' },
                email: { required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite' },
                phone: { required: 'Pakollinen tieto',number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
                subject: { required: 'Pakollinen tieto' },
                'additional_selection[]': { required: 'Pakollinen tieto' },
                message: { required: 'Pakollinen tieto' }
            }
        });
        $('#additional_selection').multiselect({
            buttonWidth: '100%',
            nSelectedText: 'valittu',
            allSelectedText:"kaikki valitut"
        });
        $(document).on("click",".contactmodel-btn",function(){
            var click_type = $(this).attr('attr-plan');
            if(click_type == 'basic'){
                $("#contactmodel").find(".border-h").html("Palveluiden tarjouspyyntö");
                $('#subject-plan').html('<option value="Räätälöity Flippaus" style="display: none;">Räätälöity Flippaus</option>');
                $("#hide-additional_selection").html($("#get-additional_selection").html());
                $('#additional_selection').multiselect({
                    buttonWidth: '100%',
                    nSelectedText: 'valittu',
                    allSelectedText:"kaikki valitut"
                });
            }else{
                $("#contactmodel").find(".border-h").html("Palveluiden tarjouspyyntö");
                $('#subject-plan').html('<option value="Avaimet Käteen Flippaus">Avaimet Käteen Flippaus</option>');
                $("#hide-additional_selection").html('');

            }
        });

    });
</script>
@endpush