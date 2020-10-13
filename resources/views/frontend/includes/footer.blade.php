    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-12">
                        <img src="{{url('/images/ft-logo.svg')}}">
                        <address>
                            {{ translateText(Session::get('langtext'), 'Vanha Kaarelantie 33 A') }}<br>
                            {{ translateText(Session::get('langtext'), '01610 Vantaa') }}<br>
                            {{ translateText(Session::get('langtext'), 'Y-tunnus: 3140986-1') }}<br>
                        </address>
                        <div class="subscribe">
                            <h5>{{ translateText(Session::get('langtext'), 'Tilaa viikkokirjeemme') }}</h5>
                            <form method="post" action="{{ route('frontend.subscribe')}}" id="footer-newsletter">
                                @csrf
                                <div class="form-group">
                                <input type="email" id="email_id" name="email_id" placeholder="{{ translateText(Session::get('langtext'), 'Sähköpostisi') }}">
                                <button class="btn btn-bordered " id="submit">{{ translateText(Session::get('langtext'), 'Tilaa') }}</button>
                                </div>
                                <div class="invalid-feedback">
                                </div>
                            </form>
                           <!--  <label id="email_id-error" class="error" for="email_id" style=""></label> -->
                                <h4 id="msg"></h4>
                            
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <h4>Kuluttajille</h4>
                                <ul> 
                                    <li><a href="{{ route('frontend.sale') }}">{{ translateText(Session::get('langtext'), 'Ostamassa') }}</a></li>
                                    <li><a href="{{ route('frontend.renovation-calculator') }}">{{ translateText(Session::get('langtext'), 'Remontoimassa') }}</a></li>
                                    <li><a href="{{ route('frontend.sell') }}">{{ translateText(Session::get('langtext'), 'Myy Asuntosi') }}</a></li>
                                    <li><a href="{{ route('frontend.myy-meille') }}">{{ translateText(Session::get('langtext'), 'Myy Flipkodille') }}</a></li>
                                    <li><a href="{{ route('frontend.FKPro-kiinteistoille-taloyhtioille') }}">{{ translateText(Session::get('langtext'), 'Myy Kiinteistösi') }}</a></li>
                                    <li><a href="{{ route('frontend.sell_property') }}">{{ translateText(Session::get('langtext'), 'Osto-ilmoitukset') == '' ? 'Osto-ilmoitukset' : translateText(Session::get('langtext'), 'Osto-ilmoitukset')  }}</a></li>
                                    <li><a href="{{ route('frontend.buying') }}">{{ translateText(Session::get('langtext'), 'Myynti-ilmoitukset') }}</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h4>{{ translateText(Session::get('langtext'), 'Meistä') }}</h4>
                                <ul>
                                    <li><a href="{{ route('frontend.about_us') }}">{{ translateText(Session::get('langtext'), 'Flipkoti') }}</a></li>
                                    <li><a href="{{ route('frontend.blog') }}">{{ translateText(Session::get('langtext'), 'Blogi') }}</a></li>
                                    <li><a href="{{ route('frontend.ura') }}">{{ translateText(Session::get('langtext'), 'Ura') }}</a></li>
                                    <li><a href="{{ route('frontend.contact_us') }}">{{ translateText(Session::get('langtext'), 'Ota yhteyttä') }}</a></li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h4>{{ translateText(Session::get('langtext'), 'Ammattilaisille') }}</h4>
                                <ul>
                                    <li><a href="{{ route('frontend.FKPro-Palveluntarjoajalle') }}">{{ translateText(Session::get('langtext'), 'Palveluntarjoajalle') }}</a></li>
                                    <li><a href="{{ route('frontend.FK-Pro-Sijoittajalle') }}">{{ translateText(Session::get('langtext'), 'Sijoittajalle') }}</a></li>
                                    <li><a href="{{ route('frontend.FKPro-kiinteistoille-taloyhtioille') }}">{{ translateText(Session::get('langtext'), 'Kiinteistöille & Taloyhtiöille') }}</a></li>
                                    <li><a href="{{ route('frontend.marketplace.index') }}">Markkinapaikka</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p class="copy">&copy; Flipkoti 2020. Kaikki oikeudet pidätetään
                    <a href="{{ route('frontend.tietosuojaseloste') }}">Tietosuojaseloste</a>
                    <a href="{{ route('frontend.terms') }}">Käyttöehdot</a>
		            <a href="https://alustatalo.com">Sivuston toteutus: Alustatalo</a>  
		            <!-- Will add languages later -->
		            <!--@foreach(Session::get('languages') as $languages)-->
	             <!--      <a href="javascript:void(0)" class="lang-link" data-val="{{$languages['lang_code']}}" <?php if(Session::get('locale') == $languages['lang_code']){ echo 'style="font-weight:bold"'; }?>>{{ substr($languages['name'], 0, 3)}}</a>	            -->
		            <!--@endforeach-->
		             
		           </p>
                <div class="lang-form">
                    <form action="{{ route('frontend.changelanguage')}}" method="post" id="langform" style="display:block;">
                        @csrf
                        <input type="hidden" name="lang">
                        <input type="submit" name="submit" value="submit" style="display:none;">
                    </form>
                </div>
                <div class="social-links">
                    <a href="https://www.facebook.com/flipkoti/"><i class="icon-facebook"></i></a>
                    <a href="https://www.instagram.com/flipkoti/"><i class="icon-instagram"></i></a>
                    <a href="https://twitter.com/flipkoti"><i class="icon-twitter"></i></a>
                    <a href="https://fi.pinterest.com/flipkotifi/"><i class="icon-pinterest"></i></a>
                    <a href="https://www.linkedin.com/company/flipkoti-ltd"><i class="icon-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>
    
<style>
  /*  .btn.btn-primary:hover {
        color: #000;
        background: #acacac;
    }
    footer .btn.btn-bordered:hover {
         color: #fff;
         background: #000;
     }*/
</style>

@push('after-scripts')
{!! script('js/common.js') !!}
@endpush
  

