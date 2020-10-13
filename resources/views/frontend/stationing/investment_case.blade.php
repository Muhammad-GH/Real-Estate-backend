@extends('frontend.layouts.others')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')

<!-- rent flip case html start here -->
    <section class="fk-rent-flip_case">
    	<div class="container-fluid">
    		<div class="row">
    			<div class="fk-rent-flip_case-head text-center">
    				<h3>Open investment Rent and Flip cases</h3>
    			</div>
    		</div>
    	</div>
    	<div class="container-fluid">
    		<div class="row">
    			<div class="fk-rent-flip_case-wrap">
    				<div class="fk-rent-flip_case-wrap_inner">
						@foreach($investProperties as $property)
							@php
								$image = url('/img/frontend/slider_1img.png');
								if(isset($property->appartment_photo) && !empty($property->appartment_photo) ){
									$theImage = $property->appartment_photo;
									$image = url('/images/contactform/'.$property->id.'/'.$theImage);
								}
							@endphp
    					<div class="fk-rent-flip_case-row">
    						<div class="fk-rent-flip_case-title text-center">
    							<h4>{{ $property->title }}</h4>
    						</div>
    						<div class="fk-rent-flip_case-box">
    							<div class="fk-rent-flip_case-img">
									@guest	
										<img alt="rent-case1" src="{{ $image }}">
									@else
									<a href="{{ route('frontend.user.investment_view', $property->id) }}">
										<img alt="rent-case1" src="{{ $image }}">
									</a>
									@endguest

									
    							</div>
    							<div class="fk-rent-flip_case-content">
    								<div class="fk-rent-flip_case-location_city">
    									<div class="fk-rent-flip_case-location">
    										<h5>{{ $property->location }}</h5>
    									</div>
    									<div class="fk-rent-flip_case-city">
    										<h5>{{ $property->appartment_type }}</h5>
    									</div>
    								</div>
    								<div class="fk-rent-flip_invest_slider">
    									<div class="fk-rent-flip_invest_slider-col">
    										<h6>Sijoitettu</h6>
    										<div class="fk-rent-flip_invest-price">&euro; {{ $property->invest_price }}</div>
										</div>
										@php
										$perc = 0;
										if($property->target_price > 0){
											$perc = ( $property->invest_price / $property->target_price ) * 100;
										}
										@endphp
										<div class="progress" style="width: 50%; text-align: center;">
											<div class="progress-bar" role="progressbar" style="width: {{$perc}}%" aria-valuenow="{{$perc}}" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										
										<div class="fk-rent-flip_invest_slider-col">
    										<h6>Tavoite</h6>
    										<div class="fk-rent-flip_invest-price">&euro; {{ $property->target_price }}</div>
    									</div>
    								</div>
    								<div class="fk-rent-flip_case-profit text-center">
    									Profit potential {{ $property->profit }}%
    								</div>
    								<div class="fk-rent-flip_case-actio-btn text-center">
										@guest
											<a class="fk-check-detail_btn" href="{{ route('frontend.auth.login') }}"  >Check detail</a>
										@else
											<a class="fk-check-detail_btn" href="{{ route('frontend.user.investment_view', $property->id) }}">
											Check detail</a>
										@endguest 	
									
    								</div>
    							</div>
    						</div>
						</div>
						@endforeach

                        <div class="pagination">{!! $investProperties->total() !!} {{ trans_choice('Asuntoa yhteensä|Asuntoa yhteensä', $investProperties->total()) }}
                {!! $investProperties->render() !!}</div>
    				</div>

    			</div>

			</div>
			
    	</div>
    </section>
    <!-- rent flip case html end here -->
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
    // document.getElementById("defaultOpen").click();

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