<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm' => 'Are you sure you want to delete this user permanently? Anywhere in the application that references this user\'s id will most likely error. Proceed at your own risk. This can not be un-done.',
                'if_confirmed_off' => '(If confirmed is off)',
                'no_deactivated' => 'There are no deactivated users.',
                'no_deleted' => 'There are no deleted users.',
                'restore_user_confirm' => 'Restore this user to its original state?',
            ],
        ],

        'dashboard' => [
            'title' => 'Dashboard',
            'welcome' => 'Welcome',
        ],

        'general' => [
            'all_rights_reserved' => 'Kaikki oikeudet pidätetään.',
            'are_you_sure' => 'Oletko varma, että haluat tehdä tämän?',
            'boilerplate_link' => 'Flipkoti',
            'continue' => 'Jatka',
            'member_since' => 'Member since',
            'minutes' => ' minutes',
            'search_placeholder' => 'Etsii...',
            'timeout' => 'Sinut kirjattiin ulos automaattisesti turvallisuussyistä.',

            'see_all' => [
                'messages' => 'Katso kaikki viestit',
                'notifications' => 'Katso kaikki',
                'tasks' => 'Katso kaikki tehtävät',
            ],

            'status' => [
                'online' => 'Online',
                'offline' => 'Offline',
            ],

            'you_have' => [
                'messages' => '{0} Sinulla ei ole viestejä | {1} Sinulla on 1 viesti | [2, Inf] Sinulla on: numeroviestejä',
                'notifications' => '{0} Sinulla ei ole ilmoituksia | {1} Sinulla on 1 ilmoitus | [2, Inf] Sinulla on: numeroilmoituksia',
                'tasks' => '{0} Sinulla ei ole tehtäviä | {1} Sinulla on 1 tehtävä | [2, Inf] Sinulla on: useita tehtäviä',
            ],
        ],

        'search' => [
            'empty' => 'Hae',
            'incomplete' => 'You must write your own search logic for this system.',
            'title' => 'Hakutulokset',
            'results' => 'Hakutulokset :kyselylle',
        ],

        'welcome' => 'Tervetuloa sijoittajatilillesi!',
    ],

    'emails' => [
        'auth' => [
            'account_confirmed' => 'Tilisi on vahvistettu',
            'error' => 'Whoops!',
            'greeting' => 'Hei!',
            'regards' => 'Terveisin,',
            'trouble_clicking_button' => 'Jos sinulla on vaikeuksia napsauttamalla ": action_text" -painiketta, kopioi ja liitä alla oleva URL-osoite selaimeesi:',
            'thank_you_for_using_app' => 'Kiitos sovelluksen käytöstä!',

            'password_reset_subject' => 'Vaihda salasana',
            'password_cause_of_email' => 'Saitte tämän sähköpostiviestin, koska pyysitte tilinne salasanan vaihtamista.',
            'password_if_not_requested' => 'Jos ette pyytäneet salasanan vaihtoa, muita toimenpiteitä ei vaadita',
            'reset_password' => 'Paina tästä vaihtaaksesi salasanasi',

            'click_to_confirm' => 'Paina tästä vahvistaaksesi tilin:',
        ],

        'contact' => [
            'email_body_title' => 'Sinulla on uusi pyyntö lomakkeesta: Alla ovat tarkemmat tiedot:',
            'subject' => 'Uusi :app_name viesti lomakkeesta!',
        ],
    ],

    'frontend' => [
        'test' => 'Testaa',

        'tests' => [
            'based_on' => [
                'permission' => 'Permission Based - ',
                'role' => 'Role Based - ',
            ],

            'js_injected_from_controller' => 'Javascript Injected from a Controller',

            'using_blade_extensions' => 'Using Blade Extensions',

            'using_access_helper' => [
                'array_permissions' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does have to possess all.',
                'array_permissions_not' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does not have to possess all.',
                'array_roles' => 'Using Access Helper with Array of Role Names or ID\'s where the user does have to possess all.',
                'array_roles_not' => 'Using Access Helper with Array of Role Names or ID\'s where the user does not have to possess all.',
                'permission_id' => 'Using Access Helper with Permission ID',
                'permission_name' => 'Using Access Helper with Permission Name',
                'role_id' => 'Using Access Helper with Role ID',
                'role_name' => 'Using Access Helper with Role Name',
            ],

            'view_console_it_works' => 'View console, you should see \'it works!\' which is coming from FrontendController@index',
            'you_can_see_because' => 'You can see this because you have the role of \':role\'!',
            'you_can_see_because_permission' => 'You can see this because you have the permission of \':permission\'!',
        ],

        'general' => [
            'joined' => 'Joined',
        ],

        'user' => [
            'change_email_notice' => 'Jos vaihdat salasanasi, sinut kirjataan ulos kunnes olet vahvistanut uuden sähköpostiosoitteen.',
            'email_changed_notice' => 'Sinun tulee vahvistaa uusi sähköpostiosoite, ennen kuin voit kirjautua sisään.',
            'profile_updated' => 'Tili päivitetty onnistuneesti.',
            'password_updated' => 'Salasana päivitetty onnistuneesti.',
        ],

        'welcome_to' => 'Tervetuloa :place',
        'footer' => [
            'about_us' => 'Meistä',
            'sale' => 'Ostamassa',
            'sell' => 'Myymässä',
            'stationing' => 'Sijoittamassa',
        ],
        'home' => [
            'know_value' => 'Parhaat vaihtoehdot asuntokaupan osapuolille.',
            'buying_n_sell' => 'Ostamassa tai myymässä – me pidämme puolesi',
            'get_offer' => 'Kotiasi Varten',
            'free_quote' => 'Tutustu Flipkodin ideaan',
            'sale' => 'Ostamassa',
            'canmpt_find_apartment_text' => 'Etkö löydä asuntoa, joka vastaa toiveitasi?',
            'home_sell_text_8' => 'Tutustu uuteen tapaan ostaa asunto',
            'home_text_1' => 'Tutustu uuteen tapaan ostaa asunto',
            'home_text_2' => 'Flipkodin avulla löydät helposti juuri mieltymyksiisi ja budjettiisi sopivan kodin.',
            'home_text_3' => 'Tutustu uuteen tapaan ostaa asunto',
            'sell' => 'Myymässä',
            'home_text_4' => 'Palvelut erilaisiin myyntitilanteisiin kustannustehokkaasti yhdestä paikasta',
            'home_text_5' => 'Asunto on elämäsi sijoitus',
            'value_home' => 'Selvitä kotisi potentiaalinen arvo',
            'are_you' => 'Kodin omistaja tai Välittäjä',
            'homeowner' => 'Kodin omistaja',
            'lorem_ipsum' => 'Ratkaisut erilaisiin tilanteisiin.',
            'appellant' => 'Kiinteistönvälittäjä',
            'sell_home' => 'Myy kotisi',
            'flipkoti' => 'Flipkodille',
            'home_text_6' => 'Haluatko nopean ja huolettoman kaupan asunnosta?',
            'buy_apartment' => 'Ostamme huoneistoja seuraavilta alueilta:',
            'helsinki' => 'Helsinki',
            'jarvenpaa' => 'Järvenpää',
            'bay' => 'Lahti',
            'tampere' => 'Tampere',
            'vantaa' => 'Vantaa',
            'porvoo' => 'Porvoo',
            'Hyvinkaa' => 'Hyvinkää',
            'vaasa' => 'Vaasa',
            'espoo' => 'Espoo',
            'turku' => 'Turku',
            'jyvaskyla' => 'Jyväskylä',
            'rauma' => 'Rauma',
            'housing_investor' => 'Sijoittamassa asuntoihin',
            'home_text_7' => 'Uusi ja huoleton tapa sijoittaa asuntoihin',
            'home_text_8' => 'Saat pääomallesi loistavan vuosituoton verrattuna perinteiseen vuokratuottomalliin.',
            'check_solution' => 'Tutustu ratkaisuumme',
            'join_network' => 'Liity verkostoomme',
            'home_text_9' => 'Palvelut kauttamme asunnon myyntiin, ostoon ja sijoittamiseen.',
            'photography' => 'Valokuvaus',
            'profit_analysis' => 'Kannattavuusanalyysi',
            'home_text_10' => 'Asunnon arvon nosto',
            'home_text_11' => 'Materiaalivalinta ja kilpailutus',
            'home_sell_text_80' => 'Asunnon arvon nosto',
            'home_sell_text_81' => 'Materiaalivalinta ja kilpailutus',
            'interior_design' => 'Sisustussuunnittelu',
            'styling' => 'Stailaus',
            'pictures' => 'Pohjakuvat',
            'kilpailutus' => 'Urakoitsijakilpailutus',
            '3D_images' => '3D kuvat',
            'virtual_tours' => 'Virtuaalikierrokset',
            'renovated_apartment' => 'Remontoitu asunto',
            'agents' => 'Välittäjät',
            'home_sell_text_82' => 'Asunnon remontointi ja myynti ilman',
            'home_text_12' => 'Asunnon remontointi ja myynti ilman omaa riskiä',
            'sell_and_rent' => 'Myy ja jää vuokralle',
            'contractors' => 'Urakoitsijat',
            
            

            // 'know_value' => 'Lahti',
        ],
        'sell'=>[
            'sell_text_1' => 'Myy asuntosi helposti remontoituna<br> tai sellaisenaan.',
            'sell_text_2' => 'Maksimoi asuntosi arvo.<br> Me autamme sinua.',
            'sell_text_3' => 'Ongelmia asunnon myynnissä?<br> Meillä on ratkaisut erilaisiin kohteisiin ja tilanteisiin.',
            'sell_text_4' => 'Myy asuntosi kahdella hinnalla. Tai flippaa koti ennen myyntiä. Avullamme se on helppoa ja kannattavaa.',
            'sell_text_5' => 'Oletko koskaan miettinyt, että asuntosi arvo voisi olla jotakin ihan muuta ammattimaisesti remontoituna ja markkinoituna? Et kenties ole tarkalleen tiennyt miten remontti ja markkinointi kannattaisi tehdä, jotta saisit asunnostasi parhaan tuoton.',
            'sell_text_6' => 'Moni suomalainen istuu kultakimpaleen päällä tietämättään – ja luopuu siitä tietämättään.',
            'sell_text_7' => 'Me Flipkodilla olemme tehneet asuntokauppaa flippaamalla, eli osta-remontoi-myy -mallilla, jo yli 10 vuotta ja tiedämme sen olevan totta. Järkevästi toteutettu remontti useimmiten kannattaa vastoin alan yleistä käsitystä.',
            'sell_text_8' => 'Nyt olemme organisoineet toimintatapamme helposti ostettaviksi palvelupaketeiksi, jonka avulla sinä voit maksimoida asuntosi arvon erilaisissa myyntitilanteissa. Voit myös myydä asuntosi suoraan meille, jos haluat vain päästä siitä nopeasti eroon.',
            'sell_text_9' => 'Olipa tilanteesi mikä hyvänsä, Flipkoti auttaa löytämään siihen järkevimmän ratkaisun. 
',
            'sell_text_10' => '6. Päätät itse, miten haluat myydä asunnon. Itse meidän avustuksella tai meidän verkoston huippuvälittäjien toimesta.',
            'sell_text_11' => 'Myy koti meille',
            'sell_text_12' => 'Ei välityspalkkioita, ei lomakkeiden täyttöä, ei asiakkaiden etsintää.',
            'sell_text_13' => 'Tutustu tarkemmin',
            'sell_text_14' => 'Maksimoi asuntosi arvo. Me autamme sinua.',
            'sell_text_15' => 'Agent',
            'sell_text_16' => 'Consumer',
            'sell_text_17' => 'Flipkodin palvelupaketit',
            'sell_text_18' => 'RÄÄTÄLÖI FLIPPAUS',
            'sell_text_19' => 'PYYDÄ RÄÄTÄLÖITY TARJOUS',
            'sell_text_20' => 'Räätälöi tilanteeseesi sopiva palvelukokonaisuus. Sopii hyvin esimerkiksi kodin omistajalle, joka haluaa säästää välityspalkkioissa, haluaa selvittää asunnon arvopotentiaalin tai haluaa remontoida asunnon myyväksi kustannustehokkaasti.',
            'sell_text_21' => 'VALITSE',
            'sell_text_22' => 'FLIPPAA AVAIMET KÄTEEN',
            'sell_text_23' => 'MYYNTIVOITTO JAETAAN 50/50',
            'sell_text_24' => 'Sisustussuunnittelu',
            'sell_text_25' => '3D suunnitelmat ja myyntikuvat',
            'sell_text_26' => 'Materiaalien kilpailutus ja valinta',
            'sell_text_27' => 'Urakoitsijoiden kilpailutus ja valinta',
            'sell_text_28' => 'Sitovat sopimukset tai esisopimukset',
            'sell_text_ser1' => 'Remontin johtaminen, toteutus ja dokumentointi',
            'sell_text_ser2' => 'Asunnon myynti ja markkinointi',
            'sell_text_29' => 'Avaimet käteen',
            'sell_text_30' => '12€/m2',
            'sell_text_31' => '3D suunnitelmat',
            'sell_text_32' => 'Materiaalien kilpailutus ja valinta',
            'sell_text_33' => 'Urakoitsijoiden kilpailutus ja valinta',
            'sell_text_34alt' => 'Sopimukset',
            'sell_text_35alt' => 'Pitävän aikataulun',
            'sell_text_36alt' => 'Projektin toteutus avaimet käteen periaatteella Tai Voit antaa riskin meille asunnon remontoinnista ja myynnistä*',
            'sell_text_34' => 'Lisäpalvelut',
            'sell_text_39' => 'Voit myydä asunnon<br>itse tai välittäjän kanssa.',
            'sell_text_40btn' => 'VALITSE PALVELUT',
            'sell_text_40' => 'Välittäjäpalvelut tuntityönä, 80€/h.',
            'sell_text_41' => 'Lakimiespalvelut tarvittaessa, 150€/h.',
            'sell_text_42' => 'Asuntokaupan dokumentit, 100€; huoneistonmyyntiesite, ostotarjouskaavakkeen, kauppakirjapohjan.',
            'sell_text_43' => 'Pohjakuvat, 20€/ huoneisto.',
            'sell_text_44' => '3D kuvat ja virtuaalikierrokset, 100€ alkaen.',
            'sell_text_45' => 'Stailaus ja Valokuvaus, 200€ huoneisto.',
            'sell_text_46' => 'Jos epäonnistumme lupauksessamme luvatussa ajassa, maksat vain 70% remontin toteutuneista kustannuksista ja voit jäädä nauttia remontoidusta kodistasi. Me kannamme taloudellisen riskin.',
            'sell_text_47' => '* Sisältyy Avaimet käteen palveluun',

            // 'sell_text_48' => 'ssORssss',
            // 'sell_text_48' => 'ssORssss',
        ],
        'stationing'=>[
            'station_text_1'=>'Parempaa tuottoa pääomallesi',
            'station_text_2'=>'Asuntosijoittajaksi pääsee nyt pienellä pääomalla, hajautetulla riskillä, ilman huolta ja vaivannäköä asuntojen vuokrauksesta tai arvon kehityksestä.',
            'station_text_3'=>'Flipkoti auttaa pieniä ja isompia toimijoita sijoittamaan asuntoihin tuotot maksimoiden.',
            'station_text_4'=>'Asuntojen hankinta',
            'browse_homes'=>'Selaa asuntoja',
            'investing'=>'Investoi',
            'increase_profits'=>'Nosta tuottosi',
            'increase_investment'=>'Nosta sijoituksesi',
            'station_text_5'=>'Flipkodin asiantuntijat ja verkosto etsivät asuntoja ympäri Suomen ja tulevaisuudessa myös kansainvälisesti. Teemme sijoituksia vain, jos itsekin sijoitamme. Näin haluamme osoittaa, että sijoitukset ovat huolella analysoituja ja me teemme sijoituksia vain, kun tiedämme, mitä olemme ostamassa ja mitä sijoituksella tullaan tekemään.',
            'station_text_6'=>'Flipkoti saa myös ostotarjouksia niin yksityiltä kuin suuremmiltakin toimijoilta. ',
            'station_text_7'=>'Hankintapäätöstä tehdessä Flipkoti analysoi sijoituskohdetta teknisesti ja taloudellisesti. Ottaen huomioon alueellisen kehittymisen kuin myös tekniset riskit. Kun tekniset ja taloudelliset riskit on analysoitu ja kohde todettu kriteerit täyttäväksi, otamme kohteen alustaamme. Julkaisemme kohteen sijoittajillemme laskelmin ja suunnitelmin.Teemme sijoituksen, kun kohteeseen on löydetty halukkaat sijoittajat.',
            'station_text_8'=>'Voit ilmoittaa meille halukkuutesi joka ottamalla meihin yhteyttä tai liittymällä investoijalistalle. Se ei sido sinua mihinkään. Saat meidän kartoittamista kohteista tietoa sähköpostiisi, ja päätät itse haluatko sijoittaa vai et. Meillä on kohteita useilta paikkakunnilta, joten voit hajauttaa salkkuasi valitsemalla kohteita eri alueilta.',
            'station_text_9ad'=>'Voit nostaa tuottosi välittömästi Flipkohteen myynnin jälkeen. Tai nostaa vuokratuotot esim kerran kuukaudessa. Sinä päätät tuottojesi käytöstä.',
            'station_text_10ad'=>'Sijoituksen kesto määritellään kohdekohtaisesti. Tavoittelemme sijoitusten nopeaa kiertoa ja tätä kautta korkeaa vuosittaista pääomantuottoa.',
            'station_text_content1'=>'Voit jättää halutessasi myös varasi (sijoitus ja tuotto) meidän hallinnoimalle tilille jatkosijoituksia varten, jolloin olet etusijalla uusien kohteiden sijoittajista.',
            'station_text_content2'=>'Flipkodin asiantuntijat ja verkosto etsivät asuntoja ympäri Suomen ja tulevaisuudessa myös kansainvälisesti. Teemme sijoituksia vain, jos itsekin sijoitamme. Näin haluamme varmistaa ja osoittaa, että kaikki huoneistot ja sijoitukset ovat huolella analysoituja ja me teemme sijoituksia vain, kun tiedämme, mitä olemme ostamassa ja mitä sijoituksella tullaan tekemään.',
            'station_text_content3'=>'Flipkoti saa myös ostotarjouksia niin yksityiltä kuin suuremmiltakin toimijoilta.',
            'station_text_content4'=>'Hankintapäätöstä tehdessä Flipkoti analysoi sijoituskohdetta teknisesti ja taloudellisesti. Otamme huomioon alueellisen kehittymisen kuin myös tekniset riskit. Kun tekniset ja taloudelliset riskit on analysoitu ja kohde todettu kriteerit täyttäväksi, otamme kohteen alustaamme. Julkaisemme kohteen sijoittajillemme laskelmin ja suunnitelmin.',
            'station_text_9'=>'Helppo tapa sijoittaa ja hajauttaa riskiä',
            'station_text_10'=>'DepotHouse (Stage 2)',
            'residential'=>'Resedential',
            'station_text_11'=>'Juurdeveo 25c, 0 Tallinn, Estonia',
            'station_text_12'=>'Stable passive income guaranteed for the first 24 months.',
            'invested'=>'Sijoitettu',
            'target'=>'Tavoite',
            'invest_now'=>'Katso lisätietoja',
            'station_text_13'=>'Katso sijoituskohteemme tai tilaa maksuton viikottainen uutiskirjeemme sähköpostiin.',
            'station_text_14'=>'KATSO KAIKKI KOHTEET',
            'station_text_15'=>'Miten sijoittaminen toimii ?',
            'station_text_16'=>'Analysoimme markkinoilla olevia ja meille tarjottuja kohteita.',
            'station_text_17'=>'Näytämme kannattavuus ja riskianalyysit läpäisseet kohteet sijoittajille.',
            'station_text_18'=>'Ostamme korkean tuottopotentiaalin kohteen yhdessä sijoittajien kanssa.',
            'station_text_19'=>'Remontoimme asunnon kustannustehokkaasti luotettavien yhteistyökumppaneiden kanssa.',
            'station_text_20'=>'Myymme tai vuokraamme kohteen.',
            'station_text_21'=>'Saat pääomallesi tuottoa.',
            'station_text_22'=>'Tehokkaiden prosessien avulla tavoittelemme yli 30% pääoman vuosittaista tuottoa.',
            'station_text_23'=>'Liity sijoittajalistalle',
            
            // 'station_text_1'=>'station_text_1',
        ],
        'about_us'=>[
            'lorem_ipsum_short'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris rhoncus, arcu sit amet feugiat interdum, lorem mi commodo nisl, vel volutpat erat tortor sed odio. Vestibulum',
            'lorem_ipsum_long'=>'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris rhoncus, arcu sit amet feugiat interdum, lorem mi commodo nisl, vel volutpat erat tortor sed odio. Vestibulum sit amet massa commodo, vehicula felis nec, elementum ligula. Fusce euismod, lacus nec porttitor rhoncus, tortor urna semper nisl, sed euismod libero magna porttitor mi. Duis enim arcu, pharetra non lectus sit amet, tincidunt lacinia justo. Nunc dignissim viverra velit sed pretium. Nullam scelerisque consequat magna,'
        ]
    ],
];
