  <header class="header">
<?php
// if(!function_exists('translateText')){
//     function translateText($langtextarr,$text){
//         return $text;
//          foreach($langtextarr as $key => $value){
//             if(in_array($text, $value)){
                
//                 if(Session::get('locale') == 'en'){
//                     return $langtextarr[$key][1];
//                 }
//                 elseif(Session::get('locale') == 'fi'){
//                     return $langtextarr[$key][0];    
//                 }
//                 break;
//             }
//             else{
//                 return $text;
//             }
//         } 
//     }
// }

?>
        <div class="logo">
            <a href="{{ route('frontend.index') }}"><img src="{{url('/images/logo.svg')}}"></a>
        </div>
        <nav class="navbar">
            <ul class="navbar-nav">
                <li class="nav-item {{ (Route::currentRouteName() == 'frontend.sale') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('frontend.sale') }}">Osta <!--i class="icon-down-arrow"></i--></a>
                    <!--ul class="navbar-sub">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.sale') }}">{{ translateText(Session::get('langtext'), 'Löydä koti') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('frontend.buying') }}">{{ translateText(Session::get('langtext'), 'Myytävät asunnot') }}</a>
                        </li>
                    </ul-->
                </li>
                <li class="nav-item {{ (Route::currentRouteName() == 'frontend.renovation-calculator') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('frontend.renovation-calculator') }}"> {{ translateText(Session::get('langtext'), 'Remontoi') }}</a>
                    
                </li>
                <li class="nav-item {{ ( Route::currentRouteName() == 'frontend.sell' ||  Route::currentRouteName() == 'frontend.sell_ad' ||  Route::currentRouteName() == 'frontend.myy-meille' ) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('frontend.sell') }}">{{ translateText(Session::get('langtext'), 'Myy') }} 
                    <!-- <i class="icon-down-arrow"></i>  -->
                    </a>
                    <!-- <ul class="navbar-sub">
                        <li class="nav-item {{ (Route::currentRouteName() == 'frontend.sell') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('frontend.sell') }}">{{ translateText(Session::get('langtext'), 'Myy Asuntosi') }}</a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() == 'frontend.sell_ad') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('frontend.sell_ad') }}">{{ translateText(Session::get('langtext'), 'Myy Kiinteistösi') }}</a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() == 'frontend.myy-meille') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('frontend.myy-meille') }}">{{ translateText(Session::get('langtext'), 'Myy Flipkodille') }}</a> 
                        </li>
                        
                    </ul> -->
                </li>
                <li class="nav-item {{ ( Route::currentRouteName() == 'frontend.FK-Pro-Sijoittajalle' ) ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('frontend.FK-Pro-Sijoittajalle') }}">Sijoita</a>
                </li>
                <!--<li class="nav-item {{ ( Route::currentRouteName() == 'frontend.sell_property' || Route::currentRouteName() == 'frontend.buying' ) ? 'active' : '' }}">
                    <a class="nav-link" href="#">Ilmoitukset <i class="icon-down-arrow"></i></a>
                    <ul class="navbar-sub">
                        <li class="nav-item {{ (Route::currentRouteName() == 'frontend.sell_property') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('frontend.sell_property') }}">{{ translateText(Session::get('langtext'), 'Osto-ilmoitukset') }}</a>
                        </li>
                        <li class="nav-item {{ (Route::currentRouteName() == 'frontend.buying') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('frontend.buying') }}">Myynti-ilmoitukset</a>
                        </li>
                    </ul>
                </li>-->
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.stationing') }}">{{ translateText(Session::get('langtext'), 'Sijoittamassa') }}</a>
                   </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('frontend.about_us') }}">{{ translateText(Session::get('langtext'), 'Meistä') }}</a>
                   
                </li> -->
            </ul>
        </nav>
         <nav class="navbar">
            <ul class="navbar-nav">
                <li class="nav-item {{ ( Route::currentRouteName() == 'frontend.about_us' || Route::currentRouteName() == 'frontend.blog' || Route::currentRouteName() == 'frontend.ura' || Route::currentRouteName() == 'frontend.contact_us') ? 'active' : '' }}">
                    <a class="nav-link" href="javascript:void(0)">Meistä <i class="icon-down-arrow"></i></a>
                    <ul class="navbar-sub">
                        <li class="nav-item {{ ( Route::currentRouteName() == 'frontend.about_us' ) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('frontend.about_us') }}">Flipkoti</a>
                        </li>
                        <li class="nav-item {{ ( Route::currentRouteName() == 'frontend.blog' ) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('frontend.blog') }}">Blogi</a>
                        </li>
                        <li class="nav-item {{ ( Route::currentRouteName() == 'frontend.ura' ) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('frontend.ura') }}">Ura</a>
                        </li>
                        <li class="nav-item {{ ( Route::currentRouteName() == 'frontend.contact_us' ) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('frontend.contact_us') }}">Ota yhteyttä</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ ( Route::currentRouteName() == 'frontend.FKPro-Palveluntarjoajalle'   || Route::currentRouteName() == 'frontend.FKPro-kiinteistoille-taloyhtioille') ? 'active' : '' }}">
                    <a class="nav-link" href="javascript:void(0)">Ammattilaisille <i class="icon-down-arrow"></i></a>
                    <ul class="navbar-sub">
                        <li class="nav-item {{ ( Route::currentRouteName() == 'frontend.FKPro-Palveluntarjoajalle' ) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('frontend.FKPro-Palveluntarjoajalle') }}">Palveluntarjoajalle</a>
                        </li>
                        <!-- <li class="nav-item {{ ( Route::currentRouteName() == 'frontend.FK-Pro-Sijoittajalle' ) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('frontend.FK-Pro-Sijoittajalle') }}">Sijoittajalle</a>
                        </li> -->
                        <li class="nav-item {{ ( Route::currentRouteName() == 'frontend.FKPro-kiinteistoille-taloyhtioille' ) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('frontend.FKPro-kiinteistoille-taloyhtioille') }}">Kiinteistöille & Taloyhtiöille</a>
                        </li>
                        <li class="nav-item {{ ( Route::currentRouteName() == 'frontend.marketplace.index' ) ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('frontend.marketplace.index') }}">Markkinapaikka</a>
                        </li>
                        @guest
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('frontend.auth.login') }}">{{ translateText(Session::get('langtext'), 'Login') }}</a>
                            </li>-->
                        @else
                            <li class="nav-item {{ ( Route::currentRouteName() == 'frontend.user.accounte' ) ? 'active' : '' }}">
                                @if(auth()->user()->can('view backend'))
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">{{ strlen(translateText(Session::get('langtext'), 'Hallintapaneeli')) >0 ? translateText(Session::get('langtext'), 'Hallintapaneeli') : 'Hallintapaneeli' }}</a>
                                @else
                                <a class="nav-link" href="{{ route('frontend.user.account') }}">{{ strlen(translateText(Session::get('langtext'), 'Käyttäjätili')) >0 ? translateText(Session::get('langtext'), 'Käyttäjätili') : 'Käyttäjätili' }}</a>
                                @endif
                                
                            </li><li class="nav-item">
                                <a  class="nav-link" href="{{ route('frontend.auth.logout') }}" class="dropdown-item">{{ strlen(translateText(Session::get('langtext'), 'Kirjaudu ulos')) > 0 ? translateText(Session::get('langtext'), 'Kirjaudu ulos') : 'Kirjaudu ulos' }}</a>
                            </li>

                        @endguest 
                    </ul>
                </li>
            </ul>
        </nav>
  

        <nav class="navbar" style="display: none;">
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.auth.login') }}">{{ translateText(Session::get('langtext'), 'Login') }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('frontend.user.account') }}">{{ translateText(Session::get('langtext'), 'Käyttäjätili') != '' ? translateText(Session::get('langtext'), 'Käyttäjätili') : 'Käyttäjätili' }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ route('frontend.auth.logout') }}" class="dropdown-item">{{ translateText(Session::get('langtext'), 'Kirjaudu ulos')!='' ? translateText(Session::get('langtext'), 'Kirjaudu ulos') : 'Kirjaudu ulos'}}</a>
                    </li>
                @endguest 
            </ul>
        </nav>
    </header>
    @if(Auth::check() && Session::get('pages_editable'))
        <button class="btn btn-primary btn-floating" onclick="saveContent();">Save</button>
    @else

    @endif