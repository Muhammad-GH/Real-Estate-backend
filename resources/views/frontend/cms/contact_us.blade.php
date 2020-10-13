@extends('frontend.layouts.others')

@section('title',__('meta_title_ota-yhteytta'))
@section('meta_description', __('meta_description_ota-yhteytta') )
@section('meta_image',   url('images/meta/fkbg.jpg')  )

@section('content')

<?php $langtextarr = Session::get('langtext'); ?>
 <div class="banner">
        <img class="d-none d-sm-block" src="{{ url('images/fkbg.jpg') }}">
        <img class="d-block d-sm-none" src="{{ url('images/ota-yhteytta-mobi.jpg') }}">
        <div class="content">
            <h1>
                <span>Ota yhteyttä, pidämme puolesi</span><br>
                <span>asuntokaupoilla!</span>
            </h1>
        </div>
    </div>
    <section class="contact-page">
        <div class="container">
            <h2>Asiakaspalvelu</h2>
            <div class="row">
                <div class="col-md-4">
                    <img class="contact-logo" src="images/contact-logo.jpg">
                </div>
                <div class="col-md-8">
                    <div class="row justify-content-between">
                        <div class="col-sm">
                            <h3>Kuluttajille</h3>
                            <ul class="list-unstyled">
                                <li>
                                    <i class="icon-phone"></i> 0405910540
                                </li>
                                <li>
                                    <i class="icon-envelope"></i> info@flipkoti.fi
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm">
                            <h3>Ammattilaisille</h3>
                            <ul class="list-unstyled">
                                <li>
                                    <i class="icon-phone"></i> 0505504446
                                </li>
                                <li>
                                    <i class="icon-envelope"></i> info@flipkoti.fi
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix chr"></div>
            <div class="row">
                <div class="col-md-4">
                    <h2>Yritys</h2>
                </div>
                <div class="col-md-8">
                    <h3>
                        Flipkoti Oy<br>
                        Vanha Kaarelantie 33 A<br>
                        01610 Vantaa
                    </h3>
                </div>
            </div>
        </div>
    </section>
  <section class="form-section form-section-cutom-10">
        <div class="container cust-container" style="max-width: 1040px;">
            <h4>Yhteydenottolomake </h4>
            <div id="appartment_detail_result"></div>
            <div id="contact_result"></div>

            {{ html()->form('POST', route('frontend.contact_us'))->class('top-form-box')->id('contact_us')->open() }}
            <input type="text" value="contact" name="type" class="form-control left " style="display:none">
            <div class="form-group width-100">
                @include('includes.partials.messages')
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="p-name">Nimi</label>
                        {{ html()->text('name')
                                ->class('form-control')
                                ->id('p-name')
                                ->attribute('maxlength', 191)
                                                        ->required() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="p-Puhel">Puhelinnumero</label>
                        {{ html()->text('phone')
                                ->class('form-control')
                                ->id('p-Puhel')
                                ->attribute('maxlength', 15)->required() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="p-Sahkoposti">Sähköposti</label>
                        {{ html()->email('email')
                                ->class('form-control')
                                ->id('p-Sahkoposti')
                                ->attribute('maxlength', 191)
                                ->required() }}
                    </div>
                </div>
            </div>


            <input type="hidden" name="subject" value="Yhteydenottolomake">

            {{--<div class="form-group width-100">
                <label for="p-Aihe">Aihe</label>
                {{
                    html()->select('subject',
                            [
                                'Haluan lisätietoa Flipkodin toimintaperiaatteista' => 'Haluan lisätietoa Flipkodin toimintaperiaatteista',
                                'Haluan liittyä verkostoon palvelun tarjoajana' => 'Haluan liittyä verkostoon palvelun tarjoajana',
                                'Haluan tarjota huoneistoa tai kiinteistöä Flipkodille' => 'Haluan tarjota huoneistoa tai kiinteistöä Flipkodille',
                                'Haluan tehdä +50000€ kertainvestoinnin vauhdittaakseni tuottojen saamista' => 'Haluan tehdä +50000€ kertainvestoinnin vauhdittaakseni tuottojen saamista',
                                'Muu' => 'Muu'
                            ]
                        )
                        ->class('form-control')
                        ->id('p-Aihe')
                        ->required()
                                }}
            </div>--}}
            <div class="form-group width-100">
                <label for="p-Viesti">Viesti</label>
                {{ html()->textarea('message')
                        ->class('form-control cust-text')
                        ->id('p-Viesti')
                        ->attribute('rows', 5)
                        ->required() }}
            </div>
            <div class="row">
                <div class="col-md-12 form-group width-100">
                    <div class="checkbox">
                        <label class="light" for="terms">
                        <input type="checkbox" class="custom-check" id="terms" name="terms" required="">
                        <span class="checkmark"></span>{{ translateText($langtextarr, 'Olen lukenut Flipkodin') }}  <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link"> {{ translateText($langtextarr, 'tietosuojaselosteen') }}</a> {{ translateText($langtextarr, 'ja') }} <a href="{{ route('frontend.terms') }}" class="custom-link"> {{ translateText($langtextarr, 'käyttöehdot') }}</a></label>
                    </div>
                </div>
                <label id="terms-error" class="error" for="terms">  </label>
            </div>
                           
            <button type="submit" class="btn-sbmt" >Lähetä</button>
            <p id="response-text"></p>
            {{ html()->form()->close() }}
        </div>

    </section>

     <!-- @lang('strings.frontend.welcome_to', ['place' => app_name()]) -->
@endsection
@push('after-scripts')
<script>
    $(document).ready(function () {
        /*$.validator.addMethod("laxphone", function (value, element) {
            return this.optional(element) || /^\+|0(?:[0-9] ?){6,14}[0-9]$/.test(value);
        }, 'Anna voimassa oleva yhteysnumero');*/

        $('#contact_us').validate({ // initialize the plugin
            rules: {
                name: {required: true, maxlength: 50 },
                email: {required: true, email: true},
                phone: { required: true,   minlength: 10, maxlength: 15 /*laxphone:true*/},
                subject: {required: true},
                message: {required: true, maxlength: 1000 },
                terms: {required: true}
            },
            messages: {
                name: {required: 'Pakollinen tieto' , maxlength:'Kirjoita korkeintaan 50 merkkiä.'},
                email: {required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite'},
                phone: { required: 'Pakollinen tieto',number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
                subject: {required: 'Pakollinen tieto'},
                message: {required: 'Pakollinen tieto' , maxlength:'Kirjoita korkeintaan 1000 merkkiä.'},
                terms: {required: 'Pakollinen tieto'}
            }

        });
        $('#contact_us').submit(function(){
            event.preventDefault();
            var text = $('#contact_us button[type="submit"]').text();
            $('#contact_us button[type="submit"]').text(loadingText);
            if($('#contact_us').valid() == true){
                var url = $('#contact_us').attr('action');
                 $.ajax({
                    type: 'POST',
                    url: url,
                    data: $('#contact_us').serialize(),
                    success:function(response){
                        $form = $('#contact_us');
                        $form.find(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
                        $form.find(':checkbox, :radio').prop('checked', false);
                        $('#response-text').html(response.success);
                        $('#contact_us button[type="submit"]').text(text);
                        window.location.href = "{{ route('frontend.ota-yhteytta-kiitos') }}";
                    },
                    error:function(){
                        $('#response-text').html(errorText);
                        showToastNotification('error', "{{__('Something went wrong.')}}");
                    }
                });
            }
        });
    });
</script>
@endpush
