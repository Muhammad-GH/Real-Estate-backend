@extends('frontend.layouts.others')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<!-- investment detail html start here -->
    <section class="fk-invert_detail">
        <div class="container">
            <div class="fk-invert_detail-row">
                <div class="fk-invert_detail-left">
                    <div class="fk-invert_detail-head">
                        <div class="fk-invert_detail-head_col">
                            <h3>{{ $investProperty->title }}</h3>
                        </div>
                        <div class="fk-invert_detail-head_col">
                            <!-- <div class="fk-invert_detail-social-likes">
                                <img alt="likes-icon" src="img/likes-icon.png">
                            </div> -->
                        </div>
                    </div>
                    <div class="fk-invert_detail-slider">
                        <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
                            <!-- Overlay -->
                            <div class="overlay"></div>
							<!-- Wrapper for slides -->
							@if(isset($investProperty->investmentImage) && count($investProperty->investmentImage) > 0 )
                            <div class="carousel-inner">
								@foreach($investProperty->investmentImage as $key => $theImage)
									@php
										$image = url('/images/investProperty/'.$investProperty->id.'/'.$theImage->name);
									@endphp
									<div class="item slides @if($key == 0) active @endif ">
										<div class="fk-invert_detail-slider-img">
											<img alt="flip-case-lg-img" src="{{ $image }}">
										</div>
									</div>
								@endforeach
                            </div>
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
								@foreach($investProperty->investmentImage as $key => $theImage)
									<li data-target="#bs-carousel" data-slide-to="{{$key}}" class="@if($key == 0) active @endif "></li>
								@endforeach
							</ol>
							@endif
                        </div>
                    </div>
                    <div class="fk-invert_detail-overview">
                        <div class="fk-invert_detail-overview_inner text-center">
                            <h4>Yhteenveto</h4>
                            <p>{{ $investProperty->details }}</p>
                        </div>
                    </div>
                </div>
                <div class="fk-invert_detail-right">
                	<div class="fk-invert_detail-right_inner text-center">
                		<div class="fk-invert_detail-table">
                			<div class="fk-invert_detail-table-row">
                				<div class="fk-invert_detail-table-col">Hankintahinta</div>
                				<div class="fk-invert_detail-table-col">€ {{ $investProperty->price }}</div>
                			</div>
                			<!--div class="fk-invert_detail-table-row">
                				<div class="fk-invert_detail-table-col">Selling price</div>
                				<div class="fk-invert_detail-table-col">{{ $investProperty->selling_price }}</div>
                			</div-->
                			<div class="fk-invert_detail-table-row">
                				<div class="fk-invert_detail-table-col">Vuokratuotto</div>
                				<div class="fk-invert_detail-table-col">{{ $investProperty->profit }}%, €</div>
                			</div>
                			<div class="fk-invert_detail-table-row">
                				<div class="fk-invert_detail-table-col">Vuokratulo/kk</div>
                				<div class="fk-invert_detail-table-col">€ {{ $investProperty->net_return }}</div>
                			</div>
                			<div class="fk-invert_detail-table-row">
                				<div class="fk-invert_detail-table-col">Arvon nousupotentiaali</div>
                				<div class="fk-invert_detail-table-col">{{ $investProperty->capital_growth }}%</div>
                			</div>
                			<!--div class="fk-invert_detail-table-row">
                				<div class="fk-invert_detail-table-col">Asset Liquidation</div>
                				<div class="fk-invert_detail-table-col">{{ $investProperty->liquidation }}</div>
                			</div-->
                			<div class="fk-invert_detail-table-action-btn text-center">
								@guest
									<a href="{{ route('frontend.auth.login') }}" id="fk-invest-now_btn">
                                Katso lisätietoja</a>
                                @else
                                    @if( $user->userDetail && $user->userDetail->address && $user->userDetail->city && $user->userDetail->phone && $user->userDetail->personal_id)
                                        <button data-toggle="modal" data-target="#fk-investment" id="fk-invest-now_btn" type="submit">
                                Katso lisätietoja</button>
                                    @else
                                        <a href="{{ route('frontend.user.dashboard') }}" id="fk-invest-now_btn">
                                Katso lisätietoja</a>
                                    @endif
								@endguest 
                			</div>
                		</div>
                		<div class="fk-invert_detail-contact-box">
                			<div class="fk-invert_detail-contact-box_inner">
                				<div class="fk-invert_detail-user-img">
									<img alt="user-img" src="{{url('/img/frontend/fk-icon.jpg')}}">
                				</div>
                				<div class="fk-invert_detail-user-details">
                                    <p><span>Flipkoti</span></p>
                                    <!-- <p>Designation</p> -->
                				</div>
                				<div class="fk-invert_detail-contact-btns">
                					<div class="fk-invert_detail-call-me">
                						<a href="tel:0405910540"><i class="fa fa-phone" aria-hidden="true"></i> Soita!</a>
                					</div>
                					<div class="fk-invert_detail-mail-me">
                						<a href="mailto:miikka.korhonen@flipkoti.fi"><i class="fa fa-envelope-o" aria-hidden="true"></i> Lähetä viesti!</a>
                					</div>
                				</div>
                			</div>
                		</div>
                	</div>
                </div>
            </div>
        </div>
    </section>
    <!-- investment detail html end here -->
	@guest
	@else
    <!-- The modal -->
    <div class="modal fade" id="fk-investment" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="fk-investment_modal">
						{{ html()->form('POST', route('frontend.user.investment_view', $investProperty->id) )->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->id('fk-investment_form')->open() }}
							<input type="hidden" class="form-control" name="user_id" value="{{$user->id}}"  required>
							<input type="hidden" class="form-control" name="invest_property_id" value="{{$investProperty->id}}" required>
                            <div class="form-group">
                                <label>Sijoitettava pääoma</label>
                                <div class="form-input">
                                    <input type="number" class="form-control" name="price" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sijoitusaika</label>
                                <div class="form-input">
                                    <select class="form-control form-select-option" name="investment_time">
                                        <option value="One time investment" >Kertasijoitus</option>
                                        <option value="Long time investment" >Pitkääikaissopimus</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group full-width">
                                <label>Sijoitana olen</label>
                                <div class="form-input">
                                    <div class="form-input_radio">
                                        <div class="form-input_radio-col">
                                            <div class="form-input_radio-box">
                                                <input type="radio" name="Individual" checked="@if($user->userDetail && $user->userDetail->type == 'individual') true @else false @endif" readonly>
                                                <label>Yksityishenkilö</label>
                                            </div>
                                        </div>
                                        <div class="form-input_radio-col">
                                            <div class="form-input_radio-box">
                                                <input type="radio" name="Individual"  checked="@if($user->userDetail && $user->userDetail->type != 'individual') true @else false @endif" readonly>
                                                <label>Yritys</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Etunimi</label>
                                <div class="form-input">
                                    <input type="text" class="form-control" name="" value="{{ $user->first_name}}" readonly >
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sukunimi</label>
                                <div class="form-input">
                                    <input type="text" class="form-control" name="" value="{{$user->last_name}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sähköposti</label>
                                <div class="form-input">
                                    <input type="email" class="form-control" name="" value="{{$user->email}}"  readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Osoite</label>
                                <div class="form-input">
                                    <input type="text" class="form-control" name="" value="{{($user->userDetail && $user->userDetail->address)?$user->userDetail->address:''}}" readonly >
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Kaupunki</label>
                                <div class="form-input">
                                    <input type="text" class="form-control" name=""  value="{{($user->userDetail && $user->userDetail->city)?$user->userDetail->city:''}}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Puhelinnumero</label>
                                <div class="form-input">
                                    <input type="text" class="form-control" name=""  value="{{($user->userDetail && $user->userDetail->phone)?$user->userDetail->phone:''}}" readonly >
                                </div>
                            </div>
                            <!--div class="form-group">
                                <label>Identity </label>
                                <div class="form-input">
                                    <input type="number" class="form-control" name=""  value="{{$user->userDetail && $user->userDetail->personal_id}}" readonly >
                                </div>
                            </div-->
                            <div class="form-group" style="float: right; width: 100%; flex: none;  max-width: 100%;">
                                <a href="{{ route('frontend.user.account') }}" class="editinfo"><i class="fa fa-pencil"></i>Edit Info</a></label>
                            </div>

                            <div class="form-group-ckeckbox full-width">
                                <ul>
                                    @foreach($pdf as $pdfData)
                                        @php
                                            $image = url('/images/pdf/'.$pdfData->id.'/'.$pdfData->document);
                                        @endphp
                                        <li><a href="{{$image}}" target="_blank">{{$pdfData->name}}</a></li>
                                    @endforeach    
                                    <!-- <li>Read general terms of use</li>
                                    <li>Read investment terms</li>
                                    <li>Read investment risks</li> -->
                                </ul>
                                <div class="fk-investment-checbox">
                                    <div class="fk-investment-checkbox_inner">
                                        <input type="checkbox" name="agree_terms" value="1" >
                                        <label>Hyväksyn ja ymmärrän riskit ja ehdot</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-submit full-width">
                                <button id="fk-investment_btn" type="submit">Vahvista</button>
                            </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
		</div>
		
	</div>
	@endguest 

    <!-- investment cost html start here -->
    <section class="fk-invest-cost">
    	<div class="container">
    		<div class="col-lg-6 col-md-6">
    			<div class="fk-invest-cost-renovation">
    				<h3>Arvonnoston yhteenveto</h3>
    				<ul>
    					<li>Kylpyhuone : {{ $investProperty->bathroom }}</li>
    					<li>Keittiö  : {{ $investProperty->kitchen }}</li>
    					<li>Maalaus : {{ $investProperty->painting }}</li>
    					<li>Lattiat : {{ $investProperty->flooring }}</li>
    					<li>Sisustus : {{ $investProperty->interior_design }}</li>
    				</ul>
				</div>
				@if(isset($investProperty->document) && !empty($investProperty->document))
                    @php
                        $image = url('/images/investProperty/'.$investProperty->id.'/'.$investProperty->document);
                    @endphp
    			<div class="fk-invest-download-brochure">
    				<h3>Esite</h3>
    				<div class="fk-invest-download-brochure_btn">
    					<a href="{{ $image }}" target="_blank" >Lataa lisätiedot</a>
    				</div>
				</div>
				@endif
    		</div>
    		<div class="col-lg-6 col-md-6">
    			<div class="fk-invest-other_cost">
    				<h3>Muut Kustannukset</h3>
    				<div class="fk-invest-other_cost-row">
    					<div class="fk-invest-other_cost-left">
    						<div class="fk-invest-other_cost-left-row">
	    						<h4>Välityspalkkio</h4>
	    						<p>{{ $investProperty->broker_fee }}</p>
	    					</div>
    						<div class="fk-invest-other_cost-left-row">
	    						<h4>Kiinteät kustannukset/kk</h4>
	    						<p>{{ $investProperty->taxes }}</p>
	    					</div>
    					</div>
    					<div class="fk-invest-other_cost-right">
    						<div class="fk-invest-other_cost-left-row">
	    						<h4>Verot</h4>
	    						<p>{{ $investProperty->monthly_cost }}</p>
	    					</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
	<!-- investment cost html end here -->
	<!-- @php
		echo "<pre>";
		print_r($investProperty);
		echo "</pre>";
	@endphp -->
@endsection


@push('after-scripts')
<script>
    $(document).ready(function () {
        $('#fk-investment_form').validate({ // initialize the plugin
            rules: {
                price: { required: true },
                investment_time: { required: true },
                agree_terms: { required: true }
            },
            messages: {
                price: { required: 'Pakollinen tieto' },
                investment_time: { required: 'Pakollinen tieto' },
                agree_terms: { required: 'Pakollinen tieto'}
            }
        });
    
    });
</script>
@endpush
<!-- @lang('strings.frontend.home.know_value') -->