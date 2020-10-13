@extends('frontend.layouts.others')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<section class="property-details">
	<div class="container">
        <h4>{{ $property->city }}</h4>
        @php
            $image = url('/img/frontend/slider_1img.png');
        @endphp
        @if(isset($property->appartment_photo) )
            @php
                $image = url('/img/frontend/slider_1img.png');
                if(isset($property->appartment_photo) &&!empty($property->appartment_photo)){
                    $image = url('/images/contactform/'.$property->appartment_photo);
                }
            @endphp
        @endif
        <div class="detail_hero"><img src="{{ $image }}" alt="{{ $property->title }}"/></div>
    </div>
</section >
<section class="property-details-description">
	<div class="container">
	    <div class="property-description">
	        <p>{{ $property->additional_requests }}</p>
	    </div>
	    <div class="property-contact">
	        <img src="{{url('/img/frontend/fk-icon.jpg')}}" alt=""/>
	        <p>
                <span>Flipkoti</span>
	        </p>
	        <div class="fk-invert_detail-call-me"><a href="tel:0405910540" class="property-contact"><i class="fa fa-phone" aria-hidden="true"></i> Soita!</a></div>
	        <div class="fk-invert_detail-mail-me"><a  href="mailto:miikka.korhonen@flipkoti.fi" class="property-contact"><i class="fa fa-envelope-o" aria-hidden="true"></i> Lähetä viesti!</a></div>
	   </div>
    </div>
</section >

<section class="property-info">
    <div class="container">
        <div class="info-left">
            <div class="info-left-basic">
                <h3>Asunnon Tiedot</h3>
                <hr>
                <p><span class="m-detaillist">Asunnon Tyyppi:</span>{{ $property->property_type }}</p>
                <p><span class="m-detaillist">Kunto:</span>{{ $property->condition }}</p>
                <p><span class="m-detaillist">Minimi pinta-ala:</span>{{ $property->appartment_min_size }}</p>
                <p><span class="m-detaillist">Maksimi pinta-ala:</span>{{ $property->appartment_max_size }}</p>
                <p><span class="m-detaillist">Rakennusvuosi Min:</span>{{ $property->construction_year_min }}</p>
                <p><span class="m-detaillist">Rakennusvuosi Max:</span>{{ $property->construction_year_max }}</p>
            </div>
        </div>
        <div class="info-left">
            <div class="info-left-basic">
                <h3>Asunnon muut tiedot</h3>
                <hr>
                <p><span class="m-detaillist">Minimi Hinta:</span>{{ $property->appartment_min_price }}</p>
                    <p><span class="m-detaillist">Maksimi Hinta:</span>{{ $property->appartment_max_price }}</p>
                    <p><span class="m-detaillist">Huoneiden min määrä:</span>{{ $property->rooms_min }}</p>
                    <p><span class="m-detaillist">Huoneiden max määrä:</span>{{ $property->rooms_max }}</p>
            </div>
        </div>
    </div>
</section>

<section class="property-detail-form">
    <div class="container">

        <h3>Yhteydenottolomake</h3>

            {{ html()->form('POST', route('frontend.store_contact_ostettavat'))->class('property-detail-form')->id('thisform')->open() }}
            <input type="text" name="property_id" value="{{ $property->id }}" class="form-control" id="p-name" style="display:none;"/>
            <input type="text" name="type" value="ostamassa_contact" class="form-control" id="p-name" style="display:none;"/>
            <div class="form-group width-40">
                @include('includes.partials.messages')
            </div>
            <div class="form-group width-40">
                <div>
                <label for="p-name">Nimi</label>
                {{ html()->text('name')
                        ->class('form-control')
                        ->id('p-name')
                        ->attribute('maxlength', 191)
                        ->required() }}
                </div>
                <div>
                <label for="p-Puhel">Puhelinnumero</label>
                {{ html()->text('phone')
                        ->class('form-control')
                        ->id('p-Puhel')
                        ->attribute('maxlength', 15)
                        ->required() }}
                </div>
                <div>
                <label for="p-Sahkoposti">Sähköposti</label>
                {{ html()->email('email')
                        ->class('form-control')
                        ->id('p-Sahkoposti')
                        ->attribute('maxlength', 191)
                        ->required() }}
                </div>
                <input type="hidden" name="subject" value="Yhteydenottolomake">
                {{--<div>
                <label for="p-Aihe">Aihe</label>
                {{
                    html()->select('subject', 
                            [
                                'Haluan lisatietoja tasta kohteesta' => 'Haluan lisatietoja tasta kohteesta',
                                'Haluan lisätietoa Flipkoti toimintaperiaatteista' => 'Haluan lisätietoa Flipkoti toimintaperiaatteista',
                                'Haluan liittyä verkostoon palvelun tarjoajana' => 'Haluan liittyä verkostoon palvelun tarjoajana',
                                'Haluan tehdä +50000€ kertainvestoinnin vauhdittaakseni tuottojen saamista' => 'Haluan tehdä +50000€ kertainvestoinnin vauhdittaakseni tuottojen saamista',
                                'Muu' => 'Muu'
                                
                            ]
                        )
                        ->class('form-control')
                        ->id('p-Aihe')
                        ->required()
                }}
                </div>--}}
                <div>
                <label for="p-Viesti">Viesti</label>
                {{ html()->textarea('message')
                        ->class('form-control')
                        ->id('p-Viesti')
                        ->attribute('rows', 5)
                        ->required() }}
                </div>
                <input type="submit" class="send-btn" value="Lähetä"/>
            </div>
        {{ html()->form()->close() }}
    </div>
</section>

@endsection


@push('after-scripts')
<script>
$(document).ready(function () {
    /*$.validator.addMethod("laxphone", function(value, element) {
        return this.optional( element ) || /^\+|0(?:[0-9] ?){6,14}[0-9]$/.test( value );
    }, 'Anna voimassa oleva yhteysnumero');*/
    $('#thisform').validate({ // initialize the plugin
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
        },
    });

});
</script>
@endpush