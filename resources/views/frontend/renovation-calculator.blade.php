@extends('frontend.layouts.app')
@section('title',__('meta_title_remontoimassa'))
@section('meta_description', __('meta_description_remontoimassa') )

@section('content')
<style>
    .modal-dialog {
        max-width: 500px;
        }
    .modal-body {
            padding: 30px;
        }
    .modal-footer button {
        border-radius: 0px;
    }   
    .btn-primary {
        background-color: #000;
        border-color: #000;
    }
    .btn-primary:hover {
        background-color: #000;
        border-color: #000;
    }
</style>
<!-- <section id="buybanner" class="investing-banner renovationbanner">
    <div class="container">

        <h1>Apartment renovation is not a headache anymore.</h1>
        <p>We take care of the whole process of renovation and you can enjoy your life and sit relax. </p>
        <div class="bannercta">
            <a href="http://www.flipkoti.fi/Meista">
                <span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Laske remontin hinta</font></font></span></a>
        </div>
        
    </div>
</section> -->
<?php
    $langtextarr = Session::get('langtext');
?>
<div class="banner" style="display:none;">
        <img class="d-none d-sm-block" src="{{ url('images/renovate-bg.jpg') }}">
        <img class="d-block d-sm-none" src="{{ url('images/remontoimassa-mobi.jpg') }}">
        <div class="content">
            <h1>
                
                <span>{{ translateText($langtextarr,'Remontoi asuntosi') }}</span><br>
                <span>{{ translateText($langtextarr,'kustannustehokkaasti ilman päänvaivaa') }}</span>
            </h1>
        </div>
</div>

 <section class="renovate-services">
        <div class="container padding-30">
            <h2>{{ translateText($langtextarr,'Tervetuloa käyttämään Flipkodin remonttilaskuria!') }}</h2>
            <p>{{ translateText($langtextarr,'Selvitä remonttisi hinta-arvio. Laske ammattilaisten valitsemien kilpailutettujen materiaalien sekä tekijöiden kustannukset perustiedot syöttämällä. Teetä asunnostasi unelmien koti helposti, ilman päänvaivaa.') }}</p>
            {{ html()->form('POST', route('frontend.reno-calculator-final'))->id('reno-calculator-form')->attribute('novalidate', false)->open() }}
                
            <div class="gird">

                <input type="hidden" id="reno-portion-type" name="portion_type" value="">
                <div class="item">
                    <a href="javascript:void(0)" class="cust-reno-link">
                        <img src="{{ url('images/img17.jpg') }}">
                        <span data-ref="Sauna">{{ translateText($langtextarr,'Sauna') }}</span>
                    </a>
                </div>
                <div class="item">
                    <a href="javascript:void(0)" class="cust-reno-link">
                        <img src="{{ url('images/img18.jpg') }}">
                        <span data-ref="Keittiö">{{ translateText($langtextarr,'Keittiö') }} </span>
                    </a>
                </div>
                <div class="item">
                    <a href="javascript:void(0)" class="cust-reno-link">
                        <img src="{{ url('images/img19.jpg') }}">
                        <span data-ref="Pintaremontti">{{ translateText($langtextarr,'Pintaremontti') }}</span>
                    </a>
                </div>
                <div class="item">
                    <a href="javascript:void(0)" class="cust-reno-link">
                        <img src="{{ url('images/img20.jpg') }}">
                        <span data-ref="Kylpyhuone">{{ translateText($langtextarr,'Kylpyhuone') }} </span>
                    </a>
                </div>
                <div class="item">
                    <a href="javascript:void(0)" class="cust-reno-link">
                        <img src="{{ url('images/img21.jpg') }}">
                        <span data-ref="WC">{{ translateText($langtextarr,'WC') }}</span>
                    </a>
                </div>
                <div class="item">
                    <a href="javascript:void(0)" class="cust-reno-link">
                        <img src="{{ url('images/img22.jpg') }}">
                        <span data-ref="Huoneistoremontti">{{ translateText($langtextarr,'Huoneistoremontti') }}</span>
                    </a>
                </div>

                <input type="submit" id="submit-form" name="submit" style="display:none;">
                
            </div>
            {{ html()->form()->close() }}
        </div>
    </section>

<!-- <section class="laatopart">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 pull-left">
                <h2>Laatu, toimitusvarmuus ja helppous on meille ydin asioita.</h2>
                <p>Haluamme uudistaa remontointia asiakalähtöiseksi.</p>
                <img src="{{asset('renovation/img/maint-img.png')}}" class="imghide">
                <div class="divlaato">
                    Kauttamme saat myös tarvittaessa väliaikaisen kodin<br>
                    edulliseen hintaan, jos remontin teko sitä vaatii.
                </div>
                <div class="divlaato dblock">
                    <em>Saat siis meiltä kaiken tarvittavan yhdellä<br>
                    sopimuksella, sinunedut ja toiveet huomioiden.</em>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
                <img src="{{asset('renovation/img/maint-img.png')}}" class="imgshow">
                {{--<div class="divlaato dnone">
                    <em>Saat siis meilt� kaiken tarvittavan yhdell�<br>sopimuksella, sinunedut ja toiveet huomioiden.</em>
                </div>--}}
            </div>
        </div>
    </div>
</section> -->
<section class="renovate-section">
        <div class="container">
            <div class="row mb-lg-5 mt-lg-5">
                <div class="col-xl-5 col-lg-6">
                    <div class="content">
                        <h2>Näin remontoit Flipkodin kanssa</h2>
                        <p>Flipkoti tarjoaa kaksi palvelutasoa: Basic ja Premium. Tutustu ja valitse tilanteeseesi sopivin palvelutaso remonttilaskurissa!</p>
                    </div>
                </div>
                <div class="col-lg-5 offset-xl-2 offset-lg-1">
                    <div class="content pr-xl-3">
                        <h3>Basic</h3>
                        <p class="small">Kilpailutamme tekijät ja materiaalivalinnat ja saat vähintään kolme tarjousta verkostomme urakoitsijoilta. Luomme sopimukset asiakkaan ja tekijöiden välille. Remontin toteutus ja vastuu on valitsemallasi urakoitsijalla, mutta olemme tavoitettavissa läpi projektin. </p>
                        <h3>Premium</h3>
                        <p class="small">Kannamme kokonaisvastuun remontin laadukkaasta toteutuksesta alusta loppuun tarpeittesi mukaan. </p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="row align-items-center mt-5">
                <div class="col-lg-6">
                    <div class="content">
                        <h2>{{ translateText($langtextarr,'Laatu, toimitusvarmuus ja helppous ovat meille ydinasioita.') }}</h2>
                        <p>{{ translateText($langtextarr,'Haluamme uudistaa remontoinnin asiakaslähtöiseksi.') }}</p>
                        <ul>
                            <li><i class="icon-list-arrow"></i>{{ translateText($langtextarr,'Kauttamme saat myös tarvittaessa väliaikaisen asunnon edulliseen hintaan, jos remontin teko estää asumisen kodissasi. ') }}</li>
                            <li><i class="icon-list-arrow"></i>{{ translateText($langtextarr,'Kaikki tarvittava yhdellä sopimuksella. Sinun edut ja toiveet huomioiden.') }} </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="image-box">
                        <div class="img1"><img src="{{ url('images/img4.jpg') }}"></div>
                        <div class="img2"><img src="{{ url('images/img3.jpg') }}"></div>
                        <div class="img3"><img src="{{ url('images/img5.jpg') }}"></div>
                    </div>
                </div>
            </div>
        </div>
</section>
 <section class="howtoRenovate">
        <div class="container">
            <h3>{{ translateText($langtextarr,'Näin remontoit asunnostasi unelmakodin') }}</h3>
            <div class="grid">
                <div class="item">
                    <i class="icon-edit-file"></i>
                    <p>{{ translateText($langtextarr,'Remontin määrittely ja budjetointi remonttilaskurilla ja sen jälkeen Flipkodin ammattilaisten kanssa.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-chart-map"></i>
                    <p>{{ translateText($langtextarr,'Remontin suunnittelu ja aikataulutus.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-materials1"></i>
                    <p>{{ translateText($langtextarr,'Materiaalien ja urakoitsijoiden valinta.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-users-list"></i>
                    <p>{{ translateText($langtextarr,'Remontointi, remontin johto, viestintä ja dokumentointi osapuolten välillä yhden työkalun kautta.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-note-home"></i>
                    <p>{{ translateText($langtextarr,'Remontin lopputarkastus ja remontoidun asunnon luovutus.') }}</p>
                </div>
                <div class="item">
                    <i class="icon-lovely-home"></i>
                    <p>{{ translateText($langtextarr,'Voit alkaa nauttimaan unelmiesi asunnosta!') }}</p>
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
            <p class="info">{{ translateText($langtextarr,'Laatu, toimitusvarmuus ja helppous ovat meille ydinasioita. Haluamme uudistaa remontointia asiakaslähtöiseksi.') }}</p>
        </div>
    </section>
  
<!-- <section class="buy-home-section">
    <h4>renovation services we provide</h4>
    <div class="container">
        <div class="list-25-box list-33-box">
            <span>Huoneistoremontti</span>
            <span>Saunaremontti </span>
            <span>MAALAUSTYÖT</span>
        </div>
        <div class="list-25-box list-33-box">
            <span>Pintaremontti</span>
            <span>Wc</span>
            <span>LVIS TYÖT</span>
        </div>
        <div class="list-25-box list-33-box">
            <span>KEITTIÖREMONTTI</span>
            <span>Lattiaremontit</span>
        </div>
    </div>
</section> -->
 <section class="through-us">
        <div class="container">
            <h3>{{ translateText($langtextarr,'Kauttamme seuraavat remonttityöt') }}</h3>
            <div class="row">
                <div class="col-md-4">
                    <ul>
                        <li>{{ translateText($langtextarr,'Huoneistoremontti') }}</li>
                        <li>{{ translateText($langtextarr,'Saunaremontti') }}</li>
                        <li>{{ translateText($langtextarr,'Maalaustyöt') }}</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul>
                        <li>{{ translateText($langtextarr,'Pintaremontti') }}</li>
                        <li>{{ translateText($langtextarr,'Wc') }}</li>
                        <li>{{ translateText($langtextarr,'LVIS työt') }}</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul>
                        <li>{{ translateText($langtextarr,'Keittiöremontti') }}</li>
                        <li>{{ translateText($langtextarr,'Lattiaremontit') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
  <section class="presentation-rqst">
        <div class="container">
            <h2>{{ translateText($langtextarr,'Ota yhteyttä') }}</h2>
            <div class="request-form">
                <form method="post" action="{{ route('frontend.professional-enquiry') }}" id="reno-contact_us">
                    @csrf
                     <input type="hidden" name="type" value="renovation" >
                    <div class="row gutters-24">
                        <div class="col-md-6">
                            <div class="row gutters-16">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ translateText($langtextarr,'Etunimi') }}</label>
                                        <input class="form-control" name="first_name" type="text" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>{{ translateText($langtextarr,'Sukunimi') }}</label>
                                        <input class="form-control" name="last_name" type="text" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ translateText($langtextarr,'Puhelinnumero') }}</label>
                                <input class="form-control" type="text" name="phone" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ translateText($langtextarr,'Sähköposti') }}</label>
                                <input class="form-control" type="text" name="email" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ translateText($langtextarr,'Paras aika tavoitella') }}</label>
                                <div class="time-selecter">
                                    <label for="frame1"><input type="radio" id="frame1" value="9-12" name="contact_time"> <span class="form-control">9-12</span></label>
                                    <label for="frame2"><input type="radio" id="frame2" value="12-15" name="contact_time"> <span class="form-control">12-15</span></label>
                                    <label for="frame3"><input type="radio" id="frame3" value="15-18" name="contact_time" checked=""> <span class="form-control">15-18</span></label>
                                    <label for="frame4"><input type="radio" id="frame4" value="18-21" name="contact_time"> <span class="form-control">18-21</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ translateText($langtextarr,'Viesti') }}</label>
                                <textarea class="form-control" name="message" ></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ translateText($langtextarr,'Haluttu yhteydenottotapa') }}</label>
                                <div class="radio v-align">
                                    <label for="radio1"><input type="radio" id="radio1" name="contact_method" value="phone" checked=""><span class="checkmark"></span>{{ translateText($langtextarr,'Puhelin') }}</label>
                                    <label for="radio2"><input type="radio" id="radio2" name="contact_method" value="email"><span class="checkmark"></span>{{ translateText($langtextarr,'Sähköposti') }}</label>
                                    <label for="radio3"><input type="radio" id="radio3" name="contact_method" value="both"><span class="checkmark"></span>{{ translateText($langtextarr,'Molemmat') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                             <div class="form-group">
                                <div class="checkbox checkBoxOyt">
                                    <label class="light" for="terms"><input type="checkbox" class="custom-check" id="terms" name="terms" required=""><span class="checkmark"></span>{{ translateText($langtextarr, 'Olen lukenut Flipkodin') }}  <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link"> {{ translateText($langtextarr, 'tietosuojaselosteen') }}</a> {{ translateText($langtextarr, 'ja') }} <a href="{{ route('frontend.terms') }}" class="custom-link"> {{ translateText($langtextarr, 'käyttöehdot') }}</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-bordered" type="submit">{{ translateText($langtextarr,'Lähetä') }}</button>
                        </div>
                        <p id="response-text"></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section class="renovate-contact">
        <div class="container">
            <p>{{ translateText($langtextarr,'Tilaa asiantuntijamme paikalle ja tehdään unelmistasi totta.') }}<br>{{ translateText($langtextarr,'Tai aloita keskustelu saman tien tästä -') }}  <a href="https://wa.me/358405910540">whatsapp/chat +358405910540</a></p>
        </div>
    </section>
@endsection
@push('after-scripts')
<script>
    $(document).ready(function () {


        /*$.validator.addMethod("laxphone", function (value, element) {
        return this.optional(element) || /^\+|0(?:[0-9] ?){6,14}[0-9]$/.test(value);
        }, 'Anna voimassa oleva yhteysnumero');*/

        $('#reno-contact_us').validate({ // initialize the plugin
            rules: {
                first_name: {required: true},
                last_name: {required: true},
                email: {required: true, email: true},
                phone: {required: true, minlength: 10/*, laxphone: true*/},
                terms: {required: true}
            },
            messages: {
                first_name: {required: 'Pakollinen tieto'},
                last_name: {required: 'Pakollinen tieto'},
                email: {required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite'},
                phone: {required: 'Pakollinen tieto', minlength: 'Tarkastathan, että numerosi on oikenin'},
                terms: {required: 'Pakollinen tieto'}
            },
            errorPlacement: function(error, element) {
                var type = $(element[0]).attr('name');
                if (type == 'terms') {
                    error.insertAfter(".checkBoxOyt");
                }else {
                    error.insertAfter(element);
                }
            }
        });

        $('#reno-contact_us').submit(function(){
            event.preventDefault();
            var text = $('#reno-contact_us button[type="submit"]').text();
            $('#reno-contact_us button[type="submit"]').text(loadingText);

            if($('#reno-contact_us').valid() == true){
                var url = $('#reno-contact_us').attr('action');
                    $.ajax({
                    type: 'POST',
                    url: url,
                    data: $('#reno-contact_us').serialize(),
                    success:function(response){
                        $form = $('#reno-contact_us');
                        $form.find(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val('');
                        $form.find(':checkbox, :radio').prop('checked', false);
                        $('#response-text').html(response.success);
                        $('#reno-contact_us button[type="submit"]').text(text);
                        window.location.href = "{{ route('frontend.remontoimassa-kiitos') }}";
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