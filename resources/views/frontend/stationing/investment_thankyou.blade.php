@extends('frontend.layouts.thankyou')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
<section id="buybanner" class="thanksec">
  <div class="container">
    <h1><img src="{{url('/img/frontend/kiitos.jpg')}}"></h1>
  </div>

  <div class="container">
    <div class="tabs-heading">
    <h2>Kiinnostuksestasi sijoittaa kiinteistöihin Flipkodin kautta</h2>
    <p class="t-sub">Etsitään juuri sinun asunnollesi paras mahdollinen ostaja. Olemme sinuun pian yhteydessä!</p>
    </div>

    <h4>Tutustu odotellessasi myös muihin palveluihimme</h4>
  
    <div class="ablinks">
    <a href="{{ route('frontend.stationing') }}" class="ablinks">Asuntoa ostamassa<i class="fa fa-long-arrow-right"></i></a><span class="spacer"></span>
    <a href="{{ route('frontend.sell_ad') }}" class="ablinks">Asuntoa myymässä<i class="fa fa-long-arrow-right"></i></a>

    </div>
  
</section>
    
@endsection

@push('after-styles')
<style>
    header{
        display:none !important;
    }
    footer{
        display:none !important;
    }
</style>
@endpush

@push('after-scripts')
<script>
    jQuery(document).ready(function () {
        window.setTimeout(function() {
            window.location.href = "{{ route('frontend.index') }}";
        }, 5000);
         
    });
</script>
@endpush