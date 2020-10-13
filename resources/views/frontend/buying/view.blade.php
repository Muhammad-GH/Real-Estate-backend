@extends('frontend.layouts.others')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <section class="property-details">
        <div class="container">
            <h4>{{ $property->title }}</h4>
            @php
                $image = url('/img/frontend/slider_1img.png');
                if(isset($property->primaryImage->name) &&!empty($property->primaryImage->name)){
                    $image = url('/images/property/'.$property->id.'/'.$property->primaryImage->name);
                }
            @endphp
            <div class="detail_hero"><img src="{{ $image }}" alt="{{ $property->title }}"/></div>
        </div>
    </section>
    <section class="property-details-description">
        <div class="container">
            <div class="property-description">
                <p>{{ $property->details }}</p>
            </div>
            <div class="property-contact">
                <img src="{{url('/img/frontend/fk-icon.jpg')}}" alt=""/>
                <p>
                    <span>Flipkoti</span>
                </p>
                <div class="fk-invert_detail-call-me"><a href="tel:0405910540" class="property-contact"><i
                                class="fa fa-phone" aria-hidden="true"></i>Soita!</a></div>
                <div class="fk-invert_detail-mail-me"><a href="mailto:miikka.korhonen@flipkoti.fi"
                                                         class="property-contact"><i class="fa fa-envelope-o"
                                                                                     aria-hidden="true"></i> Lähetä
                        viesti!</a></div>
            </div>
        </div>
    </section>

    <section class="property-info">
        <div class="container">
            <div class="info-left ">
                <div class="info-left-basic">
                    <h3>Tiedot</h3>
                    <hr>
                    <p><span>Kaupunki</span> {{ $property->area }}</p>
                    <p><span>Osoite</span> {{ $property->address }}</p>
                    <p><span>Koko</span> {{ $property->size }}</p>
                    <p><span>Huoneet</span> {{ $property->rooms }}</p>
                    <p><span>Myyntihinta</span> {{ $property->price }} €</p>
                    <p><span>Velaton Hinta</span> {{ $property->debt_free_price }} €</p>
                </div>
                <div class="info-left-additional">
                    <h3>Lisätiedot</h3>
                    <hr>
                    <div class="left-div">
                        <p><span>Yhtiövastike</span> {{ $property->month_appartment_cost }} €</p>
                        <p><span>Vesimaksu </span> {{ $property->water_cost }} €</p>
                    </div>
                    <div class="right-div">
                        <p><span>Rahoitusvastike</span> {{ $property->month_appartment_capital }} €</p>
                        <p><span>Muut maksut</span> {{ $property->other_appartment_cost }} €</p>
                    </div>
                </div>
            </div>
            <div class="info-right">
                <h3>Yleiset tiedot</h3>
                <hr>
                <div class="left-div">
                    <p><span>Kiinteistön nimi</span> {{ $property->name }}</p>
                    <p><span>Rakennusvuosi </span> {{ $property->built_year }}</p>
                    <p><span>Tulevat Remontit</span> {{ $property->planned_renovation }}</p>
                    <p><span>Tontin omistus</span> {{ $property->land_ownership }}</p>
                    <p><span>Lämmitysmuoto </span> {{ $property->heating_method }}</p>
                </div>
                <div class="right-div">
                    <p><span>Isännöitsijä</span> {{ $property->manager_name }}</p>
                    <p><span>Huoneistojen Määrä</span> {{ $property->apartment_no }}</p>
                    <p><span>Tehdyt Remontit</span> {{ $property->done_renovation }}</p>
                    <p><span>Tontin pinta-ala</span> {{ $property->land_area }}</p>
                </div>

            </div>
        </div>
    </section>
    @if( count($property->propertyImage) > 0 )
        <section class="property-gallery">
            <div class="container">
                <h3>Gallery</h3>
                @foreach($property->propertyImage as $propImage)
                    <div class="gal_img"><img src="{{ url('/images/property/'.$property->id.'/'.$propImage->name) }}"
                                              alt=""/></div>
                @endforeach
            </div>
        </section>
    @endif

    <section class="property-detail-form">
        <div class="container">

            <h3>Yhteydenottolomake</h3>
            {{ html()->form('POST', route('frontend.store_contact_property'))->class('property-detail-form')->id('thisform')->open() }}
            <input type="text" name="property_id" value="{{ $property->id }}" class="form-control" id="p-name"
                   style="display:none;"/>
            <div class="form-group width-40">
                @include('includes.partials.messages')
            </div>
            <div class="form-group width-40">
                <label for="p-name">Nimi</label>
                {{ html()->text('name')
                        ->class('form-control')
                        ->id('p-name')
                        ->attribute('maxlength', 191)
                        ->required() }}
            </div>
            <div class="form-group width-40">
                <label for="p-Puhel">Puhelinnumero</label>
                {{ html()->text('phone')
                        ->class('form-control')
                        ->id('p-Puhel')
                        ->attribute('maxlength', 10)
                        ->required() }}
            </div>
            <div class="form-group width-40">
                <label for="p-Sahkoposti">Sähköposti</label>
                {{ html()->email('email')
                        ->class('form-control')
                        ->id('p-Sahkoposti')
                        ->attribute('maxlength', 191)
                        ->required() }}
            </div>
            <input type="hidden" name="subject" value="Yhteydenottolomake">
            {{--<div class="form-group width-40">
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
            <div class="form-group width-40">
                <label for="p-Viesti">Viesti</label>
                {{ html()->textarea('message')
                        ->class('form-control')
                        ->id('p-Viesti')
                        ->attribute('rows', 5)
                        ->required() }}
                <input type="submit" class="send-btn" value="Lähetä"/>
            </div>
            {{ html()->form()->close() }}
        </div>
    </section>
    <!-- <pre>
@php
        echo count($property->propertyImage);
        print_r($property);

    @endphp
            </pre> -->
    <!-- @lang('strings.frontend.welcome_to', ['place' => app_name()]) -->
@endsection

@push('after-scripts')
<script>
    $(document).ready(function () {
        /*$.validator.addMethod("laxphone", function (value, element) {
            return this.optional(element) || /^\+|0(?:[0-9] ?){6,14}[0-9]$/.test(value);
        }, 'Anna voimassa oleva yhteysnumero');*/

        $('#thisform').validate({ // initialize the plugin
            rules: {
                name: {required: true},
                email: {required: true, email: true},
                phone: {required: true, minlength: 10/*, laxphone: true*/},
                subject: {required: true},
                message: {required: true}
            },
            messages: {
                name: {required: 'Pakollinen tieto'},
                email: {required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite'},
                phone: {required: 'Pakollinen tieto', minlength: 'Tarkastathan, että numerosi on oikenin'},
                subject: {required: 'Pakollinen tieto'},
                message: {required: 'Pakollinen tieto'}
            }
        });

    });
</script>
@endpush