 @extends('frontend.layouts.app')

@section('title','Asuntokaupan alusta')

@section('content')
 <?php
    $langtextarr = Session::get('langtext');
?>
<div class="details-form">
    <div class="container">
        <h2>Täytä ensin huoneistosi perustiedot</h2>
        {{ html()->form('POST', route('frontend.sell_ad'))->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->id('apartmentform')->open() }}
        <input type="text" value="myymeille" name="type" class="form-control left " style="display:none" >
        @if ($postalCode)
        <input type="text" value="thankyou" name="thankyou" class="form-control left " style="display:none" >
        @endif
        <div class="card">
            <div class="card-body">
                <div class="head">
                    <h3>Asunnon tiedot</h3>
                    <p>* pakolliset kentät</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xl-7 col-lg-12">
                                <div class="form-group">
                                    <label for="postalCode">Lisää sijainti tai postinumero</label>
                                    <input type="text" name="postalCode" class="form-control" value="{{ $postalCode }}" placeholder="Esim. kouvola tai 02111">
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-12">
                                <div class="form-group">
                                    <label for="apartment_size">Asunnon koko</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" placeholder="" name="apartment_size">
                                        <div class="input-group-append">
                                            <span class="input-group-text">m<sup>2</sup></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- row end -->
                        <div class="row">
                            <div class="col-xl-7 col-lg-12">
                                <div class="form-group">
                                    <label>Asuntotyyppi</label>
                                    <div class="radio">
                                        <label for="radio1"><input type="radio" id="radio1" name="property_type" value="Omakotitalo" checked=""><span class="checkmark"></span>Omakotitalo</label>
                                        <label for="radio2"><input type="radio" id="radio2" name="property_type" value="Rivitalo"><span class="checkmark"></span>Rivitalo</label>
                                        <label for="radio3"><input type="radio" id="radio3" name="property_type" value="Kerrostalo"><span class="checkmark"></span>Kerrostalo</label>
                                        <label for="radio4"><input type="radio" id="radio4" name="property_type" value="Paritalo"><span class="checkmark"></span>Paritalo</label>
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
                        </div> <!-- row end -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Taloyhtiön kunto</label>
                                    <textarea class="form-control" aria-describedby="discr" name="additional_requests" rows="5"></textarea>
                                    <small id="discr" class="form-text text-muted">
                                        (kirjoita lisätietoja yhtiöstä, kuten PTS suunnitelma, tehdyt remontit)
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label>Kuvia asunnostasi</label>
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
                        </div><!-- row end -->
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-xl-7 col-lg-12">
                                <div class="form-group">
                                    <label>Hinta-arviosi asunnosta</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="appartment_max_price">
                                        <div class="input-group-append">
                                            <span class="input-group-text">€</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 col-lg-12">
                                <div class="form-group">
                                    <label for="built_year">Rakennusvuosi</label>
                                    <select name="built_year" class="form-control" id="sel1">
                                        <option value="">Rakennusvuosi</option>
                                        <?php 
                                        for($i=1800;$i<=date('Y')+2;$i++){
                                        echo '<option value='.$i.'>'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div><!-- row end -->
                        <div class="row mb-lg-3">
                            <div class="col-xl-5 col-lg-12">
                                <div class="form-group">
                                    <label for="no_rooms">Huoneiden lukumäärä</label>
                                    <select class="form-control" name="no_rooms" id="sel2">
                                        <option value="">Huoneiden lukumäärä</option>
                                        <?php 
                                        for($i=0;$i<=10;$i++){
                                        echo '<option value='.$i.'>'.$i.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-12">
                                <div class="form-group">
                                    <label for="address">Osoite tai taloyhtiön nimi</label>
                                    <input type="text" class="form-control" name="address">
                                </div>
                            </div>
                        </div><!-- row end -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="additional_selection">Huoneiston lisätiedot</label>
                                    <textarea class="form-control" name="additional_selection" rows="5" ></textarea>
                                </div>
                            </div>
                        </div><!-- row end -->
                    </div><!-- col-6 -->
                </div><!-- Row End -->
                <div class="head">
                    <h3>Yhteystiedot</h3>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label>Nimi</label>
                            <input class="form-control" name="name" type="text" placeholder="Etunimi Sukunimi">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label>Puhelinnumero</label>
                            <input class="form-control" type="text" placeholder="+358 0123456" name="phone">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="form-group">
                            <label>Sähköposti</label>
                            <input class="form-control" type="text" placeholder="esim. maija@flipkoti.fi" name="email">
                        </div>
                    </div>
                </div><!-- Row End -->
                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="checkbox">
                            <label class="light" for="terms"><input type="checkbox" class="custom-check" id="terms" name="terms"><span class="checkmark"></span>Olen lukenut Flipkodin <a href="{{ route('frontend.tietosuojaseloste') }}" class="custom-link">tietosuojaselosteen</a> ja <a href="{{ route('frontend.terms') }}" class="custom-link">käyttöehdot</a></label>
                        </div>
                    </div>
                </div>
                </div><!-- Row End -->
            </div>
        </div>
        @php
        $btnText = 'Valitse palvelut';
        if((isset($_COOKIE['asuntosi-type']) && $_COOKIE['asuntosi-type'] == 'LKVFlip') || isset($postalCode)){
            $btnText = 'Lähetä';
        }
        @endphp
        <button typr="submit" class="btn btn-primary">{{ $btnText }}</button>
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
            name: { required: true,  maxlength: 50 },
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
            additional_requests: { required: true, maxlength: 1000  },
            additional_selection : {  maxlength: 1000  },
            appartment_photo: { extension: "jpg|png|gif|jpeg" },
            terms: { required: true}
        },
        messages: {
            name: { required: 'Pakollinen tieto' ,maxlength:'Kirjoita korkeintaan 50 merkkiä.'},
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
            additional_requests: { required: 'Pakollinen tieto' ,  maxlength: 'Kirjoita korkeintaan 1000 merkkiä.' },
            appartment_photo: { extension: "Valitse kelvollinen kuva." },
            additional_selection : {  maxlength: 'Kirjoita korkeintaan 1000 merkkiä.'  },
            terms: { required: 'Pakollinen tieto'}
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
});
</script>
@endpush