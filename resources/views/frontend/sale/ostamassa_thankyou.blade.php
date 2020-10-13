@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@section('content')
    <section class="thankyou-page">
        <div class="content">
            <div class="logo">
                <img src="{{ url('images/ft-logo.svg') }}" alt="">
            </div>
            <div class="heading">
                <h2>Kiitos kiinnostuksestasi ostaa asunto Flipkodin kautta!</h2>
                <p>Etsitään ja tehdään sinun asunto-unelmastasi totta. Olemme sinuun pian yhteydessä!</p>
            </div>
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