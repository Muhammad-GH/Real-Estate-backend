@extends('frontend.layouts.app')

@section('title',__('meta_title_kiinteistot-ja-taloyhtiot'))
@section('meta_description', __('meta_description_kiinteistot-ja-taloyhtiot') )
@section('meta_image',   url('images/meta/banner-real-estate.jpg')  )

@section('content')

 <?php
    $langtextarr = Session::get('langtext');
	$years = range(1900,date('Y'));
    ?>
    <div class="banner">
        <img class="d-none d-sm-block" src="{{ url('images/banner-real-estate.jpg') }}">
        <img class="d-block d-sm-none" src="{{ url('images/kiinteistot-ja-taloyhtiot-mobi.jpg') }}">
        <div class="content">
            <img src="{{ url('images/flipkoti-pro-wt.png') }}">
            <h1>
                <span>{{ translateText($langtextarr,'Vie kiinteistön ja taloyhtiön') }}</span><br>
                <span>{{ translateText($langtextarr,'hoitaminen nykyaikaan') }}</span>
            </h1>
            <!-- <a href="#" class="btn btn-primary">{{ translateText($langtextarr,'Ota yhteyttä') }}</a> -->
        </div>
    </div>
    <section class="realstate-services">
        <div class="container padding-30">
            <h2>{{ translateText($langtextarr,'Kiinteistökilpailuttaja') }}</h2>
            <p>{{ translateText($langtextarr,'Kilpailuta kiinteistöremontit, huoltotyöt, ylläpito sekä hallinto ja säästä rahaa.') }}</p>
            <div class="gird">
                <div class="item cstm-holto-btn">
                    <a class="" href="#" data-toggle="modal" data-target="#services-form">
                        <img src="{{ url('images/img10.jpg') }}">
                        <span>{{ translateText($langtextarr,'Huolto') }}</span>
                    </a>
                </div>
                <div class="item cstm-yllp-btn">
                    <a class="" href="#" data-toggle="modal" data-target="#services-form">
                        <img src="{{ url('images/img11.jpg') }}">
                        <span>{{ translateText($langtextarr,'ylläpito') }}</span>
                    </a>
                </div>
                <div class="item">
                    <a href="#" data-toggle="modal" data-target="#remontt-form">
                        <img src="{{ url('images/img12.jpg') }}">
                        <span>{{ translateText($langtextarr,'remontit') }}</span>
                    </a>
                </div>
                <div class="item">
                    <a href="#" data-toggle="modal" data-target="#hallinto-form">
                        <img src="{{ url('images/img13.jpg') }}">
                        <span>{{ translateText($langtextarr,'HALLINTO') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="realstate-info">
        <div class="container padding-30">
            <div class="row align-items-center gutters-120">
                <div class="col-lg-6">
                    <h3>{{ translateText($langtextarr,'Perinteinen tapa hoitaa kiinteistöjä on kallista. Nyt on aika ottaa digiloikka kohti järkevämpää aikakautta.') }}</h3>
                    <p>{{ translateText($langtextarr,'Hyväkin asuinhuoneisto menettää arvonsa huonosti hoidetussa taloyhtiössä. Niitä on Suomessa paljon. Kiinteistön ja taloyhtiön hyvä johtaminen vaati liiketoimintaymmärrystä sekä nykyaikaisia työkaluja ilman välikäsien välikäsiä.') }}</p>
                </div>
                <div class="col-lg-6">
                    <img src="{{ url('images/realstate.png') }}">
                </div>
            </div>
            <div class="row list gutters-100">
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Tarjoamme digitaaliset työkalut ja toimintatavat taloyhtiön hallinnoinnin tehostamiseen.') }}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Kiinteistöhuollon ja ylläpidon kilpailutus sekä sopimukset ja johtaminen. Oikea-aikaisesti, todelliseen tarpeeseen ilman hämäriä piilokuluja') }}
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="item">
                        <i class="icon-list-arrow"></i> {{ translateText($langtextarr,'Meistä saat kolmannen osapuolen taloyhtiöremonttien materiaalien ja urakoitsijoiden kilpailutukseen. Kauttamme myös kustannustehokas projektinjohto ja valvonta.') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="realstate-map">
        <div class="container">
            <h2>{{ translateText($langtextarr,'Parempi tapa hoitaa kiinteistöjä sekä taloyhtiöitä – Flipkoti PRO') }}</h2>
            <div class="map-box">
                <div class="logo">
                   <img src="{{ url('images/flipkoti-pro.png') }}">
                </div>
                <img class="map" src="images/realstate-map.jpg">
                <div class="list-item left">
                    <i class="icon-contractors"></i>
                    <span>{{ translateText($langtextarr,'Urakoitsijat') }}</span>
                </div>
                <div class="list-item right">
                    <i class="icon-materials"></i>
                    <span>{{ translateText($langtextarr,'Materiaalit') }}</span>
                </div>
            </div>
            <p>{{ str_replace('<br>',' ',translateText($langtextarr,'Laatu, toimitusvarmuus ja helppous ovat meille ydinasioita. Haluamme uudistaa kiinteistönhoitoa asiakaslähtöiseksi.')) }}</p>
        </div>
    </section>
    <section class="through-us">
        <div class="container">
            <h3>{{ translateText($langtextarr,'remontointi- huolto- ja ylläpitopalvelut kauttamme') }}</h3>
            <div class="row">
                <div class="col-md-4">
                    <ul>
                       <li>{{ translateText($langtextarr,'Kattoremontti') }}</li>
                       <li>{{ translateText($langtextarr,'LVIS remontti') }}</li>
                       <li>{{ translateText($langtextarr,'Hissiremontti') }}</li>
                       <li>{{ translateText($langtextarr,'Julkisivuremontti') }}</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul>
                        <li>{{ translateText($langtextarr,'energiaremontti') }}</li>
                        <li>{{ translateText($langtextarr,'piharemontti') }}</li>
                        <li>{{ translateText($langtextarr,'yhteisten tilojen remontit') }}</li>
                        <li>{{ translateText($langtextarr,'huoneistojen remontit') }}</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul>
                        <li>{{ translateText($langtextarr,'talvikunnossapito') }}</li>
                        <li>{{ translateText($langtextarr,'Sisätilojen kunnossapito') }}</li>
                        <li>{{ translateText($langtextarr,'kiinteistöhuolto') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
   <section class="presentation-rqst">
        <div class="container">
            <h2>{{ translateText($langtextarr,'Pyydä konseptin esittely') }}</h2>
            <div class="request-form">
                <form method="post" action="{{ route('frontend.professional-enquiry') }}" id="service-form">
                    @csrf
                    <div class="row gutters-24">
                        <div class="col-lg-6">
                            <input type="hidden" name="type" value="real estate and housing" >
                            <div class="row gutters-16">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ translateText($langtextarr,'Etunimi') }}</label>
                                        <input class="form-control" type="text" name="first_name" required>
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
                                <label>{{ translateText($langtextarr,'Taloyhtiön nimi') }}</label>
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
                            <div class="checkbox chBxServiceForm">
                                <label class="light" for="terms"><input type="checkbox" class="custom-check" id="terms" name="terms" required=""><span class="checkmark"></span>{{ translateText($langtextarr, 'Olen lukenut Flipkodin') }}  <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link"> {{ translateText($langtextarr, 'tietosuojaseloste') }}</a> {{ translateText($langtextarr, 'ja') }} <a href="{{ route('frontend.terms') }}" class="custom-link"> {{ translateText($langtextarr, 'käyttöehdot') }}</a></label>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-bordered" type="submit">{{ translateText($langtextarr,'Lähetä') }}</button>
                            <p id="response-text"></p>
                        </div>
                       
                    </div>
                </form>
            </div>
        </div>
    </section>
 <div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">

			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<p>seinä(m<sup>2</sup>) = Pituus * korkeus * 2 + leveys * korkeus * 2</p>

				<p>Lattia(m<sup>2</sup>) = Pituus leveys</p>

				<p>Katto(m<sup>2</sup>) = Pituus leveys</p>
				<img src="{{asset('images/sizechart-custom.jpg')}}">
			</div>

		</div>

	</div>
    </div>
	<!-- Model Popup -->
	<div class="modal fade services-modal" id="services-form" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

            <div class="modal-content">

                <div class="modal-body">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

					<form method="post" action="{{ route('frontend.serviceFormSave') }}" id="srv-frm">
                    <div class="service-form">

                        <h3>Perustiedot</h3>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Kiinteistön osoite</label>

                                    <input type="text" class="form-control" name="property_address" required  placeholder="">

                                </div>

                                <div class="form-group">

                                    <label>Tontin pinta-ala</label>

                                    <div class="input-group">

                                        <input type="number" name="area_of_block" required class="form-control" placeholder="">

                                        <div class="input-group-append">

                                            <span class="input-group-text">m<sup>2</sup></span>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Huoneistoneliöt</label>

                                    <div class="input-group">

                                        <input type="number" name="property_area" required class="form-control" placeholder="">

                                        <div class="input-group-append">

                                            <span class="input-group-text">m<sup>2</sup></span>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Yhteisten tilojen neliöt</label>

                                    <div class="input-group">

                                        <input type="number" name="common_area" required class="form-control" placeholder="">

                                        <div class="input-group-append">

                                            <span class="input-group-text">m<sup>2</sup></span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Kiinteistön valmistumisvuosi</label>

                                    <select required class="form-control" name="year_of_built">
										@foreach( $years as $year )
											 <option value="{{ $year }}">{{ $year }}</option>
										@endforeach
                                    </select>

                                </div>

                                <div class="form-group">

                                    <label>Huoneistomäärä</label>

                                    <input class="form-control" type="number" name="no_of_apartments" required>

                                </div>

                                <div class="form-group">

                                    <label>Kerrosten lukumäärä</label>

									<input class="form-control" type="number" name="no_of_floors" required>

                                </div>

                            </div>

                        </div>

                        <h3>Yhteystiedot</h3>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Yhteyshenkilön nimi</label>

                                    <input type="text" class="form-control" name="contact_person_name" required placeholder="">

                                </div>

                                <div class="form-group">

                                    <label>Puhelinnumero</label>

                                    <input type="text" class="form-control" name="phone_number" required placeholder="">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Sähköposti</label>

                                    <input type="email" class="form-control" name="contact_email" required placeholder="">

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <div class="checkbox termsSrv">
										<label class="light" for="termsS"><input type="checkbox" class="custom-check" id="termsS" name="termsS" required=""><span class="checkmark"></span>{{ translateText($langtextarr, 'Olen lukenut Flipkodin') }}  <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link"> {{ translateText($langtextarr, 'tietosuojaseloste') }}</a> {{ translateText($langtextarr, 'ja') }} <a href="{{ route('frontend.terms') }}" class="custom-link"> {{ translateText($langtextarr, 'käyttöehdot') }}</a></label>
									</div>

                                </div>
								<input class="cstm-srtyp-cls" name="service_type" type="hidden" value="">
                                <button type="submit" class="btn btn-primary">Kilpailuta tästä</button>
								<p id="response-text-service"></p>
                            </div>

                        </div>

                    </div>
					</form>
                </div>

            </div>

        </div>

    </div>
	
	
	<div class="modal fade services-modal" id="remontt-form" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

            <div class="modal-content">

                <div class="modal-body">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>
					
					<form method="post" action="{{ route('frontend.serviceFormSave') }}" id="rnvt-frm">
                    <div class="service-form">
						
						<div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>Valitse remontti</label>

                                    <select required class="form-control" name="renovation_done">

                                        <option value="KATTOREMONTTI">KATTOREMONTTI</option>

                                        <option value="LVIS REMONTTI">LVIS REMONTTI</option>
                                        <option value="HISSIREMONTTI">HISSIREMONTTI</option>
                                        <option value="JULKISIVUREMONTTI">JULKISIVUREMONTTI</option>
                                        <option value="ENERGIAREMONTTI">ENERGIAREMONTTI</option>
                                        <option value="PIHAREMONTTI">PIHAREMONTTI</option>
                                        <option value="YHTEISTEN TILOJEN REMONTIT">YHTEISTEN TILOJEN REMONTIT</option>
                                        <option value="HUONEISTOJEN REMONTIT">HUONEISTOJEN REMONTIT</option>
                                        <option value="SISÄTILOJEN KUNNOSSAPITO">SISÄTILOJEN KUNNOSSAPITO</option>
                                        <option value="KIINTEISTÖHUOLTO">KIINTEISTÖHUOLTO</option>

                                    </select>

                                </div>

                            </div>
                        </div>
						
						
                        <h3>Perustiedot</h3>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Kiinteistön osoite</label>

                                    <input type="text" class="form-control" name="property_address" required placeholder="">

                                </div>


                                <div class="form-group">

                                    <label>Huoneistoneliöt</label>

                                    <div class="input-group">

                                        <input type="number" name="property_area" required class="form-control" placeholder="">

                                        <div class="input-group-append">

                                            <span class="input-group-text">m<sup>2</sup></span>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Yhteisten tilojen neliöt</label>

                                    <div class="input-group">

                                        <input type="number" name="common_area" required class="form-control" placeholder="">

                                        <div class="input-group-append">

                                            <span class="input-group-text">m<sup>2</sup></span>

                                        </div>

                                    </div>

                                </div>
								
								<div class="form-group">

                                    <label>Toivottu ajankohta</label>

                                    <input type="date" class="form-control" required name="desired_start_date" placeholder="">

                                    

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Kiinteistön valmistumisvuosi</label>

                                    <select required class="form-control" name="year_of_built">

                                        @foreach( $years as $year )
											 <option value="{{ $year }}">{{ $year }}</option>
										@endforeach

                                    </select>

                                </div>

                                <div class="form-group">

                                    <label>Huoneistomäärä</label>

                                    <input class="form-control" type="number" name="no_of_apartments" required>

                                </div>

                                <div class="form-group">

                                    <label>Kerrosten lukumäärä</label>

									<input class="form-control" type="number" name="no_of_floors" required>

                                </div>

                            </div>

                        </div>

                        <h3>Yhteystiedot</h3>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Yhteyshenkilön nimi</label>

                                    <input type="text" class="form-control" name="contact_person_name" required placeholder="">

                                </div>

                                <div class="form-group">

                                    <label>Puhelinnumero</label>

                                    <input type="text" class="form-control" name="phone_number" required placeholder="">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Sähköposti</label>

                                    <input type="email" class="form-control" name="contact_email" required placeholder="">

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <div class="checkbox termsRas">
										<label class="light" for="termsR"><input type="checkbox" class="custom-check" id="termsR" name="termsR" required=""><span class="checkmark"></span>{{ translateText($langtextarr, 'Olen lukenut Flipkodin') }}  <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link"> {{ translateText($langtextarr, 'tietosuojaseloste') }}</a> {{ translateText($langtextarr, 'ja') }} <a href="{{ route('frontend.terms') }}" class="custom-link"> {{ translateText($langtextarr, 'käyttöehdot') }}</a></label>
									</div>

                                </div>
								<input name="service_type" type="hidden" value="Remontti">
                                <button type="submit" class="btn btn-primary">Kilpailuta tästä</button>
								<p id="response-text-remontit"></p>
                            </div>

                        </div>

                    </div>
					</form>

                </div>

            </div>

        </div>

    </div>
	
	
	<div class="modal fade services-modal" id="hallinto-form" tabindex="-1" role="dialog" aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

            <div class="modal-content">

                <div class="modal-body">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>
					<form method="post" action="{{ route('frontend.serviceFormSave') }}" id="hallnto-frm">
                    <div class="service-form">

                        <h3>Perustiedot</h3>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Kiinteistön osoite</label>

                                    <input type="text" class="form-control" name="property_address" required placeholder="">

                                </div>

                                

                                <div class="form-group">

                                    <label>Huoneistoneliöt</label>

                                    <div class="input-group">

                                        <input type="number" name="property_area" required class="form-control" placeholder="">

                                        <div class="input-group-append">

                                            <span class="input-group-text">m<sup>2</sup></span>

                                        </div>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label>Yhteisten tilojen neliöt</label>

                                    <div class="input-group">

                                        <input type="number" name="common_area" required class="form-control" placeholder="">

                                        <div class="input-group-append">

                                            <span class="input-group-text">m<sup>2</sup></span>

                                        </div>

                                    </div>

                                </div>
								
								<div class="form-group renovationDoneH">

                                    <label>Tehdyt Remontit</label>

                                    <select required class="renovation_done_multi form-control" name="renovation_done[]" multiple="true" >

                                        <option value="KATTOREMONTTI">KATTOREMONTTI</option>
                                        <option value="LVIS REMONTTI">LVIS REMONTTI</option>
                                        <option value="HISSIREMONTTI">HISSIREMONTTI</option>
                                        <option value="JULKISIVUREMONTTI">JULKISIVUREMONTTI</option>
                                        <option value="ENERGIAREMONTTI">ENERGIAREMONTTI</option>
                                        <option value="PIHAREMONTTI">PIHAREMONTTI</option>
                                        <option value="YHTEISTEN TILOJEN REMONTIT">YHTEISTEN TILOJEN REMONTIT</option>

                                    </select>
                                    <div id="multiselect-error-renovationDoneH"></div>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Kiinteistön valmistumisvuosi</label>

                                    <select required class="form-control" name="year_of_built">

                                        @foreach( $years as $year )
											 <option value="{{ $year }}">{{ $year }}</option>
										@endforeach

                                    </select>

                                </div>

                                <div class="form-group">

                                    <label>Huoneistomäärä</label>
									
									<input class="form-control" type="number" name="no_of_apartments" required>

                                </div>

                                <div class="form-group">

                                    <label>Kerrosten lukumäärä</label>
									
									<input class="form-control" type="number" name="no_of_floors" required>

                                </div>
								
								<div class="form-group">

                                    <label>Remontin ajankohta</label>

                                    <select required class="form-control" name="renovation_year">

                                        @foreach( $years as $year )
											 <option value="{{ $year }}">{{ $year }}</option>
										@endforeach

                                    </select>

                                </div>

                            </div>

                        </div>

                        <h3>Yhteystiedot</h3>

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Yhteyshenkilön nimi</label>

                                    <input type="text" class="form-control" name="contact_person_name" required placeholder="">

                                </div>

                                <div class="form-group">

                                    <label>Puhelinnumero</label>

                                    <input type="text" class="form-control" name="phone_number" required placeholder="">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>Sähköposti</label>

                                    <input type="email" class="form-control" name="contact_email" required placeholder="">

                                </div>

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <div class="checkbox termsHal">
										<label class="light" for="termsH"><input type="checkbox" class="custom-check" id="termsH" name="termsH" required=""><span class="checkmark"></span>{{ translateText($langtextarr, 'Olen lukenut Flipkodin') }}  <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link"> {{ translateText($langtextarr, 'tietosuojaselosteen') }}</a> {{ translateText($langtextarr, 'ja') }} <a href="{{ route('frontend.terms') }}" class="custom-link"> {{ translateText($langtextarr, 'käyttöehdot') }}</a></label>
									</div>

                                </div>
								<input name="service_type" type="hidden" value="Hallinto">
                                <button type="submit" class="btn btn-primary">Kilpailuta tästä</button>
								<p id="response-text-hallinto"></p>
                            </div>

                        </div>

                    </div>
					</form>

                </div>

            </div>

        </div>

    </div>

@endsection

@push('after-styles')
{{ style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css') }}   
<style>
.multiselect.dropdown-toggle.btn.btn-default {
    background: white;
    color: #495057;
    border: 1px solid #cccccc;
}
</style>
@endpush

@push('after-scripts')
{!! script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js') !!}
<script>

    $(document).ready(function () {
        
        $('#service-form').validate({ // initialize the plugin
            rules: {
                first_name: {required: true},
                last_name: {required: true},
                email: {required: true, email: true},
                phone: { required: true,   minlength: 10, maxlength: 15 /*laxphone:true*/},
                housing_association: {required: true},
                terms: {required: true}
            },
            messages: {
                first_name: {required: 'Pakollinen tieto'},
                last_name: {required: 'Pakollinen tieto'},
                email: {required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite'},
                phone: {required: 'Pakollinen tieto', number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
                housing_association: {required: 'Pakollinen tieto'},
                terms: {required: 'Pakollinen tieto'}
            },
            errorPlacement: function(error, element) {
                var type = $(element[0]).attr('name');
                if (type == 'terms') {
                    error.insertAfter(".chBxServiceForm");
                }else {
                    error.insertAfter(element);
                }
            }
        });

        $('#service-form').submit(function(){
            event.preventDefault();
            
            if($('#service-form').valid() == true){
                var text = $('#service-form button[type="submit"]').text();
                $('#service-form button[type="submit"]').text(loadingText);
                $('#service-form button[type="submit"]').attr('disabled','disabled');
                var url = $('#service-form').attr('action');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $('#service-form').serialize(),
                    success:function(response){
                        //$('#response-text').html(response.success);
                        //showToastNotification('success', response.success);
                        $('#service-form button[type="submit"]').text(text);
                        $('#service-form button[type="submit"]').removeAttr('disabled');
                        window.location.href = "{{ route('frontend.kiinteistot-ja-taloyhtiot-kiitos') }}";
                    },
                    error:function(){
                        $('#service-form button[type="submit"]').removeAttr('disabled');
                        $('#service-form button[type="submit"]').text(text);
                        showToastNotification('error', errorText);
                    }
                });
            }
        });

        $('#srv-frm').validate({ // initialize the plugin
            rules: {
                contact_person_name: {required: true},
                contact_email: {required: true, email: true},
                phone_number: {required: true, minlength: 10/*, laxphone: true*/},
                property_address: {required: true},
                area_of_block: {required: true},
                property_area: {required: true},
                common_area: {required: true},
                year_of_built: {required: true},
                no_of_apartments: {required: true},
                no_of_floors: {required: true},
                terms: {required: true}
            },
            messages: {
                contact_person_name: {required: 'Pakollinen tieto'},
                contact_email: {required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite'},
                phone_number: {required: 'Pakollinen tieto', minlength: 'Tarkastathan, että numerosi on oikenin'},
                property_address: {required: 'Pakollinen tieto'},
                area_of_block: {required: 'Pakollinen tieto'},
                property_area: {required: 'Pakollinen tieto'},
                common_area: {required: 'Pakollinen tieto'},
                year_of_built: {required: 'Pakollinen tieto'},
                no_of_apartments: {required: 'Pakollinen tieto'},
                no_of_floors: {required: 'Pakollinen tieto'},
                termsS: {required: 'Pakollinen tieto'}
            },
            errorPlacement: function(error, element) {
                var type = $(element[0]).attr('name');
                if (type == 'terms') {
                    error.insertAfter(".termsSrv");
                }else {
                    error.insertAfter(element);
                }
            }
        });
            
        $('#srv-frm').submit(function(){
            event.preventDefault();
            
            if($('#srv-frm').valid() == true){
                var textS = $('#srv-frm button[type="submit"]').text();
                $('#srv-frm button[type="submit"]').text(loadingText);
                $('#srv-frm button[type="submit"]').attr('disabled','disabled');
                var url = $('#srv-frm').attr('action');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $('#srv-frm').serialize(),
                    dataType: 'json',
                    success:function(response){
                        $('#srv-frm').trigger("reset");
                        
                        //$('#response-text-service').html(response.message);
                        //showToastNotification('success', response.message);
                        $('#srv-frm button[type="submit"]').text(textS);
                        $('#srv-frm button[type="submit"]').removeAttr('disabled');
                        //window.location.href = "{{ route('frontend.kiitos') }}";
                        window.location.href = "{{ route('frontend.kiinteistot-ja-taloyhtiot-kiinteistokilpailuttaja-kiitos') }}";
                    },
                    error:function(){
                        $('#srv-frm button[type="submit"]').text(textS);
                        $('#srv-frm button[type="submit"]').removeAttr('disabled');
                        showToastNotification('error', errorText);
                    }
                });
            }
        });

        
        $('#rnvt-frm').validate({ // initialize the plugin
            rules: {
                contact_person_name: {required: true},
                contact_email: {required: true, email: true},
                phone_number: {required: true, minlength: 10/*, laxphone: true*/},
                property_address: {required: true},
                'renovation_done[]': {required: true},
                desired_start_date: {required: true},
                renovation_year: {required: true},
                property_area: {required: true},
                common_area: {required: true},
                year_of_built: {required: true},
                no_of_apartments: {required: true},
                no_of_floors: {required: true},
                termsR: {required: true}
            },
            messages: {
                contact_person_name: {required: 'Pakollinen tieto'},
                contact_email: {required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite'},
                phone_number: {required: 'Pakollinen tieto', minlength: 'Tarkastathan, että numerosi on oikenin'},
                property_address: {required: 'Pakollinen tieto'},
                'renovation_done[]': {required: 'Pakollinen tieto'},
                desired_start_date: {required: 'Pakollinen tieto'},
                renovation_year: {required: 'Pakollinen tieto'},
                property_area: {required: 'Pakollinen tieto'},
                common_area: {required: 'Pakollinen tieto'},
                year_of_built: {required: 'Pakollinen tieto'},
                no_of_apartments: {required: 'Pakollinen tieto'},
                no_of_floors: {required: 'Pakollinen tieto'},
                termsR: {required: 'Pakollinen tieto'}
            },
            errorPlacement: function(error, element) {
                var type = $(element[0]).attr('name');
                if (type == 'terms') {
                    error.insertAfter(".termsHal");
                }else if (type == 'renovation_done[]') {
                    error.insertAfter(".renovationDoneH");
                }else {
                    error.insertAfter(element);
                }
                
            }
        });
            
        $('#rnvt-frm').submit(function(){
            event.preventDefault();
            if($('#rnvt-frm').valid() == true){
                var textR = $('#rnvt-frm button[type="submit"]').text();

                $('#rnvt-frm button[type="submit"]').text(loadingText);
                $('#rnvt-frm button[type="submit"]').attr('disabled','disabled');
                var url = $('#rnvt-frm').attr('action');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $('#rnvt-frm').serialize(),
                    success:function(response){
                        $('#rnvt-frm').trigger("reset");
                        //$('#response-text-remontit').html(response.message);
                        //showToastNotification('success', response.message);
                        $('#rnvt-frm button[type="submit"]').text(textR);
                        $('#rnvt-frm button[type="submit"]').removeAttr('disabled');
                        //window.location.href = "{{ route('frontend.kiitos') }}";
                        window.location.href = "{{ route('frontend.kiinteistot-ja-taloyhtiot-kiinteistokilpailuttaja-kiitos') }}";
                    },
                    error:function(){
                        $('#rnvt-frm button[type="submit"]').text(textR);
                        $('#rnvt-frm button[type="submit"]').removeAttr('disabled');
                        showToastNotification('error', errorText);
                    }
                });
            }
        });

        $('#hallnto-frm').validate({ // initialize the plugin
            rules: {
                // contact_person_name: {required: true},
                // contact_email: {required: true, email: true},
                // phone_number: {required: true, minlength: 10/*, laxphone: true*/},
                // property_address: {required: true},
                 'renovation_done[]': {required: true},
                // desired_start_date: {required: true},
                // property_area: {required: true},
                // common_area: {required: true},
                // year_of_built: {required: true},
                // no_of_apartments: {required: true},
                // no_of_floors: {required: true},
                 termsH: {required: true}
            },
            messages: {
                contact_person_name: {required: 'Pakollinen tieto'},
                contact_email: {required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite'},
                phone_number: {required: 'Pakollinen tieto', minlength: 'Tarkastathan, että numerosi on oikenin'},
                property_address: {required: 'Pakollinen tieto'},
                'renovation_done[]': {required: 'Pakollinen tieto'},
                desired_start_date: {required: 'Pakollinen tieto'},
                property_area: {required: 'Pakollinen tieto'},
                common_area: {required: 'Pakollinen tieto'},
                year_of_built: {required: 'Pakollinen tieto'},
                no_of_apartments: {required: 'Pakollinen tieto'},
                no_of_floors: {required: 'Pakollinen tieto'},
                termsH: {required: 'Pakollinen tieto'}
            },
            errorPlacement: function(error, element) {
                var type = $(element[0]).attr('name');
                if (type == 'terms') {
                    error.insertAfter(".termsRas");
                }else if (type == 'renovation_done[]') {
                    error.insertAfter("#multiselect-error-renovationDoneH");
                }else {
                    error.insertAfter(element);
                }
            }
        });
            
        $('#hallnto-frm').submit(function(){
            event.preventDefault();
            
            if($('#hallnto-frm').valid() == true){
                var textH = $('#hallnto-frm button[type="submit"]').text();
                $('#hallnto-frm button[type="submit"]').text(loadingText); 
                $('#hallnto-frm button[type="submit"]').attr('disabled','disabled');
                var url = $('#hallnto-frm').attr('action');

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $('#hallnto-frm').serialize(),
                    success:function(response){
                        $('#hallnto-frm').trigger("reset");
                        //$('#response-text-hallinto').html(response.message);
                        //showToastNotification('success', response.message);
                        $('#hallnto-frm button[type="submit"]').text(textH);
                        $('#hallnto-frm button[type="submit"]').removeAttr('disabled');
                        //window.location.href = "{{ route('frontend.kiitos') }}";
                        window.location.href = "{{ route('frontend.kiinteistot-ja-taloyhtiot-kiinteistokilpailuttaja-kiitos') }}";
                    },
                    error:function(){
                    showToastNotification('error', errorText);
                    $('#hallnto-frm button[type="submit"]').text(textH);
                    $('#hallnto-frm button[type="submit"]').removeAttr('disabled');
                    }
                });
            }else{
                $('.multiselect-selected-text').html('Ei valintaa'); 
            }
        });

            
        $('.cstm-holto-btn').on('click',function(){
            
            $('.cstm-srtyp-cls').val('Huolto');
        });
        
        $('.cstm-yllp-btn').on('click',function(){
            
            $('.cstm-srtyp-cls').val('Ylläpito');
        });
    
    
        $('.renovation_done_multi').multiselect({ buttonWidth: '100%', nSelectedText: 'valittu',
                    allSelectedText:"kaikki valitut" });
        $('.multiselect-selected-text').html('Ei valintaa');            
    });
		
		
</script>
@endpush