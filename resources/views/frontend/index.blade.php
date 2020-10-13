@extends('frontend.layouts.app')


@section('title',__('meta_title_forntend_index'))
@section('meta_description', __('meta_description_forntend_index') )
@section('meta_image',   url('images/meta/home.jpg')  )

@section('content')
    <?php
     $banner =   url('images/nbaner-home.jpg');
    if($page['banner'] != ''){
        $banner = url('images/pages/'.$page['banner']);
    }
    $langtextarr = Session::get('langtext');

    // $langtextarr = Session::get('langtext');
    // function translateText($langtextarr, $text)
    // {
    //     return $text;
    //     foreach ($langtextarr as $key => $value) {
    //         if (in_array($text, $value)) {

    //             if (Session::get('locale') == 2) {
    //                 return $langtextarr[$key][1];
    //             } elseif (Session::get('locale') == 1) {
    //                 return $langtextarr[$key][0];
    //             }
    //             break;
    //         }
           
            
    //     }
    // }
    $data = $pdata = $sdata = '';
    ?>
    <div class="banner">
        <img class="d-none d-sm-block" src="<?= $banner ?>">
        <img class="d-block d-sm-none" src="{{ url('images/home-mobi.jpg') }}">
        <div class="content">
            <?= $page['banner_title'] ?>
        </div>
    </div>
    <div class="container padding-60">
        <div class="home-info pb-0" style="max-width:2000px">
            <p class="text-center">
Asuntoflippaus on tapa ostaa, remontoida ja myydä asunto kannattavasti. Flipkodista saat kaikki yhdessä tai erikseen flippauksen rautaisilta ammattilaisilta – ilman päänvaivaa. Tutustu alaa mullistaviin palveluihimme ja aloita kannattava asuminen jo tänään!

</p>
        </div>
    </div>
    @if(count($propertyContact) > 0)
    <?php
    $sdata .= '<div class="post-grid">';
    foreach ($propertyContact as $sproperty) {
        $image = url('/img/frontend/slider_1img.png');
        if(isset($sproperty->primaryImage->name) &&!empty($sproperty->primaryImage->name)){
            $image = url('/images/property/'.$sproperty->id.'/'.$sproperty->primaryImage->name);
        }
        $sdata .= '<div class="item">
                        <div class="image-box">
                            <a href="'. route('frontend.sell_property_details', $sproperty->id) .'">
                                <img src="'. $image .'">
                            </a>
                            <span class="price">'.$sproperty->property_type.' &euro;</span>
                        </div>
                        <h3>'.$sproperty->appartment_min_size .'  -'. $sproperty->appartment_max_size .' m2</h3>
                        <p><b>Huoneiden määrä:</b> '. $sproperty->rooms_max .'-'. $sproperty->rooms_max.'  pcs</p>
                        <p><b>Hintahaitari:</b> '.  $sproperty->appartment_min_price .'-'. $sproperty->appartment_max_price.'</p>
                     </div>';
    }
    $sdata .= '</div>';
    // echo $data;
    ?>
    <?php $page['content'] = str_replace('{{all_sell}}', '<div class="post-title"><a href="'.route('frontend.sell_property').'" class="float-right">Kaikki <i class="icon-right-arrow-long"></i></a></div>', $page['content'])?>
    @else
    <?php $page['content'] = str_replace('{{all_sell}}', '', $page['content'])?>
    @endif
    
    @if(count($properties) > 0)
    <?php
    $pdata .= '<div class="post-grid">';
    foreach ($properties as $property) {
        $image = url('/img/frontend/slider_1img.png');
        if(isset($property->primaryImage->name) &&!empty($property->primaryImage->name)){
            $image = url('/images/property/'.$property->id.'/'.$property->primaryImage->name);
        }
        $pdata .= '<div class="item">
                    <div class="image-box">
                        <a href="'. route('frontend.buying_prop', $property->slug) .'">
                            <img src="'. $image .'">
                        </a>
                        <span class="price">'.$property->price.' &euro;</span>
                    </div>
                    <h3>'.$property->title.'</h3>
                    <p>'.$property->area.', '.$property->address.'</p>
                    <p>'.$property->appartment_type .':'.$property->built_year .':'.$property->size.' m2:'.$property->rooms.'</p>
                 </div>';
    }
    $pdata .= '</div>';
    // echo $data;
    ?>
    <?php $page['content'] = str_replace('{{all_sales}}', '<div class="post-title"><a href="'.route('frontend.buying').'" class="float-right">Kaikki <i class="icon-right-arrow-long"></i></a></div>', $page['content'])?>
    @else
    <?php $page['content'] = str_replace('{{all_sales}}', '', $page['content'])?>
    @endif
    
    <?php 
    $page['content'] = str_replace('{{sale_property}}', $pdata, $page['content']);
    $page['content'] = str_replace('{{sell_propertymy}}', $sdata, $page['content']);
    ?>
    

    <?php $page['content'] = str_replace('http://test.flipkoti.fi/calculator-final', route('frontend.calculator_final'), $page['content']) ?>
    

    @if(count($blog) > 0)
    <?php
    $data = '<section class="blog-section">
            <div class="container padding-40">
                <div class="blog-title">
                    <h2>Blogi';
                if (isset($category) && !empty($category))
                    $data .= '- ' . $category->name;

                $data .= '</h2>
                                    <a href="' . route('frontend.blog') . '" class="float-right">Kaikki <i class="icon-right-arrow-long"></i></a>
                                </div>
                                <div class="blog-grid">';
                foreach ($blog as $blogdata) {
                    $image = url('/img/frontend/slider_1img.png');
                    if (!empty($blogdata->image) && file_exists(public_path().'/images/blog/'.$blogdata->id.'/'.$blogdata->image)) {
                        $image = url('/images/blog/' . $blogdata->id . '/' . $blogdata->image);
                    }
                   
                    $data .= '<div class="item">
                                <a href="' . route('frontend.blog.view', $blogdata->slug) . '">
                                    <div class="image-box">
                                        <img src="' . $image . ' ">
                                    </div>
                                    <h3>' . $blogdata->name . ' </h3>
                                    <span class="date">' . date('d.m.Y', strtotime($blogdata->created_at)) . '</span>
                                    <p>';
                    $data .= (strlen($blogdata->short_description) > 90 ? substr($blogdata->short_description, 0, 90) . "..." : $blogdata->short_description);
                    $data .= '</p></a></div>';
                }
            $data .= '</div>
                </div>
            </section>';
    // echo $data;
    ?>
    @endif
                <?= str_replace('{{blog_section}}', $data, $page['content'])?>
    
            <!-- ContactModel -->
    <div class="modal fade" id="contactmodel" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    {{ html()->form('POST', route('frontend.sale'))->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->id('contactform')->open() }}
                    <input type="text" value="contact" name="type" class="form-control left " style="display:none">

                    <div class="form-group width-50">
                        <label for="name">Nimi</label>
                        <input type="text" name="name" class="form-control left">
                    </div>
                    <div class="form-group width-50">
                        <label for="phone">Puhelinnumero</label>
                        <input type="text" name="phone" class="form-control left">
                    </div>
                    <div class="form-group width-100">
                        <label for="email">Sähköposti</label>
                        <input type="email" name="email" class="form-control left">
                    </div>
                    <input type="hidden" name="subject" value="Yhteydenottolomake">
                    {{--<h4 class="border-h">Yhteydenotto</h4>--}}
                    {{--<div class="form-group width-100">
                        <label for="subject">Aihe</label>
                        <select class="form-control" name="subject" id="sel1"
                                placeholder="Searching real estate investment cases">
                            <option value="Haluan saada sijoittajaviestit säahköpostiini">Haluan saada sijoittajaviestit
                                säahköpostiini
                            </option>
                            <option value="Haluan tehdä investoinnin heti avoinna olevaan kohteeseen">Haluan tehdä
                                investoinnin heti avoinna olevaan kohteeseen
                            </option>
                            <!-- <option value="Haluan lisätietoa Flipkoti toimintaperiaatteista" >Haluan lisätietoa Flipkoti toimintaperiaatteista.</option>
                            <option value="Haluan liittyä verkostoon palvelun tarjoajana" >Haluan liittyä verkostoon palvelun tarjoajana</option>
                            <option value="Haluan tarjota huoneistoa tai kiinteistöä Flipkodille" >Haluan tarjota huoneistoa tai kiinteistöä Flipkodille</option>
                            <option value="Haluan tehdä +50000€ kertainvestoinnin vauhdittaakseni tuottojen saamista" >Haluan tehdä +50000€ kertainvestoinnin vauhdittaakseni tuottojen saamista</option>
                            <option value="Muu" >Muu</option> -->
                        </select>
                    </div>--}}
                    <div class="form-group width-100">
                        <label for="message">Viesti</label>
                        <textarea name="message" class="form-control text-area" rows="5" id="comment"></textarea>
                    </div>
                    <button type="submit" class="btn-sbmt">Lähetä</button>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="potential" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    {{ html()->form('POST', route('frontend.sale'))->attribute('enctype', 'multipart/form-data')->attribute('novalidate', true)->id('potentialform')->open() }}
                    <input type="text" value="potential" name="type" class="form-control left " style="display:none">

                    <div class="form-group width-50">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control left">
                    </div>
                    <div class="form-group width-50">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" class="form-control left">
                    </div>
                    <div class="form-group width-100">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control left">
                    </div>
                    <h4 class="border-h"> Want to know potential?</h4>

                    <div class="form-group width-100">
                        <label for="link_sale">Link to sales site</label>
                        <input type="text" name="link_sale" class="form-control left">
                    </div>
                    <div class="form-group width-100">
                        <label for="attach_sale">Attach a file</label>
                        <input type="file" name="attach_sale" class="form-control left">
                    </div>
                    <button type="submit" class="btn-sbmt">Submit</button>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
    <!-- @lang('strings.frontend.welcome_to', ['place' => app_name()]) -->
@endsection

@push('after-scripts')
    {!! script('js/jquery.ui.touch-punch.min.js') !!}

<script>
    $(document).ready(function () {
        
        setTimeout(() => {
            if($(document).find('#calculator-form')){
                var hHtml = "<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>";
                $( hHtml ).insertAfter( "#calculator-form div" );
            }    
        }, 1000);
        
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