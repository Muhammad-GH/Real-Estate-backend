@extends('frontend.layouts.others')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')

   <section class="thankyou-page">
        <div class="content">
            <div class="logo">
                <img src="{{ url('images/ft-logo.svg') }}" alt="">
            </div>
            @if(isset($type) && $type == 'myymassa')
            <div class="heading">
                <h2>Kiitos kun tarjosit kiinteistöäsi!</h2>
                <p>Asiantuntijamme on teihin pian yhteydessä.</p>
            </div>
            @else
            <div class="heading">
                <h2>Kiitos kun tarjosit asuntoasi meille!</h2>
                <p>Saat pian ehdotuksemme asunnosta, kun olemme tutkineet antamasi tiedot.</p>
            </div>
            @endif
            @include('frontend.includes.thankyou-page-footer')
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
