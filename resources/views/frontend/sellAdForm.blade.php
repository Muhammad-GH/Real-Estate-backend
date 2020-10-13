 @extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
 <?php
    $langtextarr = Session::get('langtext');
?>
 <div class="details-form">
        <div class="container">
            <h2>{{ translateText($langtextarr,'Kerro vielä tarkemmat tiedot kiinteistöstäsi.') }}</h2>
            {{ html()->form('POST', route('frontend.sell_ad'))->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->id('apartmentform')->open() }}
                <div class="card">
                    <div class="card-body">
                        <div class="head">
                            <input type="text" value="myymassa" name="type" class="form-control left " style="display:none" >
                            <h3>{{ translateText($langtextarr,'Kiinteistön tiedot') }}</h3>
                            <p>* {{ translateText($langtextarr,'pakolliset kentät') }}</p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="radio d-inline-block">
                                        <label for="radio11"><input type="radio" id="radio11" name="service" value="offer property to flipkod" checked=""> <span class="checkmark"></span> Haluan tarjota kiinteistöä Flipkodille</label>&nbsp; &nbsp;
                                        <label for="radio12"><input type="radio" id="radio12" name="service" value="flip the property with flipkod" name="radio"><span class="checkmark"></span> Haluan flipata kiinteistön Flipkodin kanssa</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xl-7 col-lg-12">
                                        <div class="form-group">
                                            <label>Lisää sijainti tai postinumero</label>
                                            <input class="form-control" name="postalCode" value="{{ $postalCode }}" placeholder="Esim. kouvola tai 02111">
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-12">
                                        <div class="form-group">
                                            <label>Kiinteistön koko</label>
                                            <div class="input-group">
                                                <input type="number" name="apartment_size" class="form-control" placeholder="">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">m<sup>2</sup></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-7 col-lg-12">
                                        <div class="form-group">
                                            <label>Kiinteistötyyppi</label>
                                            <div class="radio">
                                                <label for="radio1"><input type="radio" id="radio1" name="property_type" value="Asuinkiinteistö" checked=""><span class="checkmark"></span>Asuinkiinteistö</label>
                                                <label for="radio2"><input type="radio" id="radio2" name="property_type" value="Teollisuuskiinteistö"><span class="checkmark"></span>Teollisuuskiinteistö</label>
                                                <label for="radio3"><input type="radio" id="radio3" name="property_type" value="Liikekiinteistö"><span class="checkmark"></span>Liikekiinteistö</label>
                                                <label for="radio4"><input type="radio" id="radio4" name="property_type" value="Tontti"><span class="checkmark"></span>Tontti</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-12">
                                        <div class="form-group">
                                            <label>Asunnon kunto</label>
                                            <div class="checkbox">
                                                <label for="checkbox1"><input type="checkbox" id="checkbox1" name="condition[]" checked="" value="Loistava"><span class="checkmark"></span>Loistava</label>
                                                <label for="checkbox2"><input type="checkbox" id="checkbox2" name="condition[]" value="Tyydyttävä"><span class="checkmark"></span>Tyydyttävä</label>
                                                <label for="checkbox3"><input type="checkbox" id="checkbox3" name="condition[]" value="Hyvä"><span class="checkmark"></span>Hyvä</label>
                                                <label for="checkbox4"><input type="checkbox" id="checkbox4" name="condition[]" value="Välttävä"><span class="checkmark"></span>Välttävä</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Taloyhtiön kunto</label>
                                            <textarea class="form-control" name="additional_requests" aria-describedby="discr"></textarea>
                                            <small id="discr" class="form-text text-muted">
                                                (kirjoita lisätietoja yhtiöstä, kuten PTS suunnitelma, tehdyt remontit)
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xl-7 col-lg-12">
                                        <div class="form-group">
                                            <label>Hinta-arviosi kiinteistöstä</label>
                                            <div class="input-group">
                                                <input type="text" name="appartment_max_price" class="form-control">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">€</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-12">
                                        <div class="form-group">
                                            <label>Rakennusvuosi</label>
                                            <select name="built_year" class="form-control" id="sel1">
                                                <option value="">{{ translateText($langtextarr,'Rakennusvuosi') }}</option>
                                                <?php 
                                                for($i=1800;$i<=date('Y')+2;$i++){
                                                echo '<option value='.$i.'>'.$i.'</option>';    
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-xl-3">
                                    <div class="col-xl-5 col-lg-12">
                                        <div class="form-group">
                                            <label>Huoneistojen lukumäärä</label>
                                            <select class="form-control" name="no_rooms" id="sel1">
                                                <option value="">{{ translateText($langtextarr,'Huoneiden lukumäärä') }}</option>
                                                <?php 
                                                    for($i=0;$i<=500;$i++){
                                                        echo '<option value='.$i.'>'.$i.'</option>';    
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-7 col-lg-12">
                                        <div class="form-group">
                                            <label>Osoite tai Kiinteistön nimi</label>
                                            <input type="text" name="address" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Kuvia kiinteistöstä</label>
                                            <div class="file-select">
                                                <input type="file" name="appartment_photo" id="file">
                                                <label for="file">
                                                    <i class="icon-attachment"></i>
                                                    <span class="filename">Ei valittua tiedostoa</span>
                                                    <span class="clear">+</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="head">
                            <h3>Yhteystiedot</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Nimi</label>
                                    <input class="form-control" name="name" type="text" placeholder="Etunimi, Sukunimi">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Puhelinnumero</label>
                                    <input class="form-control" name="phone" type="text" placeholder="+358 0123456">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    <label>Sähköposti</label>
                                    <input class="form-control" name="email" type="text" placeholder="esim. maija@flipkoti.fi">
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="checkbox row-c">
                                        <label class="light" for="terms"><input type="checkbox" class="custom-check" id="terms" name="terms" required=""><span class="checkmark"></span>{{ translateText($langtextarr, 'Olen lukenut Flipkodin') }}  <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link"> {{ translateText($langtextarr, 'tietosuojaselosteen') }}</a> {{ translateText($langtextarr, 'ja') }} <a href="{{ route('frontend.terms') }}" class="custom-link"> {{ translateText($langtextarr, 'käyttöehdot') }}</a></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Lähetä</button>
            {{ html()->form()->close() }}
        </div>
    </div>
  
    @endsection
@push('after-scripts')
<script>
    $(document).ready(function () {
        /*$.validator.addMethod("laxphone", function(value, element) {
            return this.optional( element ) || /^\+|0(?:[0-9] ?){6,14}[0-9]$/.test( value );
        }, 'Anna voimassa oleva yhteysnumero');*/

        $('#apartmentform').validate({ // initialize the plugin
            rules: {
                name: { required: true },
                email: { required: true, email: true },
                phone: { required: true,   minlength: 10, maxlength: 15 /*laxphone:true*/},
                city: { required: true },
                address: { required: true },
                built_year: { required: true },
                property_type: { required: true },
                appartment_max_price: { required: true },
                no_rooms: { required: true },
                'condition[]': { required: true },
                apartment_size: { required: true },
                additional_requests: { required: true },
                terms: { required: true }
            },
            messages: {
                name: { required: 'Pakollinen tieto' },
                email: { required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite' },
                phone: { required: 'Pakollinen tieto',number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
                city: { required: 'Pakollinen tieto' },
                address: { required: 'Pakollinen tieto' },
                built_year: { required: 'Pakollinen tieto' },
                property_type: { required: 'Pakollinen tieto' },
                appartment_max_price: { required: 'Pakollinen tieto' },
                no_rooms: { required: 'Pakollinen tieto' },
                'condition[]': { required: 'Pakollinen tieto' },
                apartment_size: { required: 'Pakollinen tieto' },
                additional_requests: { required: 'Pakollinen tieto' },
                terms: { required: 'Pakollinen tieto' }
            },
            errorPlacement: function(error, element) {
                var type = $(element[0]).attr('name');
                if (type == 'condition[]') {
                    error.insertAfter(".condition");
                }else if (type == 'property_type') {
                    error.insertAfter(".property_type");
                }
                else if(type == 'terms'){
                    error.insertAfter('.row-c');
                }
                else {
                    error.insertAfter(element);
                }
            }
        });
    });
</script>
@endpush