@extends('frontend.layouts.calculator')

@section('title', app_name() . ' | ' . __('navs.frontend.dashboard') )

@section('content')
    <!-- verify profile html start here -->
    <section class="fk-verify_profile">
    </section>
    <!-- verify profile html end here -->

    <!-- welcome profile html start here -->
    <section class="fk-welcome-profile">
        <div class="container">
            <div class="fk-welcome-profile_inner text-center">
                <h2>Tervetuloa, {{ $logged_in_user->name }}!</h2>
                <p>Meidän pitää varmistaa sijoittajien henkilöllisyys. Voit täyttää tietosi nyt tai vasta, kun haluat tehdä ensimmäisen sijoituksesi.</p>
            </div>
        </div>
    </section>
    
    <!-- welcome profile html end here -->

    <!-- profile detail html start here -->
    <section class="fk-profile_detail">
        <div class="container">
            <div class="fk-profile_detail-inner">
                @include('includes.partials.messages')
                {{ html()->form('POST', route('frontend.user.dashboard'))->class('form-horizontal')->attribute('enctype', 'multipart/form-data')->id('userForm')->attribute('novalidate', true)->open() }}
                    <div class="fk-profile_detail-row">
                        <div class="fk-profile_detail-left text-right">
                            <h3>Oletko?</h3>
                        </div>
                        <div class="fk-profile_detail-right">
                            <div class="fk-profile_form-you">
                                <div class="fk-profile_form-group">
                                    <div class="fk-profile_form-radio">
                                        <div class="fk-profile_form-radio_box">
                                            <input type="radio" name="type" checked value="Yksityishenkilö">
                                            <label>Yksityishenkilö</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="fk-profile_form-group">
                                    <span>or</span>
                                </div>
                                <div class="fk-profile_form-group">
                                    <div class="fk-profile_form-radio">
                                        <div class="fk-profile_form-radio_box">
                                            <input type="radio" name="type" value="Yritys">
                                            <label>Yritys</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fk-profile_detail-row">
                        <div class="fk-profile_detail-left text-right">
                            <h4>Tiedot</h4>
                        </div>
                        <div class="fk-profile_detail-right">
                            <div class="fk-profile_form-row ">
                                <div class="fk-profile_form-group">
                                    <label>Etunimi</label>
                                    <div class="fk-profile_form-input">
                                        <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" >
                                    </div>
                                </div>
                                <div class="fk-profile_form-group">
                                    <label>Sukunimi</label>
                                    <div class="fk-profile_form-input">
                                        <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" >
                                    </div>
                                </div>
                                <div class="fk-profile_form-group">
                                    <label>Sähköpostiosoite</label>
                                    <div class="fk-profile_form-input">
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                    </div>
                                </div>
                                <div class="fk-profile_form-group">
                                    <label>Osoite</label>
                                    <div class="fk-profile_form-input">
                                        <input type="text" class="form-control" name="address" value="{{ $user->userDetail?$user->userDetail->address:'' }}"  required>
                                    </div>
                                </div>
                                <div class="fk-profile_form-group">
                                    <label>Kaupunki</label>
                                    <div class="fk-profile_form-input">
                                        <select class="form-control form-select-option" name="city">
                                            @foreach($cities as $key => $city)
                                                <option value="{{ $key }}"  @if(isset($user->userDetail) && (string)$user->userDetail->city == (string)$key) selected="selected" @endif  >{{ $city }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="fk-profile_form-group">
                                    <label>Puhelinnumero</label>
                                    <div class="fk-profile_form-input">
                                        <input type="text" class="form-control" value="{{ $user->userDetail?$user->userDetail->phone:'' }}"  name="phone">
                                    </div>
                                </div>
                                <div class="fk-profile_form-group">
                                    <label>Henkilötunnus</label>
                                    <div class="fk-profile_form-input">
                                        <input type="number" class="form-control" name="personal_id" value="{{ $user->userDetail?$user->userDetail->personal_id:'' }}" >
                                    </div>
                                </div>
                                <div class="fk-profile_form-group">
                                    <label>Kansalaisuus</label>
                                    <div class="fk-profile_form-input">
                                        <select class="form-control form-select-option" name="citizen">
                                            <option value="suomi" selected="@if(isset($user->userDetail) && $user->userDetail->citizen == 'suomi') true @else false @endif"  >Suomi</option>    
                                            <option value="suomi2" selected="@if(isset($user->userDetail) && $user->userDetail->citizen == 'suomi2') true @else false @endif"  >Suomi2</option>    
                                            <option value="suomi3" selected="@if(isset($user->userDetail) && $user->userDetail->citizen == 'suomi3') true @else false @endif"  >Suomi3</option>    
                                            <option value="suomi4" selected="@if(isset($user->userDetail) && $user->userDetail->citizen == 'suomi4') true @else false @endif"  >Suomi4</option>    
                                            <option value="suomi5" selected="@if(isset($user->userDetail) && $user->userDetail->citizen == 'suomi5') true @else false @endif"  >Suomi5</option>    
                                        </select>
                                    </div>
                                </div>
                                <div class="fk-profile_form-group">
                                    <label>Arvio investoinnin koosta</label>
                                    <div class="fk-profile_form-input">
                                        <input type="number" class="form-control fk-dollor_input"  name="investment_size" value="{{ $user->userDetail?$user->userDetail->investment_size:'' }}" >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fk-profile_detail-row">
                        <div class="fk-profile_detail-left text-right">
                            <h4>Vahvistustiedot</h4>
                        </div>
                        <div class="fk-profile_detail-right">
                            <div class="fk-profile_form-row">
                                <div class="fk-profile_form-group">
                                    <label>Tunnistautumistapa</label>
                                    <div class="fk-profile_form-input">
                                        <select class="form-control form-select-option"  name="authentication">
                                            <option value="Passport" selected="@if(isset($user->userDetail) && $user->userDetail->authentication == 'Passport') true @else false @endif"  >Passport</option>      
                                            <option value="Passport" selected="@if(isset($user->userDetail) && $user->userDetail->authentication == 'Passport') true @else false @endif"  >Passport</option>      
                                            <option value="Passport" selected="@if(isset($user->userDetail) && $user->userDetail->authentication == 'Passport') true @else false @endif"  >Passport</option>      
                                            <option value="Passport" selected="@if(isset($user->userDetail) && $user->userDetail->authentication == 'Passport') true @else false @endif"  >Passport</option>      
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="fk-profile_form-group">
                                    <label>Kortin numero</label>
                                    <div class="fk-profile_form-input">
                                        <input type="number" class="form-control" name="card_id" value="{{ $user->userDetail?$user->userDetail->card_id:'' }}" >
                                    </div>
                                </div>
                                <div class="fk-profile_form-group">
                                    <label>Myöntöpäivä</label>
                                    <div class="fk-profile_form-input">
                                        <input type="number" class="form-control" name="nomination_day" value="{{ $user->userDetail?$user->userDetail->nomination_day:'' }}" >
                                    </div>
                                </div>
                                <div class="fk-profile_form-group">
                                    <label>Myöntäjä Viranomainen</label>
                                    <div class="fk-profile_form-input">
                                        <select class="form-control form-select-option" name="nomination_authority">
                                            <option value="Suomen poliisi" selected="@if(isset($user->userDetail) && $user->userDetail->nomination_authority == 'Suomen poliisi') true @else false @endif"  >Suomen poliisi</option>
                                            <option value="Suomen poliisi" selected="@if(isset($user->userDetail) && $user->userDetail->nomination_authority == 'Suomen poliisi') true @else false @endif"  >Suomen poliisi</option>
                                            <option value="Suomen poliisi" selected="@if(isset($user->userDetail) && $user->userDetail->nomination_authority == 'Suomen poliisi') true @else false @endif"  >Suomen poliisi</option>
                                            <option value="Suomen poliisi" selected="@if(isset($user->userDetail) && $user->userDetail->nomination_authority == 'Suomen poliisi') true @else false @endif"  >Suomen poliisi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="fk-profile_form-group full-width">
                                    <div class="fk-profile_form">
                                        <div class="fk-profile_form">
                                            <input type="checkbox" name="checked_investment_case" checked>
                                            <label>Tutustun investointien taustoihin, ja sitoudun tekemään sijoituksia vain jos olen ymmärtänyt siihen liittyvät ehdot ja riskit.</label>
                                        </div>
                                        <ul class="documentlist">
                                            @foreach($pdf as $pdfData)
                                                @php
                                                    $image = url('/images/pdf/'.$pdfData->id.'/'.$pdfData->document);
                                                @endphp
                                                <li><a href="{{$image}}" target="_blank">{{$pdfData->name}}</a></li>
                                            @endforeach
                                            <!-- <li>Property detail</li>
                                            <li>Property report</li>
                                            <li>Financial report</li>
                                            <li>Financial estimate</li>
                                            <li>Property maintenance plan</li>
                                            <li>Apartment Renovation plan</li>
                                            <li>Apartment investment Strategy</li> -->
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="fk-profile_form-group full-width">
                                    <div class="fk-profile_form">
                                        <div class="fk-profile_form">
                                            <input type="checkbox"  name="terms_use">
                                            <label>Hyväksyn käyttöehdot</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="fk-profile_form-group full-width">
                                    <div class="fk-profile_form">
                                        <div class="fk-profile_form">
                                            <input type="checkbox"  name="risks_investment">
                                            <label>Olen lukenut ja ymmärtänyt investointeihin liittyvät riskit</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="fk-profile_form-group full-width">
                                    <div class="fk-profile_form">
                                        <div class="fk-profile_form">
                                            <input type="checkbox"  name="agree_all">
                                            <label>Vahvistan ymmärtäväni investointeihin liittyvät yleiset velvollisuudet</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="fk-profile_submit-group full-width">
                                    <button id="fk-profile_submit" type="submit">Vahvista</button>
                                </div>
                            </div>
                        </div>
                    </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </section>
    <!-- profile detail html end here -->    
@endsection

@push('after-scripts')
<script>
    $(document).ready(function () {
        /*$.validator.addMethod("laxphone", function(value, element) {
            return this.optional( element ) || /^\+|0(?:[0-9] ?){6,14}[0-9]$/.test( value );
        }, 'Anna voimassa oleva yhteysnumero');*/
        
        $('#userForm').validate({ // initialize the plugin
            rules: {
                first_name: { required: true },
                last_name: { required: true },
                email: { required: true, email: true },
                phone: { required: true,   minlength: 10, maxlength: 15 /*laxphone:true*/},
                address: { required: true },
                city: { required: true },
                personal_id: { required: true },
                citizen: { required: true },
                investment_size: { required: true },
                authentication: { required: true },
                card_id: { required: true },
                nomination_day: { required: true },
                nomination_authority: { required: true },
                checked_investment_case: { required: true },
                terms_use: { required: true },
                risks_investment: { required: true },
                agree_all: { required: true }
            },
            messages: {
                first_name: { required: 'Pakollinen tieto' },
                last_name: { required: 'Pakollinen tieto' },
                email: { required: 'Pakollinen tieto', email: 'Ole hyvä ja syötä toimiva sähköpostiosoite' },
                phone: { required: 'Pakollinen tieto',number:'Anna kelvollinen numero.', minlength: 'Tarkastathan, että numerosi on oikenin',  maxlength: 'Tarkastathan, että numerosi on oikenin'},
                address: { required: 'Pakollinen tieto' },
                city: { required: 'Pakollinen tieto' },
                personal_id: { required: 'Pakollinen tieto' },
                citizen: { required: 'Pakollinen tieto' },
                investment_size: { required: 'Pakollinen tieto' },
                authentication: { required: 'Pakollinen tieto' },
                card_id: { required: 'Pakollinen tieto' },
                nomination_day: { required: 'Pakollinen tieto' },
                nomination_authority: { required: 'Pakollinen tieto' },
                checked_investment_case: { required: 'Pakollinen tieto' },
                terms_use: { required: 'Pakollinen tieto' },
                risks_investment: { required: 'Pakollinen tieto' },
                agree_all: { required: 'Pakollinen tieto' }
            }
        });
    });
</script>
@endpush