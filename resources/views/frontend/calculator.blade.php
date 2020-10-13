@extends('frontend.layouts.calculator')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <?php
    $langtextarr = Session::get('langtext');
    ?>
    <style>
        .fulbox .btn.primary {
            background: #000;
        }
    </style>
    {{--<section class="thankyou-page">
        <div class="content">
            <div class="logo">
                <img src="../images/flipkoti-ft-logo.png" alt="">
            </div>
            <div class="heading">
                <h2>Kiitos kun käytit Remonttilaskuria!</h2>

                <p>Asiantuntijamme on sinuun yhteydessä valitsemanasi ajankohtana!</p>
            </div>
            <div class="image-box">
                <img src="../images/thankyou.jpg" alt="">
            </div>
            <div class="info">--}}
    <section class="calc whitebgc">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <h4><?= $final_text ?></h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-8 col-xs-12 flipauto">
                    <div class="flipbox">
                        <?= $final_total ?>
                    </div>
                </div>
                <div class="col-lg-7 col-md-5 col-sm-8 col-xs-12 flipauto">
                    <p class="restarttext">{{ translateText(Session::get('langtext'), 'Jos et ole tyytyväinen tulokseen voit') }}
                        <a href="<?= isset($type) && $type == 'renovation-calculator' ? url('/remontoimassa') :   url('/flippauslaskuri');?>"> {{ translateText(Session::get('langtext'), 'aloittaa alusta') }}</a>
                        {{ translateText(Session::get('langtext'), 'laskennan tai voit ottaa meihin yhteyttä alla olevan lomakkeen kautta') }}
                    </p>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </section>
    <section class="whtmore" style="background:#fff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <img src="<?= url('/');?>/img/catlogue.png">

                    <h3>{{ $type == 'flip' ? translateText(Session::get('langtext'), 'Varaa ilmainen puhelinaika asiantuntijamme kalenterista') : translateText(Session::get('langtext'), 'Varaa maksuton remontin suunnitteluaika') }}
                        <span>{{ $type == 'flip' ?  translateText(Session::get('langtext'), 'Saat parhaat ehdotukset, miten voit maksimoida asuntosi voiton')  : translateText(Session::get('langtext'), 'Saat parhaat ehdotukset, miten edetä remonttisi kanssa') }}</span></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 formwant">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" enctype="multipart/form-data" action="{{ route('frontend.home.send') }}" id="contactForm">
                               @csrf
                               <input type="hidden"  name="type" value="{{ $type }}">
                               <input type="hidden"  name="portion_type" value="{{ $portion_type }}">
                                <div class="fulbox half">
                                    <div class="fullcont">
                                        <label>{{ translateText(Session::get('langtext'), 'Valitse päivämäärä') }}</label>
                                        <input type="text" name="datepicker" id="datepicker" autocomplete="off"
                                               value=""
                                               class="form-control" >
                                    </div>
                                    <div class="fullcont">
                                        <label>{{ translateText(Session::get('langtext'), 'Valitse Aika') }}</label>
                                        <input type="time" name="time" id="time" autocomplete="off" value=""
                                               class="form-control" >
                                    </div>
                                </div>
                                <div class="fulbox half">
                                    <div class="fullcont">
                                        <label>{{ translateText(Session::get('langtext'), 'Etunimi') }}</label>
                                        <input type="text" name="fname" placeholder="" value="{{isset($first_name) ? $first_name : ''}}"
                                               class="form-control" >
                                    </div>
                                    <div class="fullcont">
                                        <label>{{ translateText(Session::get('langtext'), 'Sukunimi') }}</label>
                                        <input type="text" name="lname" placeholder="" value="{{isset($last_name)? $last_name : ''}}"
                                               class="form-control" >
                                    </div>
                                </div>
                                <div class="fulbox">
                                    <div class="fullcont">
                                        <label>{{ translateText(Session::get('langtext'), 'Sähköpostiosoite') }} </label>
                                        <input type="email" name="email" placeholder=""  value="{{isset($email)? $email : ''}}"
                                               class="form-control" >
                                    </div>
                                </div>
                                <div class="fulbox">
                                    <div class="fullcont">
                                        <label>{{ translateText(Session::get('langtext'), 'Puhelinnumero') }} </label>
                                        <input id="phone" name="phone" placeholder="" value="{{isset($phone) ? $phone : ''}}" type="tel"
                                               class="form-control" >
                                    </div>
                                </div>
                        </div>
                        <div class="col-lg-12 ">
                            <div class="fulbox">
                                <div class="fullcont">
                                    <label>{{ translateText(Session::get('langtext'), 'Viesti') }} </label>
                                    <textarea class="form-control" name="message"></textarea>
                                </div>
                            </div>
                        </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label class="light" for="termsR" style="width:100%;">
                                            <input type="checkbox" class="custom-check" id="termsR" name="termsR" required=""><span class="checkmark"></span>{{ translateText($langtextarr, 'Olen lukenut Flipkodin') }}  <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link"> {{ translateText($langtextarr, 'tietosuojaselosteen') }}</a> {{ translateText($langtextarr, 'ja') }} <a href="{{ route('frontend.terms') }}" class="custom-link"> {{ translateText($langtextarr, 'käyttöehdot') }}</a>
                                        </label>
                                    </div>
                                    <label class="error error-termsR"></label>
                                </div>
                            </div>




                        <input type="hidden" name="subject" value="Yhteydenottolomake">
                        <input type="hidden" name="code" id="code" value="+1">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="fulbox">
                                <input type="button" name="submit" id="contactform_btn" value="Lähetä"
                                       class="btn primary">
                                <input type="submit" name="submit" id="submit_btn" value="Lähetä"
                                       class="btn primary" style="display: none;">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--</div>
</div>
</section>--}}


@endsection
@push('after-styles')
{{ style('/css/intlTelInput.css') }}
{{ style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css') }}
{{ style('https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') }}
@endpush
@push('after-scripts')
{!! script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js') !!}
{!! script('/js/intlTelInput.js') !!}
<script>
    $(document).ready(function () {
        $("#datepicker").datepicker();
        var input = document.querySelector("#phone");
        // on blur: validate
        $(document).on('click', '#contactform_btn', function () {
            var code = $(".iti__active").find('.iti__dial-code').html();
            $("#code").val(code);
            $("#submit_btn").click();
        });


        /*window.intlTelInput(input, {

            // allowDropdown: false,
            // autoHideDialCode: false,
            // autoPlaceholder: "off",
            // dropdownContainer: document.body,
            // excludeCountries: ["us"],
            // formatOnDisplay: false,
            // geoIpLookup: function(callback) {
            //   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            //     var countryCode = (resp && resp.country) ? resp.country : "";
            //     callback(countryCode);
            //   });
            // },
            // hiddenInput: "full_number",
            // initialCountry: "auto",
            // localizedCountries: { 'de': 'Deutschland' },
            // nationalMode: false,
            // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            // placeholderNumberType: "MOBILE",
            // preferredCountries: ['cn', 'jp'],
            // separateDialCode: true,
            utilsScript: "js/utils.js",
        });*/




        $('#contactForm').validate({

            // initialize the plugin
            rules: {
                datepicker: {required: true},
                time: {required: true},
                fname: {required: true},
                lname: {required: true},
                email: {required: true, email: true},
                phone: { required: true,   minlength: 10, maxlength: 15 /*laxphone:true*/},
                //subject: {required: true}, 'additional_selection[]': {required: true},
                message: {required: true}
            },
            messages: {
                datepicker: {required: 'Pakollinen tieto'},
                time: {required: 'Pakollinen tieto'},
                fname: {required: 'Pakollinen tieto'},
                lname: {required: 'Pakollinen tieto'},
                email: {required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite'},
                phone: {required: 'Pakollinen tieto', number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
                ///subject: {required: 'Pakollinen tieto'},'additional_selection[]': {required: 'Pakollinen tieto'},
                message: {required: 'Pakollinen tieto'}
            },
            errorPlacement: function(error, element) {
                var type = $(element[0]).attr('name');
                if (type == "input[name='termsR']") {
                    error.insertAfter("error-termsR");
                }
                else {
                    error.insertAfter(element);
                }

                // error.insertAfter(element);
                /* terms check */
                // $(document).on('click', '#submit_btn', function () {

                //     var termsR = $("input[name='termsR']");
                //     $(".error-termsR").html('');
                //     if (!termsR.is(':checked')) {
                //         $(".error-termsR").html( "{{__('Please accept terms and condition')}}" );
                //         return false;
                //     }
                //     $("#contactForm").submit();
                // });
                /* terms check */

            }
        });




    });
</script>
@endpush
