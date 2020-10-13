@extends('frontend.layouts.app')

@section('title','Asuntokaupan alusta')

@section('content')
<section class="privacy-policy">
        <div class="container padding-80">
            <div class="card">
                <div class="card-body">
                <h2>Rekisteri- ja tietosuojaseloste</h2>
                    <span class="date">Julkaistu 24.3.2020</span>
                    <p>Tämä on Yrityksen henkilötietolain (10 ja 24 §) ja EU:n yleisen tietosuoja-asetuksen (GDPR) mukainen rekisteri- ja tietosuojaseloste. Laadittu 13.02.2020. Viimeisin muutos 18.07.2020.</p>
                    <br>
                    <div class="item">
                        <h4>1. &nbsp;Rekisterinpitäjä</h4>
                        <p>Flipkoti Oy, Vanha Kaarelantie 33 A, 01610 Vantaa</p>
                    </div>
                    <div class="item">
                        <h4>2. &nbsp;Rekisteristä vastaava yhteyshenkilö</h4>
                        <p>Miikka Korhonen, info@flipkoti.fi, 040 5910540</p>
                    </div>
                    <div class="item">
                        <h4>3. &nbsp;Rekisterin nimi</h4>
                        <p>Flipkoti asiakastietorekisteri</p>
                    </div>
                    <div class="item">
                        <h4>4. &nbsp;Oikeusperuste ja henkilötietojen käsittelyn tarkoitus</h4>
                        <p>
                            EU:n yleisen tietosuoja-asetuksen mukainen oikeusperuste henkilötietojen käsittelylle on<br>
                            - henkilön suostumus (dokumentoitu, vapaaehtoinen, yksilöity, tietoinen ja yksiselitteinen)<br>
                            - sopimus, jossa rekisteröity on osapuolena<br>
                            - julkisen tehtävän hoitaminen (mihin perustuu), tai<br>
                            - rekisterinpitäjän oikeutettu etu (esim. asiakassuhde, työsuhde, jäsenyys).<br>
                            Henkilötietojen käsittelyn tarkoitus on yhteydenpito asiakkaisiin, asiakassuhteen ylläpito, markkinointi tms.<br>
                            Tietoja ei käytetä automatisoituun päätöksentekoon tai profilointiin.
                        </p>
                    </div>
                    <div class="item">
                        <h4>5. &nbsp;Rekisterin tietosisältö</h4>
                        <p>Rekisteriin tallennettavia tietoja ovat: henkilön nimi, asema, yritys/organisaatio, yhteystiedot (puhelinnumero, sähköpostiosoite, osoite), www-sivustojen osoitteet, verkkoyhteyden IP-osoite, tunnukset/profiilit sosiaalisen median palveluissa, tiedot tilatuista palveluista ja niiden muutoksista, laskutustiedot, muut asiakassuhteeseen ja tilattuihin palveluihin liittyvät tiedot. Myös käyttäjän antamat asuntoon liittyvät tiedot, kuten asunnon koko, sijainti, kunto.</p>
                        <p>Henkilötietoja käsitellään asiakassuhteen tai tehdyn sopimuksen täytäntöönpanoon tarvittavan ajan. Perustellusta syystä henkilötietoja voidaan säilyttää tätä pidempään arkistointitarkoituksessa (esimerkiksi sopimukset).</p>
                        <p>Verkkosivuston vierailijoiden IP-osoitteita ja evästeitä käsitellään oikeutetun edun perusteella mm. tietoturvasta huolehtimiseksi ja sivuston vierailijoiden tilastotietojen keruuta varten niissä tapauksissa, kun niiden voidaan katsoa olevan henkilötietoja. Evästeiden käytöstä kerrotaan tarkemmin erikseen mm. sivuston alareunassa.</p>
                    </div>
                    <div class="item">
                        <h4>6. &nbsp;Säännönmukaiset tietolähteet</h4>
                        <p>Rekisteriin tallennettavat tiedot saadaan asiakkaalta mm. www-lomakkeilla lähetetyistä viesteistä, sähköpostitse, puhelimitse, sosiaalisen median palvelujen kautta, sopimuksista, asiakastapaamisista ja muista tilanteista, joissa asiakas luovuttaa tietojaan.</p>
                    </div>
                    <div class="item">
                        <h4>7. &nbsp;Tietojen säännönmukaiset luovutukset ja tietojen siirto EU:n tai ETA:n ulkopuolelle</h4>
                        <p>Tietoja ei luovuteta säännönmukaisesti muille tahoille. Tietoja voidaan julkaista siltä osin kuin niin on sovittu asiakkaan kanssa.<br> Tietoja voidaan siirtää rekisterinpitäjän toimesta myös EU:n tai ETA:n ulkopuolelle. <br>Mikäli luovutat henkilötietoja eri tahoille, kerro tässä mahdolliset vastaanottajat tai vastaanottajaryhmät.</p>
                    </div>
                    <div class="item">
                        <h4>8. &nbsp;Rekisterin suojauksen periaatteet</h4>
                        <p>Rekisterin käsittelyssä noudatetaan huolellisuutta ja tietojärjestelmien avulla käsiteltävät tiedot suojataan asianmukaisesti. Kun rekisteritietoja säilytetään Internet-palvelimilla, niiden laitteiston fyysisestä ja digitaalisesta tietoturvasta huolehditaan asiaankuuluvasti. Rekisterinpitäjä huolehtii siitä, että tallennettuja tietoja sekä palvelimien käyttöoikeuksia ja muita henkilötietojen turvallisuuden kannalta kriittisiä tietoja käsitellään luottamuksellisesti ja vain niiden työntekijöiden toimesta, joiden työnkuvaan se kuuluu.</p>
                    </div>
                    <div class="item">
                        <h4>9. &nbsp;Tarkastusoikeus ja oikeus vaatia tiedon korjaamista</h4>
                        <p>Jokaisella rekisterissä olevalla henkilöllä on oikeus tarkistaa rekisteriin tallennetut tietonsa ja vaatia mahdollisen virheellisen tiedon korjaamista tai puutteellisen tiedon täydentämistä. Mikäli henkilö haluaa tarkistaa hänestä tallennetut tiedot tai vaatia niihin oikaisua, pyyntö tulee lähettää kirjallisesti rekisterinpitäjälle.</p>
                        <p>Rekisterinpitäjä voi pyytää tarvittaessa pyynnön esittäjää todistamaan henkilöllisyytensä. Rekisterinpitäjä vastaa asiakkaalle EU:n tietosuoja-asetuksessa säädetyssä ajassa (pääsääntöisesti kuukauden kuluessa).</p>
                    </div>
                    <div class="item">
                        <h4>10. &nbsp;Muut henkilötietojen käsittelyyn liittyvät oikeudet</h4>
                        <p>Rekisterissä olevalla henkilöllä on oikeus pyytää häntä koskevien henkilötietojen poistamiseen rekisteristä ("oikeus tulla unohdetuksi"). Niin ikään rekisteröidyillä on muut EU:n yleisen tietosuoja-asetuksen mukaiset oikeudet kuten henkilötietojen käsittelyn rajoittaminen tietyissä tilanteissa. Pyynnöt tulee lähettää kirjallisesti rekisterinpitäjälle. Rekisterinpitäjä voi pyytää tarvittaessa pyynnön esittäjää todistamaan henkilöllisyytensä. Rekisterinpitäjä vastaa asiakkaalle EU:n tietosuoja-asetuksessa säädetyssä ajassa (pääsääntöisesti kuukauden kuluessa)</p>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </section>
@endsection