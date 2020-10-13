@extends('frontend.layouts.app')

@section('title',__('meta_title_ura'))
@section('meta_description', __('meta_description_ura') )
@section('meta_image',   url('images/meta/ura-bg.jpg')  )

@section('content')
<div class="banner">
        <img class="d-none d-sm-block" src="{{ url('images/ura-bg.jpg') }}">
        <img class="d-block d-sm-none" src="{{ url('images/ura-mobi.jpg') }}">
        <div class="content">
            <h1>
                <span>Oletko valmis palvelemaan</span><br>
                <span>asiakkaitamme?</span>
            </h1>
        </div>
    </div>
    <div class="container padding-60">
        <div class="home-info">
            <p class="text-center">Etsimme työkavereita, jotka jakavat saman pakkomielteen asiakkaan poikkeukselliseen palvelemiseen.</p>
        </div>
    </div>
    <section class="home-grid">
        <div class="container padding-60">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ url('images/uraImg1.jpg') }}">
                </div>
                <div class="col-md-6">
                    <div class="info">
                        <p>Flipkodin missio on muuttaa asumisen alan painopiste aidosti asiakkaan puolelle – sinne missä sen kuuluisikin olla. Kehitämme helppokäyttöistä teknologiaa, laatutarkistettuja verkostoja ja parempia toimintatapoja, joiden avulla asiakas voi oikeasti olla ykkönen. </p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ url('images/uraImg2.jpg') }}">
                </div>
                <div class="col-md-6">
                    <div class="info">
                        <p>Oletko sinä Flipkodin uusi stara, joka vie asiakkaan palvelemisen tasolle, josta me voisimme ihaillen ottaa oppia? Löytyykö sinulta nälkää jatkuvasti kehittää itseäsi tehtävässä? Saatat olla etsimämme työkaveri.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="vacancies">
        <div class="container padding-80">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <div class="heading">
                        <h3>Avoimet työtehtävät</h3>
                        <p>Etsi listasta seuraava asiakaspalveluseikkailusi.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="fillter">
                        <?php if($departments){ ?>
                        <ul>
                            <li class="<?php if($activedepartment == ''){ echo 'active'; } ?>"><a href="javascript:void(0);" onclick="filterJobs(this, 0)" >Kaikki</a></li>
                        <?php foreach($departments as $department){ ?>
                                <!-- {{ route('frontend.uraosasto',$department->department_id ) }} -->
                               <li class="<?php if($activedepartment == $department->department_id){ echo 'active'; } ?>"><a href="javascript:void(0);" onclick="filterJobs(this, {{$department->department_id}})" ><?= $department->department_name ?></a></li>
                           <?php } ?>
                        </ul>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-9" id="joblist">
                    @include('frontend.ura.joblist')
                </div>
            </div>
        </div>
    </section>
@endsection
@push('after-scripts');
<script>
    function filterJobs(obj, deptId){
        $(obj).parents('ul').find('li.active').removeClass('active');
        
        $(obj).parent('li').addClass('active');
        
        $.ajax({
            url: siteBaseUrl+'/uraosasto/'+deptId,
            success:function(response){
                $('#joblist').html(response);
            },
            error:function(){
                showToastNotification('error', "{{__('Something went wrong.')}}");
            }
        });
    }
</script>
@endpush