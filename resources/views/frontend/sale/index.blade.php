@extends('frontend.layouts.app')

@section('title',__('meta_title_ostamassa'))
@section('meta_description', __('meta_description_ostamassa') )
@section('meta_image',   url('images/meta/buying-bg.jpg')  )


@section('content')
<?php
    $langtextarr = Session::get('langtext');
?>
<div class="inline-editable" id="editable">  
    @if($pageContent && !empty($pageContent->html_content) )
		<?php echo $pageContent->html_content; ?>
	@else
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
                    <p>Täytä asuntokriteerit alla olevaan lomakkeeseen ja jätä anonyymi osto-ilmoitus.</p>
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
                    <i class="icon-file-edit"></i>
                    <p>Laadimme sopimuksen. Maksat meille palkkion ainoastaan, mikäli löydät haluamasi asunnon kauttamme ja teet kaupat.</p>
                </div>
                <div class="item">
                    <i class="icon-refresh2"></i>
                    <p>Esittelemme flip -potentiaalit sekä valmiiksi kriteerejäsi vastaavat kohteet.</p>
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
    @endif
</div>
    <!--section class="find-location">
        <div class="container">
            <h2>Haluatko löytää unelmiesi asunnon? Täytä tulevan kotisi vaatimukset</h2>
            <form>
                <label>Missä haluaisit asua?</label>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Lisää sijainti tai postinumero">
                    <button type="submit">Jatka</button>
                </div>
            </form>
        </div>
    </section-->

	<!--section class="Service-new-section">
		<div class="container">
			<div class="box-3 box-1-n">
				<div class="head-box">
					<h3>Nopea</h3>
					<span>7€/m2 </span>
				</div>
				<div class="bottom-box">
					<p>Get a plan with 3d renders (visulise a potential in BUY/Sell situation)</p>
					<a href="#" data-toggle="modal" data-target="#contactmodel"> SELECT </a>
				</div>
			</div>
			<div class="box-3 box-2-n">
				<div class="head-box">
					<h3>Helppo</h3>
					<span>10€/m2 </span>
				</div>
				<div class="bottom-box">
					<ul>
						<li>3d rendering</li>
						<li>Renovation plan with timetable</li>
						<li>Contractor bidding + recommendation</li>
						<li>Agreement with contractor</li>
						<li>Material bidding and delivery</li>
					</ul>
					<a href="#" data-toggle="modal" data-target="#contactmodel"> SELECT </a>
				</div>
			</div>
			<div class="box-3 box-3-n">
				<div class="head-box">
					<h3>Avaimet käteen</h3>
					<span>12€/m2 </span>
				</div>
				<div class="bottom-box">
					<p>No own money needed if don’t want, you earn- we take a risk</p>
					<span> OR </span>
					<p>50% of value increase- costs (in selling situation)</p>
					<a href="#" data-toggle="modal" data-target="#contactmodel"> SELECT </a>
				</div>
			</div>
		</div>
	</section-->
	<a name="jataosto"></a>
	  <section class="find-location">
        <div class="container">
			<h2>{{ translateText($langtextarr,'Laadimme sopimuksen. Maksat meille palkkion ainoastaan, mikäli löydät haluamasi asunnon kauttamme ja teet kaupat') }}</h2>
			<form action="{{ route('frontend.find-apartment') }}" method="post">
                @csrf
                <label>{{ translateText($langtextarr,'Missä haluaisit asua?') }}</label>
                <div class="form-group">
                    <input type="text" class="form-control" name="postal_code" placeholder="Lisää sijainti tai postinumero">
                    <button class="btn btn-bordered" type="submit">{{ translateText($langtextarr,'Jatka') }}</button>
                </div>
            </form>
        </div>
    </section>
<!-- ContactModel -->
<div class="modal fade" id="contactmodel" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				{{ html()->form('POST', route('frontend.sale'))->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->id('contactform')->open() }}
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
				<h4 class="border-h">{{ translateText($langtextarr,'Yhteyshenkilö') }}</h4>
				<input type="hidden" name="subject" value="Yhteydenottolomake">
				{{--<div class="form-group width-100">
					<label for="subject">{{ translateText($langtextarr,'Aihe') }}</label>
					<select class="form-control"  name="subject" id="sel1" placeholder="Searching real estate investment cases">
						<option value="Haluan lisätietoa Flipkoti toimintaperiaatteista" >{{ translateText($langtextarr,'Haluan lisätietoa Flipkoti toimintaperiaatteista.') }}</option>
						<option value="Haluan liittyä verkostoon palvelun tarjoajana" >{{ translateText($langtextarr,'Haluan liittyä verkostoon palvelun tarjoajana') }}</option>
						<option value="Haluan tarjota huoneistoa tai kiinteistöä Flipkodille" >{{ translateText($langtextarr,'Haluan tarjota huoneistoa tai kiinteistöä Flipkodille') }}</option>
						<option value="Haluan tehdä +50000€ kertainvestoinnin vauhdittaakseni tuottojen saamista" >{{ translateText($langtextarr,'Haluan tehdä +50000€ kertainvestoinnin vauhdittaakseni tuottojen saamista') }}</option>
						<option value="Muu" >{{ translateText($langtextarr,'Muu') }}</option>
					</select>
				</div>--}}
				<div class="form-group width-100">
					<label for="message">{{ translateText($langtextarr,'Viesti') }}</label>
					<textarea  name="message" class="form-control text-area" rows="5" id="comment" required></textarea>
				</div>
				<button type="submit" class="btn-sbmt" >{{ translateText($langtextarr,'Lähetä') }}</button>
				{{ html()->form()->close() }}
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="potential" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body">
				{{ html()->form('POST', route('frontend.sale'))->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->id('potentialform')->open() }}
				<input type="text" value="potential" name="type" class="form-control left " style="display:none" >
				<div class="form-group width-50">
					<input type="text" name="name" class="form-control left">
				</div>
				<div class="form-group width-50">
					<label for="phone">{{ translateText($langtextarr,'Puhelinnumero') }}</label>
					<input type="text" name="phone" class="form-control left">
				</div>
				<div class="form-group width-100">
					<label for="email">{{ translateText($langtextarr,'Sähköposti') }}</label>
					<input type="text" name="email" class="form-control left">
				</div>
				<h4 class="border-h">{{ translateText($langtextarr,'halautko selvittää asunnon potentiaalin?') }}</h4>
				<div class="form-group width-100">
					<label for="link_sale">{{ translateText($langtextarr,'lisää linkki myynti-ilmoitukseen') }}</label>
					<input type="text" name="link_sale" class="form-control left">
				</div>
				<div class="form-group width-100">
					<label for="attach_sale">{{ translateText($langtextarr,'Lisää liite') }}</label>
					<input type="file" name="attach_sale" class="form-control left">
				</div>
				<button type="submit" class="btn-sbmt btn btn-bordered" >{{ translateText($langtextarr,'Lähetä') }}</button>
				{{ html()->form()->close() }}
			</div>
		</div>
	</div>
</div>
<!-- @lang('strings.frontend.welcome_to', ['place' => app_name()]) -->
@endsection
@push('after-scripts')
<script>
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
				phone: { required: 'Pakollinen tieto',minlength:'Tarkastathan, että numerosi on oikenin'},
				subject: { required: 'Pakollinen tieto' },
				message: { required: 'Pakollinen tieto' }
			}
		});
		
	    $('#apartmentform').validate({ // initialize the plugin
			rules: {
				name: { required: true },
				email: { required: true, email: true },
				phone: { required: 'Pakollinen tieto',number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
				city: { required: true },
				appartment_min_size: { required: true },
				appartment_max_size: { required: true },
				property_type: { required: true },
				appartment_min_price: { required: true },
				appartment_max_price: { required: true },
				'condition[]': { required: true },
				additional_requests: { required: true },
				construction_year_max: { required: true },
				construction_year_min: { required: true },
				rooms_min: { required: true },
				rooms_max: { required: true },
				rooms_max: { required: true }
			},
			messages: {
				name: { required: 'Pakollinen tieto' },
				email: { required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite' },
				phone: { required: 'Pakollinen tieto',number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
				city: { required: 'Pakollinen tieto' },
				appartment_min_size: { required: 'Pakollinen tieto' },
				appartment_max_size: { required: 'Pakollinen tieto' },
				property_type: { required: 'Pakollinen tieto' },
				appartment_min_price: { required: 'Pakollinen tieto' },
				appartment_max_price: { required: 'Pakollinen tieto' },
				'condition[]': { required: 'Pakollinen tieto' },
				additional_requests: { required: 'Pakollinen tieto' },
				construction_year_max: { required: 'Pakollinen tieto' },
				construction_year_min: { required: 'Pakollinen tieto' },
				rooms_min: { required: 'Pakollinen tieto' },
				rooms_max: { required: 'Pakollinen tieto' },
				rooms_max: { required: 'Pakollinen tieto' }
			},
			errorPlacement: function(error, element) {
				var type = $(element[0]).attr('name');
				if (type == 'condition[]') {
					error.insertAfter(".condition");
				}else if (type == 'property_type') {
					error.insertAfter(".property_type");
				}
				else {
					error.insertAfter(element);
				}
			}
		});
		$('#potentialform').validate({ // initialize the plugin
			rules: {
				name: { required: true },
				email: { required: true, email: true },
				phone: { required: true,   minlength: 10, maxlength: 15 /*laxphone:true*/},
				link_sale: { required: true , url: true },
				attach_sale: { required: true }
			},
			messages: {
				name: { required: 'Pakollinen tieto' },
				email: { required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite' },
				phone: { required: 'Pakollinen tieto',number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
				link_sale: { required: 'Pakollinen tieto' },
				attach_sale: { required: 'Pakollinen tieto' }
			}
		});
		
});
</script>
@endpush
<!-- @lang('strings.frontend.home.know_value') -->