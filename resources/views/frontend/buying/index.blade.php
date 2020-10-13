@extends('frontend.layouts.others')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
 <?php
    $langtextarr = Session::get('langtext');
?>
  <section class="form-section buying-list-page">
	  <div class="container">
		  <h4>{{ translateText($langtextarr,'Myytävät asunnot') }}</h4>
		  <div class="top-form-box">
		    {{ html()->form('POST', route('frontend.buying'))->id("property-form")->open() }}
          <!-- <div class="form-heading">
            <span class="serh-icon">
              <input type="text" name="keyword" class="form-control" id="keyword" placeholder="Esim. kouvola tai 02111" value="{{ @$searchData['keyword'] }}" >
              <i class="fa fa-search"  onclick="document.getElementById('property-form').submit();" aria-hidden="true"></i>
            </span>
            <button onclick="showfilter()" type="button" class="filter"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i>* Filter</button>
          </div> -->
          <div id="filter" class="btndevice calc formfilter" >
            <input type="text" name="filter"  id="filterBox" style="display:none;">
            <div class="form-group width-30 width-30-start">
              <label for="city">{{ translateText($langtextarr,'Alue tai kaupunki') }}</label>
              <input type="text" name="city" class="form-control" id="city" placeholder="Esim. kouvola tai 02111" value="{{ @$searchData['city'] }}" >
            </div>
            <div class="form-group width-30">
              <label for="apartment">{{ translateText($langtextarr,'Asuntotyyppi') }}</label>
              <!-- <input type="text" name="appartment_type" class="form-control" id="city" placeholder="Appartment Type" value="{{ @$searchData['appartment_type'] }}" > -->
              {{
                              html()->select('appartment_type', 
                                      [
                                          '' => 'Valitse, ole hyvä',
                                          'Omakotitalo' => 'Omakotitalo',
                                          'Rivitalo' => 'Rivitalo',
                                          'Kerrostalo' => 'Kerrostalo',
                                          'Paritalo' => 'Paritalo'
                                      ]
                                  )
                                  ->value(@$searchData['appartment_type'])
                                  ->class('form-control')
                                  ->id('appartment_type')
                          }}
            </div>
            <div class="form-group width-30">
              <label for="price" class="width-30" >{{ translateText($langtextarr,'Hinta') }}</label>
              <div id="slider-range"></div>
              <small class="minrange">{{ translateText($langtextarr,'Min') }}: <span id="range-slider-min">{{ @$searchData['min'] }}</span> <span>€</span></small>
              <input type="text" value="1" class="" id="myRange-min" name="min" style="display:none;" >
              <small class="maxrange">{{ translateText($langtextarr,'Max') }}: <span id="range-slider-max">{{ @$searchData['max'] }}</span> <span>€</span></small>
              <input type="text" value="1000000" class="" id="myRange-max" name="max"  style="display:none;">
            </div>
            
            <div class="clearfix"></div>
            <div class="buy-list send-btn-box">
              <a href="javascript:void(0);" onclick="document.getElementById('property-form').submit();" class="send-btn">{{ translateText($langtextarr,'Hae') }}</a>
              <!-- <a href="{{ route('frontend.buying') }}"  class="send-btn resetbtn">Reset</a> -->
            </div>
          </div>
        {{ html()->form()->close() }}
      </div>
  </section>	

<section class="buying-list-container">
    <div class="container">
        <div class="row-width-m">
            @if(count($properties) > 0)
            @foreach($properties as $property)
                <div class="width-33-n-p">
                    <div class="buying-list-box">
                        @php
                            $image = url('/img/frontend/slider_1img.png');
                            if(isset($property->primaryImage->name) &&!empty($property->primaryImage->name)){
                                $image = url('/images/property/'.$property->id.'/'.$property->primaryImage->name);
                            }
                        @endphp
                        <a href="{{ route('frontend.buying_prop', $property->slug) }}">
                          <img src="{{ $image }}" style="width:100%" alt="Propert picture">
                        </a>
                        <span class="price">{{ $property->price }} €</span>
                        <div class="buying-list-description">
                            <h4>
                                <a href="{{ route('frontend.buying_prop', $property->slug) }}">
                                    {{ $property->title }}
                                </a>
                            </h4>
                            <span>{{ $property->name }}</span>
                            <span>{{ $property->area }}, {{ $property->address }}</span>
                            <hr>
                            <span>{{ $property->appartment_type }} :  {{ $property->built_year }}: {{ $property->size }} : {{ $property->rooms }} </span>
                            <!-- <span>{{  (strlen($property->details) > 90 ? substr($property->details,0,90)."..." : $property->details) }}</span>
                            <span>{{  $property }}</span>  -->
                            <!-- <span>{{ $property->details }}</span> -->

                        </div>
                    </div>
                </div>
            @endforeach
            @else
            <h3>{{ translateText($langtextarr,'Hae') }}</h3>
            @endif
	    </div>
    </div>
    <div class="clear"></div>
    <div class="container">
        {!! $properties->total() !!} {{ trans_choice('Property total|Asuntoa yhteensä', $properties->total()) }}
        {!! $properties->render() !!}
    </div>
</section>

<!-- @lang('strings.frontend.welcome_to', ['place' => app_name()]) -->
@endsection

@push('after-styles')
{{ style('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css') }}   
@endpush


@push('after-scripts')
  {!! script('js/jquery.ui.touch-punch.min.js') !!}



<script>
$( function() {
  var minval = 1;
  var maxval = 1000000;
    <?php if(isset($searchData) && !empty($searchData)){ ?>
      minval = {{ $searchData['min'] }};
      maxval = {{ $searchData['max'] }};
      $( "#range-slider-min" ).html({{ $searchData['min'] }});
      $( "#range-slider-max" ).html({{ $searchData['max'] }});
    <?php } ?>
    $( "#slider-range" ).slider({
      range: true,
      min: 1,
      max: 1000000,
      values: [minval, maxval ],
      slide: function( event, ui ) {
        $( "#myRange-min" ).val(ui.values[ 0 ])
        $( "#myRange-max" ).val( ui.values[ 1 ])
        $( "#range-slider-min" ).html(ui.values[ 0 ])
        $( "#range-slider-max" ).html( ui.values[ 1 ])
      }
    });
    
    <?php //if(isset($searchData['filter']) && !empty($searchData['filter'])){ ?>
      // showfilter();
    <?php // } ?>

  });
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
// document.getElementById("defaultOpen").click();
</script>

<script>
var slider = document.getElementById("myRange-min");
var output = document.getElementById("range-slider-min");
var slider2 = document.getElementById("myRange-max");
var output2 = document.getElementById("range-slider-max");
output.innerHTML = slider.value;

slider.oninput = function() {
  slider2.setAttribute('min', this.value);
  output.innerHTML = this.value;
}
output2.innerHTML = slider2.value;
slider2.oninput = function() {
  slider.setAttribute('max', this.value);
  output2.innerHTML = this.value;
}

  // function showfilter() {
  //   var x = document.getElementById("filter");
  //   var fB = document.getElementById("filterBox");
  //   if (x.style.display === "block") {
  //     x.style.display = "none";
  //     fB.value = 0
  //   } else {
  //     x.style.display = "block";
  //     fB.value = 1
  //   }
  // }
</script>
@endpush