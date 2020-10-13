@extends('frontend.layouts.calculator')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<?php
    $langtextarr = Session::get('langtext');
?>
    <p class="progress-p"></p>
    <section class="calc whitebgc">
        <div class="container">
            {{ html()->form('POST', route('frontend.calculator'))->id('calculator-form')->attribute('novalidate', true)->open() }}
            <input type="hidden" name="est_apartmentprice" value="<?= $post['est_apartmentprice']?>">
            <input type="hidden" name="avg_discount" value="<?= $post['avg_discount']?>">
            <input type="hidden" name="brokerage" value="<?= $post['brokerage']?>">
            <input type="hidden" name="sales_duration" value="<?= $post['sales_duration']?>">
            <input type="hidden" name="monthly_cost" value="<?= $post['monthly_cost']?>">
            <input type="hidden"  name="portion_type" value="flippauslaskuri tiedot">
            <div  id="step-2">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                        <h4>{{ translateText($langtextarr, 'Syötä asunnon perustiedot selvittääksesi potentiaalin') }} </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="salemonthly inn">
                            <div class="sale averageinput">
                                <label>{{ translateText($langtextarr, 'Asunnon koko') }}</label>
                                <div>
                                    <input type="number" class="form-control" name="area" id="area" value="" />
                                    <span>m2</span>
                                </div>
                                <p class="error error-area"></p>
                            </div>
                            <div class="sale averageinput">
                                <label>{{ translateText($langtextarr, 'Asunnon huoneluku') }}</label>
                                <input type="number" class="form-control" name="rooms" id="rooms" value="" />
                                <p class="error error-rooms"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p class="appcondtion">{{ translateText($langtextarr, 'Asunnon kunto') }}</p>
                        <div class="row">
                            <?php
                            if($appartments->count() > 0){ ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <ul class="radbutton">
                                    <?php
                                    $i =0;
                                    $total = round($appartments->count()/2);

                                    foreach($appartments  as $appartment){
                                    if($total == $i){
                                        break;
                                    } $i++;
                                    ?>
                                    <li>
                                        <p>{{__($appartment->name)}}</p>
                                        <label class="radiofor">{{ translateText($langtextarr, 'Kaipaa uudistusta') }}
                                            <input type="radio"  name="appartment[{{$appartment->id}}]" value="poor_value">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radiofor">{{ __('average') }}
                                            <input type="radio" name="appartment[{{$appartment->id}}]" value="avg_value">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radiofor">{{ translateText($langtextarr, 'Kuin uusi') }}
                                            <input type="radio" name="appartment[{{$appartment->id}}]"
                                                   value="excellent_value">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <?php
                                    } ?>
                                </ul>
                            </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <ul class="radbutton">
                                        <?php
                                        $i =0;
                                        $total = round($appartments->count()/2);
                                        foreach($appartments  as $appartment){
                                        if($total > $i){
                                            $i++;
                                            continue;
                                        } $i++;
                                        ?>
                                        <li>
                                            <p>{{__(ucfirst($appartment->name))}}</p>
                                            <label class="radiofor">{{ translateText($langtextarr, 'Kaipaa uudistusta') }}
                                                <input type="radio"  name="appartment[{{$appartment->id}}]"
                                                       value="poor_value">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radiofor">{{ translateText($langtextarr, 'Tyydyttää') }}
                                                <input type="radio" name="appartment[{{$appartment->id}}]" value="avg_value">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="radiofor">{{ translateText($langtextarr, 'Kuin uusi') }}
                                                <input type="radio" name="appartment[{{$appartment->id}}]"
                                                       value="excellent_value">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <?php
                                        } ?>
                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div  id="step-3" style="display: none;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                        <h4>Syötä perustiedot taloyhtiöstä</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                        <div class="salemonthly inn property">
                            <div class="sale averageinput">
                                <label>{{ translateText($langtextarr, 'Valmistusvuosi') }}</label>
                                <input type="number" name="built_on" class="form-control" id="" value="1984"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                        <p class="appcondtion">{{__('Property condition')}}</p>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="radbutton property">
                                    <?php
                                    if($property->count() > 0){
                                    foreach($property  as $properti){ ?>
                                    <li>
                                        <p>{{ __($properti->name) }}</p>
                                        <label class="radiofor">{{ translateText($langtextarr, 'Remontti tehty viimeisen 10 vuoden aikana') }}
                                            <input type="radio"  name="property[{{$properti->id}}]"
                                                   value="renovated_value">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radiofor">{{ translateText($langtextarr, 'Remontti tiedossa PTS') }}
                                            <input type="radio" name="property[{{$properti->id}}]"
                                                   value="norenovated_value">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="radiofor">{{ translateText($langtextarr, 'Ei tietoa') }}
                                            <input type="radio" name="property[{{$properti->id}}]" value="dontknow_value">
                                            <span class="checkmark"></span>
                                        </label>
                                    </li>
                                    <?php
                                    }
                                    } ?>

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div  id="step-4" style="display: none;">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                        <h4>{{ translateText($langtextarr, 'Missä asuntosi sijaitsee?') }}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="salemonthly">
                            <div class="sale averageinput mb-3">
                                <label>{{ translateText($langtextarr, 'Kaupunki') }}</label>
                                <select class="form-control" name="city">
                                    <?php
                                    if($city->count() > 0){
                                    foreach($city  as $data){ ?>
                                    <option value="<?= $data->id ?>"><?= $data->name ?></option>
                                    <?php
                                    }
                                    } ?>
                                </select>
                            </div>
                            <div class="sale averageinput mb-3">
                                <label>{{ translateText($langtextarr, 'Postinumero') }}</label>
                                <input type="number" name="postal_code" id="postal_code" class="form-control"
                                       placeholder="" value="" maxlength="6">
                                <p class="error error-code"></p>
                            </div>
                        </div>
                        <div class="salemonthly">
                            <div class="sale averageinput mb-3">
                                <label>{{ translateText($langtextarr, 'Sähköpostiosoitteesi') }}</label>
                                <input type="email" name="email" id="email" class="form-control"
                                       placeholder="" value="">
                                <p class="error error-email"></p>
                            </div>
                            <div class="sale averageinput mb-3">
                                <label>{{ translateText($langtextarr, 'Puhelin') }}</label>
                                <input type="number" name="phone" id="phone" class="form-control"  placeholder="" value="" minlength="10" maxlength="10" >
                                <p class="error error-phone"></p>
                            </div>
                        </div>
                        <div class="salemonthly emails mb-3">
                            <div class="sale averageinput">
                                <label>Haluatko saada flippausehdotuksemme?</label>
                                <div class="wouldyou">
                                    <label class="radiofor">{{ translateText($langtextarr, 'Kyllä') }}
                                        <input type="radio" name="p_offer" value="yes">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="radiofor">{{ translateText($langtextarr, 'En') }}
                                        <input type="radio" name="p_offer" value="no">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </section>
    <section class="btndevice">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-sm-12" >
                    <a href="javascript:void(0)" attr-show="step-2" attr-current="step-3" class="btn btn-primary back" style="cursor: not-allowed;">< {{ translateText($langtextarr, 'Takaisin') }}</a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-sm-12">
                    <a href="javascript:void(0)" attr-show="step-3" attr-current="step-2" class="btn btn-secondary next">{{ translateText($langtextarr, 'Seuraava') }} ></a>
                    <button class="btn btn-secondary pull-right" id="submit-btn" type="button" style="display: none;">{{ translateText($langtextarr, 'Lähetä') }}</button>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('after-scripts')
    {!! script('js/jquery.ui.touch-punch.min.js') !!}
    
<script>
    $(document).ready(function () {


        /*$.validator.addMethod("laxphone", function (value, element) {
         return this.optional(element) || /^\+|0(?:[0-9] ?){6,14}[0-9]$/.test(value);
         }, 'Anna voimassa oleva yhteysnumero');*/

        $('#contactform').validate({ // initialize the plugin
            rules: {
                name: {required: true},
                email: {required: true, email: true},
                phone: { required: true,   minlength: 10, maxlength: 15 /*laxphone:true*/},
                subject: {required: true},
                message: {required: true}
            },
            messages: {
                name: {required: 'Pakollinen tieto'},
                email: {required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite'},
                phone: {required: 'Pakollinen tieto', number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
                subject: {required: 'Pakollinen tieto'},
                message: {required: 'Pakollinen tieto'}
            }
        });
        $('#potentialform').validate({ // initialize the plugin
            rules: {
                name: {required: true},
                email: {required: true, email: true},
                phone: { required: true,   minlength: 10, maxlength: 15 /*laxphone:true*/},
                link_sale: {required: true, url: true},
                attach_sale: {required: true}
            },
            messages: {
                name: {required: 'Pakollinen tieto'},
                email: {required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite'},
                phone: {required: 'Pakollinen tieto', number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
                link_sale: {required: 'Pakollinen tieto'},
                attach_sale: {required: 'Pakollinen tieto'}
            }
        });
        $("#apartment").slider({
            range: "min",
            min: 100000,
            max: 10000000,
            value: 100000,
            slide: function (event, ui) {
                $("#est_apartmentprice").val(ui.value);
                calculatePrices();
            }
        });
        $("#est_apartmentprice").change(function () {
            var $this = $(this);
            $("#apartment").slider("value", this.value);

        });
        $("#discount").slider({
            range: "min",
            min: 0,
            max: 10,
            value: 5,
            slide: function (event, ui) {
                $(".sliderValue").val(ui.value);
                calculatePrices();
            }
        });
        $(".sliderValue").change(function () {
            $("#discount").slider("value", this.value);
        });
        $("#broker").slider({
            range: "min",
            min: 0,
            max: 10,
            value: 5,
            slide: function (event, ui) {
                $("#brokerage").val(ui.value);
                calculatePrices();
            }
        });

        $("#brokerage").change(function () {
            $("#broker").slider("value", this.value);
        });

        function ValidatePrices(){
            var est_apartmentprice = parseFloat($("#area").val());
            var avg_discount = parseFloat($("#rooms").val());
            var brokerage = parseFloat($("#brokerage").val());
            var sales_duration = parseFloat($("#sales_duration").val());
            var monthly_cost = parseFloat($("#monthly_cost").val());
            if(est_apartmentprice < 100000){

            }
        }
        $(document).on('click','.back',function(){
            var next_show = $(this).attr('attr-show');
            var current_hide = $(this).attr('attr-current');
            $('.next').show();
            $('#submit-btn').hide();
            $('.progress-p').css('width','33.33%');
            $(this).css('cursor','pointer');
            if(current_hide != 'step-2'){
                $("#"+next_show).fadeIn();
                $("#"+current_hide).hide();
                if(current_hide == 'step-3'){
                     $('.progress-p').css('width','33.33%');
                     prev_div = 'step-2';
                     next_div = 'step-3';
                     current_div = 'step-2';
                     $(this).css('cursor','not-allowed');
                }
                if(current_hide == 'step-4'){
                    $('.progress-p').css('width','66.67%');
                     prev_div = 'step-2';
                     next_div = 'step-4';
                     current_div = 'step-3';
                }
                $(this).attr('attr-show',prev_div);
                $(this).attr('attr-current',current_div);
                $('.next').attr('attr-show', next_div);
                $('.next').attr('attr-current', current_div);
            }else {
                $(this).css('cursor','not-allowed');
            }
        });
        $(document).on('click','.next',function(){
            var reg = /^\d+$/;
            var area = $("#area").val();
            var rooms = $("#rooms").val();
            var areaChk = false;
            $(".error-area").html('');
            $(".error-rooms").html('');
            var status = true;
             if(area.trim() == '' ){
                areaChk = true;
                $("#area").focus();
                $(".error-area").html('Syötä asunnon koko');
                status = false;
             }
             if(!reg.test(area)){
                if(!areaChk){ $("#rooms").focus(); }
                $(".error-rooms").html('Anna oikea numero');
                 status = false;
             }
             if(rooms.trim() == '' ){
                if(!areaChk){ $("#rooms").focus(); }
                 $(".error-rooms").html('Syötä huoneluku');
                 status = false;
             }
             if(!reg.test(rooms)){
                if(!areaChk){ $("#rooms").focus(); }
                $(".error-rooms").html('Anna oikea numero');
                 status = false;
            }
             if(status== false){
                $( document ).scrollTop( 10 );
                return false;
             }
            var next_show = $(this).attr('attr-show');
            var current_hide = $(this).attr('attr-current');
            $('.next').show();
            $('#submit-btn').hide();
            $('.back').css('cursor','pointer');
            if(current_hide != 'step-4'){
                $( document ).scrollTop( 10 );
                if(current_hide == 'step-2'){
                    $('.progress-p').css('width','66.67%');
                     prev_div = 'step-2';
                     next_div = 'step-4';
                     current_div = 'step-3';
                }
                if(current_hide == 'step-3'){
                    $('.progress-p').css('width','100%');
                    $('#submit-btn').show();
                    $('.next').hide();
                     prev_div = 'step-3';
                     next_div = 'last';
                     current_div = 'step-4';
                }
                $("#"+next_show).fadeIn();
                $("#"+current_hide).hide();
                $(this).attr('attr-show', next_div);
                $(this).attr('attr-current', current_div);
                $('.back').attr('attr-show', prev_div);
                $('.back').attr('attr-current', current_div);
            }else{
                $('.progress-p').css('width','33.33%');
            }
        });
        function calculatePrices(){
            var est_apartmentprice = parseFloat($("#est_apartmentprice").val());
            var avg_discount = parseFloat($("#avg_discount").val());
            var brokerage = parseFloat($("#brokerage").val());
            var sales_duration = parseFloat($("#sales_duration").val());
            var monthly_cost = parseFloat($("#monthly_cost").val());

            var totla_m_cost = sales_duration * monthly_cost;
            var totla_avg_cost = est_apartmentprice * (avg_discount/100);
            var totla_brok_cost = est_apartmentprice * (brokerage/100);

            $("#est_total").html("&euro; "+(est_apartmentprice - (totla_m_cost+totla_avg_cost+totla_brok_cost)).toFixed(2));
            $("#total_avg_discount").html("<strong>&euro; "+totla_avg_cost.toFixed(2)+"</strong>");
            $("#total_brokerage").html("<strong>&euro; "+totla_brok_cost.toFixed(2)+"</strong>");
            $("#total_monthly_cost").html("<strong>&euro; "+totla_m_cost.toFixed(2)+"</strong>");
        }

        $(document).on('input','.input-row',function(){
            var id = $(this).attr('id');
            if(id == 'est_apartmentprice'){
                if(/*this.value < 100000 ||*/ this.value > 10000000){
                    alert('Estimated Apartment price cannot be less then 100000 and greater then 10000000!');
                    $("#"+id).val(100000);
                }
                $("#apartment").slider("value", this.value);
            }else
            if(id == 'avg_discount'){
                if(this.value < 0 || this.value > 10){
                    alert('Average discount cannot be less then 0 and greater then 10!');
                    $("#"+id).val(5);
                }
                $("#discount").slider("value", this.value);
            }else
            if(id == 'brokerage'){
                if(this.value < 0 || this.value > 10){
                    alert('Broker rate cannot be less then 0 and greater then 10!');
                    $("#"+id).val(3);
                }
                $("#broker").slider("value", this.value);
            }
            calculatePrices();
        });
        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }
        function validateCal(){
            var email = $("#email").val();
            var status  = true;
            var postal_code = $("#postal_code").val();
            var phone = $("#phone").val();
            var checkVal = false;
            $(".error-code").html('');
            $(".error-email").html('');
            $(".error-phone").html('');
            $( document ).scrollTop( 10 );  
            if(postal_code.trim() == '' || postal_code.length > 5 ){
                $(".error-code").html('Syötä postinumero');
                $("#postal_code").focus();
                checkVal = true;
                status = false;
            }
            if(phone.trim() == '' || phone.length < 9 ){
                $(".error-phone").html('Syötä puhelinnumero');
                if(!checkVal){
                    $("#phone").focus();
                }
                status = false;
            }
            if(email.trim() == '' || IsEmail(email.trim()) == false ){
                $(".error-email").html('Syötä sähköpostiosoite');
                if(!checkVal){
                    $("#email").focus();
                }
                status = false;
            }
            
            return status;
        }
        $(document).on('click','#submit-btn',function(){
            if( validateCal() ==  false){
                return false;
            }
            $("#calculator-form").submit();
        });
    });
</script>
@endpush