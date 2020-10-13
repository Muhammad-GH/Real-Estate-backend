@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<style>
    .calculater-section {
        padding: 70px 0;
    }
    .form-group {
        width: 100%;
    }
</style>
<?php $langtextarr = Session::get('langtext'); ?>
<section class="calculater-section">
   <div class="container padding-40">
      <h2>Tervetuloa flippauslaskuriin!</h2>
      <p>Laske kannattaako asuntosi Flippaus</p>
      <div class="calculater-box">
         <form method="POST" action="{{route('frontend.calculator_final')}}" id="calculator-form" novalidate="1">
            {{csrf_field()}}
            <div class="row">
               <div class="col-lg-6">
                  <div class="row">
                     <div class="col-md-6 col-sm-4">
                        <div class="form-group">
                           <label for="est_apartmentprice">Välittäjien antamien<br> pyyntihintojen keskiarvot</label>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-8">
                        <div class="input-group">
                           <input type="number" name="est_apartmentprice" value="100000" class="form-control" id="est_apartmentprice">
                           <div class="input-group-append">
                              <div class="input-group-text">&euro;</div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div id="apartment"></div>
                  </div>
                  <div class="row">
                     <div class="col-sm-8">
                        <div class="form-group">
                           <label for="avg_discount">Keskimääräinen alennus</label>
                           <div id="discount"></div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="input-group">
                           <input type="number" id="avg_discount" name="avg_discount" class="sliderValue form-control" value="5" />
                           <div class="input-group-append">
                              <div class="input-group-text">&#37;</div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-8">
                        <div class="form-group">
                           <label for="brokerage">Välittäjän palkkio</label>
                           <div id="broker"></div>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <div class="input-group">
                           <input type="number" name="brokerage" class="form-control" id="brokerage" value="3"/>
                           <div class="input-group-append">
                              <div class="input-group-text">&#37;</div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <label for="sales_duration">Arvioitu myyntiaika nykykunnossa</label>
                        <div class="input-group">
                           <input type="number" class="input-row form-control" name="sales_duration" id="sales_duration" value="3"/>
                           <div class="input-group-append">
                              <div class="input-group-text">Kuukautta</div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <label for="monthly_cost">Kuukausikulu<br>&nbsp;</label>
                        <div class="input-group">
                           <input type="number" class="input-row form-control" name="monthly_cost" id="monthly_cost" value="300"/>
                           <div class="input-group-append">
                              <div class="input-group-text">&euro;</div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-6">
                  <div class="card">
                     <div class="card-body">
                        <div class="item">
                           <p>Asunnon arvo sinulle</p>
                           <h3 id="est_total">&euro; 91100</h3>
                        </div>
                        <div class="item">
                           <div class="row">
                              <div class="col-sm-4">
                                 <p class="small">Todennäköinen kauppahinta</p>
                                 <h3 class="small" id="total_avg_discount">&euro; 5000</h3>
                              </div>
                              <div class="col-sm-4">
                                 <p class="small">Välittäjän palkkio<br>&nbsp;</p>
                                 <h3 class="small" id="total_brokerage">&euro; 3000</h3>
                              </div>
                              <div class="col-sm-4">
                                 <p class="small">Kuukausikulu<br>&nbsp;</p>
                                 <h3 class="small" id="total_monthly_cost">&euro; 900</h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <p class="text-center">Selvitä asuntosi potentiaalinen arvo</p>
                  <a href="javascript:void(0)" class="btn btn-primary conbtn">Selvitä&nbsp;></a>
               </div>
            </div>
         </form>
         <!-- <p class="text-center know">Know more about flipping Appartments <span>?</span></p> -->
      </div>
      <a href="#" class="more"></a>
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
            max: 2000000,
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
            value: 3,
            slide: function (event, ui) {
                $("#brokerage").val(ui.value);
                calculatePrices();
            }
        });

        $("#brokerage").change(function () {
            $("#broker").slider("value", this.value);
        });

        function ValidatePrices() {
            var est_apartmentprice = parseFloat($("#area").val());
            var avg_discount = parseFloat($("#rooms").val());
            var brokerage = parseFloat($("#brokerage").val());
            var sales_duration = parseFloat($("#sales_duration").val());
            var monthly_cost = parseFloat($("#monthly_cost").val());
        }

        $(document).on('click', '.conbtn', function () {
            $('#calculator-form').submit();
        });
        function calculatePrices() {
            var est_apartmentprice = parseFloat($("#est_apartmentprice").val());
            var avg_discount = parseFloat($("#avg_discount").val());
            var brokerage = parseFloat($("#brokerage").val());
            var sales_duration = parseFloat($("#sales_duration").val());
            var monthly_cost = parseFloat($("#monthly_cost").val());

            var totla_m_cost = sales_duration * monthly_cost;
            var totla_avg_cost = est_apartmentprice * (avg_discount / 100);
            var totla_brok_cost = est_apartmentprice * (brokerage / 100);

            $("#est_total").html("&euro; " + (est_apartmentprice - (totla_m_cost + totla_avg_cost + totla_brok_cost)).toFixed(2));
            $("#total_avg_discount").html("<strong>&euro; " + totla_avg_cost.toFixed(2) + "</strong>");
            $("#total_brokerage").html("<strong>&euro; " + totla_brok_cost.toFixed(2) + "</strong>");
            $("#total_monthly_cost").html("<strong>&euro; " + totla_m_cost.toFixed(2) + "</strong>");
        }

        $(document).on('input', '.input-row', function () {
            var id = $(this).attr('id');
            if (id == 'est_apartmentprice') {
                if (/*this.value < 100000 ||*/ this.value > 10000000 || this.value == '') {
                    alert('Estimated Apartment price cannot be empty or greater then 10000000!');
                    $("#" + id).val(100000);
                }
                $("#apartment").slider("value", this.value);
            } else if (id == 'avg_discount') {
                if (this.value < 0 || this.value > 10 || this.value == '') {
                    alert('Average discount cannot be less then 0 and greater then 10!');
                    $("#" + id).val(5);
                }
                $("#discount").slider("value", this.value);
            } else if (id == 'brokerage') {
                if (this.value < 0 || this.value > 10 || this.value == '') {
                    alert('Broker rate cannot be less then 0 and greater then 10!');
                    $("#" + id).val(3);
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
    });
</script>
@endpush

