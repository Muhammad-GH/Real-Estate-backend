@extends('frontend.layouts.app')

@section('title','Asuntokaupan alusta')

@section('content')
    <section class="privacy-policy">
        <div class="container padding-80">
            <div class="card">
                <div class="card-body">
                    <h2>Käyttöehdot</h2>
                     
                    <p>Flipkoti on osoitteessa flipkoti.fi toimiva alusta ja operaattori asumisen alalla, jonkatavoitteena on tuoda asunnon omistajille ja asuntokauppaan erilaisia vaihtoehtoja.Flipkodin palvelut kattaa ratkaisuja asunnon ostoon, myyntiin ja remontointiin.</p>
               
                    <p>Lisäksi Flipkoti tarjoaa asuntosijoittajalle mahdollisuuksia sijoittaa asuntoihin, jokosuoraan tai Flipkodin kanssa.</p>
 
                    <p>Asunnon omistajille eri positioihin;</p>
                    <br>
                    <h4>Myymässä</h4>
                    <br>
                    <p>MaxiFlip - Avaimet käteen</p>
                    <p>Flipkoti tarjoaa valittuihin kohteisiin MaxiFlip-palvelun, jossa Flipkoti yhdessä tai muidentoimijoiden kanssa nostaa asunnon arvon ja myy asunnon parhaaseen mahdolliseenhintaan. Asunto optimoidaan ottaen huomioon vallitseva markkinatilanne ja kysyntä, sekäalueellinen kysyntä-tarjonta parhaan tiedon mukaan, jota sinä hetkellä on tiedossapalveluntarjoajalla. Lopullinen palvelupaketti räätälöidään tapauskohtaisesti. Flipkoti eisitoudu tarjoamaan palvelua kaikkiin kohteisiin, ja kohteista riippuen voidaan soveltaaerilaisia sopimusmalleja, jossa huomioidaan asiakkaan tarpeet ja toiveet.</p>
                    <p>OmaFlip</p>
                    <p>Asiakas voi ostaa Flipkodin alustasta kilpailutetut asunnon myyntiin liittyviä palveluita jadokumentteja erillisen hinnaston mukaisesti tarpeen mukaan. Hinnat ovat suuntaa-antavia jane tarkentuu tapauskohtaisesti.</p>
                    <p>LkvFLIP</p>
                    <p>Kiinteistövälitystoimeksianto Flipkodin kilpailuttaman ja suositteleman kiinteistönvälittäjänkanssa, kiinteään hintaan asunnon koon mukaan. Flipkoti pidättää oikeuden tarjota omaavälittäjää myös kohteeseen tilanteen mukaan.</p>
                    <p>Lisäksi asiakkaan on mahdollista ostaa Remonttisuunnitelma havainnollistamaan asunnonpotentiaalia, kiinteään hintaan, joka määräytyy asunnon koon mukaan.Remonttisuunnitelman avulla tilaajan asuntoon pyritään saamaan enemmän potentiaalisiaostajia. Havainnollistavilla kuvilla, valmiiksi kilpailutetuilla urakoitsijoilla ja materiaaleilla sekäesisopimuksilla saadaan aikaan helppo tapaa ostaa asunto sellaisenaan, muttamahdollistetaan remontin toteuttaminen esim. ennen asuntoon muuttoa. Flipkoti sitoutuutarjoamaan kohteiden suunnitelmat ja esisopimukset toimeksiannossa määritellyllä hinnalla.</p>
                    <p>PikaFlip</p>
                    <p>Flipkoti ostaa itse tai löytää ostajan asiakkaan asunnolle. Flipkoti hoitaa asiakirjojentilauksen, kauppakirjojen valmistelut ja kaupantekotilaisuuden järjestelyt pankissa taiFlipkodin toimistolla tai muualla palvelun tarjoajan määrittämässä paikassa. Flipkoti Oy eisitoudu asuntojen ostoon ennen virallisen kauppakirjan tai ostotarjouksen allekirjoittamista.</p>
                    <br>
                    <h4>Flippauslaskurin toimintaperiaate</h4>
                    <br>
                    <p>Flipkoti.fi palvelussa on käyttäjille tarjolla ns suuntaa-antava laskuri, jonka tarkoituksena onverrata postinumeron perusteella, miten asunnon arvoa voidaan nostaa flipkotipalveluitakäyttämällä. Asuntojen oletut myyntihinnat ovat suuntaa-antavia, ja palveluntarjoaja ei oleottanut käyttöön kaikkia postinumeroiden hintatietoja.</p>
                    <p>Käyttäjän määrittelemät lähtötiedot vaikuttavat laskennan lopputuloksiin, ja näinpalveluntarjoaja ei pysty takaamaan laskennan oikeellisuutta.</p>
                    <p>Flippauslaskurin tulokset tarkentuvat erillislaskennan ja arvioiden jälkeen, johon vaikuttaamm. taloyhtiön sekä huoneiston kunto, asuntojen yleinen kysyntä ja tarjontatilanne. Lisäksimateriaalihintojen ja työntekijähintojen kehitys ja hintataso voivat muuttaaflippauspotentiaaliin.</p>
                    <p>Flipkoti pidättää oikeuden muutoksille.</p>
                    
                    <br>
                    <h4>Ostamassa</h4>
                    <br>
                    <p>Flipkoti tarjoaa alustan, jonka kautta asiakkaat, yksityinen henkilö tai yhteisö tai yhtiö, voivathakea asuntoa. Flipkoti ei vastaa eikä sitoudu löytämään asuntoa, mutta mahdollistaaasiakkaalle tavoittaa mahdollinen uusi koti.</p>
                    <p>Käyttäjä voi jättää sivustolle myös löytämänsä asunnon tiedot, jonka kautta flipkoti arvioiasunnon potentiaalin. Asunnosta voidaan tehdä erillinen ostotoimeksiantosopimus ja asiakasvoi valita halutessaan remonttipalvelupaketeista haluamansa (basic/premium).</p>
                    
                    <br>
                    <h4>Remontoimassa</h4>
                    <br>
                    
                    <p>Flipkoti tarjoaa alustan, jonka kautta voi löytää tekijät ja materiaalit remontille.</p>
                    <p>Flipkodin laskureilla asiakas voi saada käsityksen ns markkinahinnan asunnon remonttiinperinteisissä tapauksissa. Laskureissa ei ole huomioitu poikkeuksia, kuten laajamittaisetpiilevät tai näkyvät vauriot rakenteissa, joita ei ole voitu huomioida yleispätevien laskureidentekemisessä. Flipkoti pidättää oikeuden muuttaa laskennassa käytettäviä materiaalien jatyön hintoja, eikä vastaa esim. alueellisista hintaeroista.</p>
                    <p>Laskureissa on pyritty kuvaamaan markkihintaista tasoa työn ja materiaalien osalta, jonkaavulla käyttäjä pystyy varmistamaan, ettei maksa asunnon remontoinnista ylihintaa.Laskureiden antamat tulokset ovat suuntaa-antavia.</p>
                    <p>Flipkodin palvelut asunnon remonttiin.</p>
                    
                    <br>
                    <h4>Basic</h4>
                    <br>
                    <p>urakoitsijoiden ja/tai kevyt yrittäjien kilpailutus</p>
                    <p>Ammattilaisten valikoimien rajattujen materiaalien kilpailutus.</p>
                    <p>Flipkoti ei vastaa materiaalien tai työntekijöiden jäljestä tai laadusta, mutta pyrkiivarmistamaan asianmukaisen toteutuksen ja seuraamaan toteutuksen etenemää jajohtamaan kokonaisuutta ns digiprojektijohtajana.</p>
                    <p>Flipkoti tarjoaa asiakkaalle pohjat, joilla tehdä tarvittavat ilmoitukset ja sopimukset omanetujensa turvaamiseksi.</p>
                    <p>Palvelu on ilmainen kuluttajalle. Flipkoti laskuttaa urakoitsijalta ns markkinointikustannuksen,joka perustuu sopimuksessa määriteltyyn hintaan.</p>
                    <p>Käyttäjä sitoutuu ilmoittamaan tehdyt sopimukset ja niiden hinnat kysyttäessä, tai vaatimaanurakoitsijaa käyttämään flipkodin tarjoamia työkaluja, jolla työntilaaja(kuluttaja tai yhteisö)varmistaa oman turvansa asianmukaisten sopimusten ja dokumentaation kautta.</p>
                    


                    <br>
                    <h4>Premium</h4>
                    <br>
                    
                    <p>Avaimet käteen palvelu, jossa flipkoti kantaa urakoitsijavastuun. Vastaa vakuutuksillaanremontin toteuksesta, materiaalihankinnoista, vakuutuksista.</p>
                    <p>Premium tasolla sopimus tehdään asiakkaan ja flipkodin välillä. Sopimuksen laajuus ja mallitehdään kohdekohtaisesti.</p>
                    
                    
                    <br>
                    <h4>Sijoittamassa</h4>
                    <br>
                    <p>Flipkoti tarjoaa alustan, jossa on mahdollista päästä sijoittamaan valittuihin kohteisiin eritavoilla. Flipkoti Oy kautta tai Flipkoti Oy kanssa.</p>
                    <p>Flipkoti Oy tarjoaa lisätietoa mahdollisuuksista taustatarkatetuille henkilöille tai yhtiöille.</p>
                    
                    
                    <br>
                    <h4>Palvelun käyttöön liittyviä yleisiä ehtoja;</h4>
                    <br>
                    <p>Valitsemalla tietyn palvelun Palvelussa, Käyttäjä hyväksyy valitsemansa palvelupaketinsisällön ja palvelupaketin valintaan liittyvän maksuvelvollisuuden erillisellä sopimuksella.Palveluntarjoaja toteuttaa mahdolliset palvelupakettiin kuulumattomat palvelut erillisentilauksen tai pyynnön mukaisesti ja laskuttaa palvelusta aiheutuneet kustannukset erikseenKäyttäjältä.</p>
                    <p>Käyttäjän valitsema palvelupaketti on tarkoitettu yhden Kohteen markkinoimiseksi. SamaaIlmoitusta ei voida käyttää useamman Kohteen markkinointiin, elleivät Palveluntarjoaja jaKäyttäjä ole tällaisesta erikseen sopineet.</p>
                    <p>Palveluntarjoajalla on oikeus tilapäisesti keskeyttää Palvelu, jos se on välttämätöntäPalvelun toteuttamisen tai uudistamisen vuoksi (esimerkiksi tekninen päivitys,tietoliikenneverkon asennus-, muutos- tai huoltotyöt, viranomaisen määräykset).Palveluntarjoaja pyrkii siihen, että mahdollinen keskeytys on mahdollisimman lyhyt ja ettäsiitä aiheutuvat haitat jäävät mahdollisimman vähäisiksi. Palveluntarjoaja pyrkii tiedottamaanmahdollisista katkoista etukäteen. Palveluntarjoaja ei ole vastuussa Palvelun käyttökatkoistaKäyttäjälle mahdollisesti aiheutuvista välittömistä tai välillisistä vahingoista. Palveluntarjoajaei ole vastuussa Palvelun toimivuudesta eikä mahdollisten teknisten vikojen, huoltojen taiasennustöiden aiheuttamista katkoksista, tietoliikennehäiriöistä eikä niistä mahdollisestiaiheutuvasta tiedon muuttumisesta tai katoamisesta. Palveluntarjoaja pyrkii korjaamaanmahdolliset vikatilanteet mahdollisimman nopeasti.</p>
                    <p>Palveluntarjoajan vastuu Palvelun käytöstä Käyttäjälle mahdollisesti aiheutuneistavahingoista on seuraava: Maksullisen palvelun osalta Palveluntarjoaja on vastuussaainoastaan omalla tuottamuksellaan Käyttäjälle mahdollisesti aiheuttamistaan välittömistävahingoista. Palveluntarjoajan vastuu rajoittuu kuitenkin korkeintaan siihen määrään, jonkaKäyttäjä on maksanut Palveluntarjoajalle palvelusta. Palveluntarjoaja ei vastaa Käyttäjällemahdollisesti aiheutuvista välillisistä tai epäsuorista vahingoista tai Palveluntarjoajanyhteistyökumppaneiden aiheuttamista välittömistä tai välillisistä vahingoista. Maksuttomanpalvelun osalta Palveluntarjoaja ei ole miltään osin vastuussa Käyttäjälle mahdollisestiaiheutuvista välillisistä, välittömistä tai epäsuorista vahingoista.</p>
                    <p>Palveluntarjoajalla on oikeus muuttaa Palvelun ehtoja, sisältöä ja hinnoittelua.</p>
                    <p>Käyttäjällä, jota pidetään kuluttajansuojalain (20.1.1978/38) 1 luvun 4 §:n mukaisestikuluttajana, on oikeus peruuttaa etämyyntisopimus ilmoittamalla siitäperuuttamislomakkeella tai muulla yksiselitteisellä tavalla Palveluntarjoajalle viimeistään 14päivän kuluttua palvelusopimuksen tekemisestä.</p>
                    <p>Jos palvelun suorittaminen on Käyttäjän pyynnöstä aloitettu ennen peruuttamisajanpäättymistä, Käyttäjän on peruuttamistapauksessa maksettava peruuttamisilmoituksentekemiseen mennessä sopimuksen täyttämiseksi tehdystä suorituksesta Palveluntarjoajallekohtuullinen korvaus. Jos Käyttäjä peruuttaa sopimuksen, Palveluntarjoaja saa vaatiaKäyttäjältä korvausta sellaisesta palvelusta, jonka Palveluntarjoaja on sopimuksenmukaisesti tosiasiallisesti suorittanut ennen peruuttamista.</p>
                    <p>Käyttäjän on palvelupaketin valitsemisen yhteydessä annettava suostumuksensa siihen,ettei Käyttäjällä ole kuluttajansuojalain 6 luvun 14 §:ssä säädettyä peruuttamisoikeutta, jospalvelupaketin mukainen palvelu on kokonaan suoritettu.</p>
                    <br>
                    <p>Käyttäjällä on oikeus vedota virheeseen Palvelussa ilmoittamalla siitä kirjallisestiPalveluntarjoajalle (info@flipkoti.fi ) kohtuullisessa ajassa siitä, kun virhe on havaittu taiKäyttäjän olisi pitänyt havaita virhe. Käyttäjällä on lisäksi mahdollisuus ottaa yhteyttäkunnalliseen kuluttajaneuvontaan (www.kkv.fi/asiointi) tai tehdä valituskuluttajariitalautakunnalle (www.kuluttajariita.fi).</p>
                     
                    <br><br>
                </div>
            </div>
        </div>
    </section>
@endsection