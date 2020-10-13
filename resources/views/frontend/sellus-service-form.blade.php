@extends('frontend.layouts.calculator')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<style>
    .calculatorbox label {
        display: inline-block;
        margin-left: 10px;
    }
    .contain input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }
    .checkmarks {
        position: absolute;
        top: 0;
        left: 0;
        height: 17px;
        width: 17px;
        background-color: #fff;
        border: 2px solid #d8d8d8;
    }

    .contain:hover input ~ .checkmarks {
        background-color: #ccc;
    }

    .contain input:checked ~ .checkmarks {
        background-color: #fff;
    }

    .checkmarks:after {
        content: "";
        position: absolute;
        display: none;
    }

    .contain input:checked ~ .checkmarks:after {
        display: block;
    }

    .contain .checkmarks::after {
        left: 4px;
        top: 1px;
        width: 5px;
        height: 10px;
        border: solid #141414;
        border-width: 0 2px 2px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>
    <p class="progress-p" style="width:100%"></p>
    <section class="calc whitebgc btndevice">
        <div class="container">
            {{ html()->form('POST', route('frontend.sellus-services-submission'))->id('sellus-service-form')->open() }}
            <input type="hidden" name="contactFormId" value="{{$id}}">
            <input type="hidden" name="appartment_size" value="{{$appartment_size}}">
            <input type="hidden" name="total" value="">
            <div class="calculatorbox service-form-inner">
                <div class="row">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                            <h4>Valitse palvelut, jotka haluat lisätä tarjouspyyntöön</h4>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <p class="error error-rooms-selection"></p>
                    </div>
                    @foreach($sell_services as $row)
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="parent-item">
                            <label class="contain r-rooms-label" for="service{{$row->service_id}}">
                                @php
                                    $price = 0;
                                    if($row->pricing == 'fixed'){
                                        $price = $row->price;
                                    }
                                    if($row->pricing == 'variable'){
                                        $price = budgetGetPriceVariable($appartment_size, $row->price_range);
                                    }
                                    $special_offer = 0;
                                    if($row->special_offer == 1){
                                        $special_offer = $row->special_offer;
                                    }
                                @endphp
                                <input type="checkbox" class="special_offer_{{$row->service_id}} service-input" name="services[]" data-unit="{{$row->price_type}}" data-price="{{$price}}" id="service{{$row->service_id}}" value="{{$row->service_id}}">
                                {{--<strong class="h4" style="display: inline-block; margin:0 0 10px -15px"></strong>--}}
                                {{$row->name}}
                                @if($price)
                                    <strong>{{$price}}€</strong>
                                    @php echo budgetTypeFormat($row->price_type) @endphp
                                    <span class="checkmarks"></span>
                                @endif
                                
                                @if($row->child_services)
                                    @foreach($row->child_services as $rowdata)
                                        <div class="parent-item">
                                            <label class="contain r-rooms-label" for="service{{$rowdata->service_id}}">
                                                @php
                                                    $price = 0;
                                                    if($rowdata->pricing == 'fixed'){
                                                        $price = $rowdata->price;
                                                    }
                                                    if($rowdata->pricing == 'variable'){
                                                        $price = budgetGetPriceVariable($appartment_size, $rowdata->price_range);
                                                    }
                                                    $special_offer = 0;
                                                    if($rowdata->special_offer == 1){
                                                        $special_offer = $rowdata->special_offer;
                                                    }

                                                   
                                                @endphp
                                                <input type="checkbox" class="special_offer_{{$rowdata->service_id}} service-input" name="services[]" data-unit="{{$rowdata->price_type}}" data-price="{{$price}}" id="service{{$rowdata->service_id}}" value="{{$rowdata->service_id}}">
                                                {{$rowdata->name}} 
                                                @if($price)
                                                    <strong>{{$price}}€</strong>
                                                    @php echo budgetTypeFormat($rowdata->price_type) @endphp
                                                    <span class="checkmarks"></span>
                                                @endif

                                               
                                                @if($rowdata->child_services)
                                                    
                                                @endif
                                            </label>
                                            @if($special_offer)
                                                <textarea style="margin-top: 12px;width: 50%;height: 140px;display:none;" id="special_offer_{{$rowdata->service_id}}" class="form-control" type="text" name="special_offer[]" value="" placeholder="Kerro tarkemmin, mihin asioihin tarvitset konsultaatiota"></textarea> 
                                                <!-- <input style="margin-top: 12px;" id="special_offer_{{$rowdata->service_id}}" class="form-control" type="text" name="special_offer[]" value="" style="display:none;" placeholder="Kerro tarkemmin, mihin asioihin tarvitset konsultaatiota"> -->
                                            @endif 
                                        </div>
                                    @endforeach
                                @endif
                            </label>
                            @if($special_offer)
                            <textarea style="margin-top: 12px;width: 50%;height: 140px;display:none;" id="special_offer_{{$row->service_id}}" class="form-control" type="text" name="special_offer[]" value="" placeholder="Kerro tarkemmin, mihin asioihin tarvitset konsultaatiota"></textarea> 
                                <!-- <input style="margin-top: 12px;" id="special_offer_{{$row->service_id}}" class="form-control" type="text" name="special_offer[]" value="" style="display:none;" placeholder="Kerro tarkemmin, mihin asioihin tarvitset konsultaatiota"> -->
                            @endif    
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>

            <div class="result">
                <h4>Hinta alkaen: <strong id="total">0€</strong> </h4>
                <p>*Hinnat sis alv <strong>24%</strong></p>
                <p>Tuntiperustaisten palveluiden loppuhinta määräytyy toteutuneiden tuntien mukaan.</p>
            </div>

        </div>
    </section>
    <section class="btndevice btn-ftr">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-sm-12">
                    <button class="btn btn-secondary" id="submit-btn" type="submit">
                        Pyydä tarjous
                    </button>
                </div>
            </div>
        </div>
    </section>
    {{ html()->form()->close() }}

@endsection
@push('after-scripts')
<script>
    $("#sellus-service-form").validate({
         rules: {
            'services[]': {
                 required: true
             },
         },
         messages: {
            'services[]': {
                 required: "Please select",
             },
         },
         errorPlacement: function(error, element) {
            
            error.insertAfter(".calculatorbox");
            
        }
     })
    $(document).on('click','.service-input', function(){
        var total = 0;
        var appartment_size = $('input[name="appartment_size"]').val();
            $('.service-input:checked').each(function(){
                if($(this).data('unit') == 'per_m2'){
                    total+= $(this).data('price')*appartment_size;
                }
                else{
                    total += $(this).data('price');    
                }
            
            });
            $('input[name="total"]').val(total);
            $('#total').html(total+'€');

    });

    $(".service-input").click(function() {
        if($(this).is(":checked")) {
            $("#special_offer_"+$(this).val()).show(300);
        } else {
            $("#special_offer_"+$(this).val()).hide(200);
        }
    });

</script>
@endpush