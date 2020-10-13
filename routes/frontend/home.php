<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\Sell\SellController;
use App\Http\Controllers\Frontend\Sale\SaleController;
use App\Http\Controllers\Frontend\Buying\BuyingController;
use App\Http\Controllers\Frontend\Stationing\StationingController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\Frontend\Blog\BlogController;
use App\Http\Controllers\Frontend\AjaxController;
use App\Http\Controllers\Frontend\ProfessionalsController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
$site_mode_consumer =  config('global_configurations.admin.site_mode_consumer');
if($site_mode_consumer == 1){
    Route::any('/', [HomeController::class, 'development'])->name('development');
    Route::any('/home', [HomeController::class, 'index'])->name('index');
}else{
    Route::any('/', [HomeController::class, 'index'])->name('index');
}

Route:: any('/kiitos', [HomeController::class, 'thankyou'])->name('kiitos');
Route:: any('/uutiskirje-kiitos', [HomeController::class, 'thankyou_subscribe'])->name('uutiskirje-kiitos');

Route:: any('/sijoittajalle-kiitos', [HomeController::class, 'sijoittajalle_kiitos'])->name('sijoittajalle-kiitos');
Route:: any('/palveluntarjoajalle-kiitos', [HomeController::class, 'palveluntarjoajalle_kiitos'])->name('palveluntarjoajalle-kiitos');
Route:: any('/kiinteistot-ja-taloyhtiot-kiitos', [HomeController::class, 'kiinteistot_ja_taloyhtiot_kiitos'])->name('kiinteistot-ja-taloyhtiot-kiitos');
Route:: any('/kiinteistot-ja-taloyhtiot-kiinteistokilpailuttaja-kiitos', [HomeController::class, 'kiinteistot_ja_taloyhtiot_kiinteistokilpailuttaja_kiitos'])->name('kiinteistot-ja-taloyhtiot-kiinteistokilpailuttaja-kiitos');
Route:: any('/remontoimassa-kiitos', [HomeController::class, 'remontoimassa_kiitos'])->name('remontoimassa-kiitos');
Route:: any('/ota-yhteytta-kiitos', [HomeController::class, 'ota_yhteytta_kiitos'])->name('ota-yhteytta-kiitos');

Route:: any('/changelanguage', [HomeController::class, 'changelanguage'])->name('changelanguage');
Route:: any('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe');
Route::any('/flippauslaskuri-tiedot', [HomeController::class, 'calculator_final'])->name('calculator_final');
Route::get('/remontoimassa', [HomeController::class, 'renovation_calculator'])->name('renovation-calculator');
Route::any('/remonttilaskuri-arvio/{portion_type}', [HomeController::class, 'calculateRenovationCost'])->name('calculated-renovation-cost');
Route::any('/remonttilaskuri', [HomeController::class, 'renocalculator_final'])->name('reno-calculator-final');
Route::any('/reno-calculator', [HomeController::class, 'renocalculator'])->name('reno-calculator');
Route::any('/flippausarvio', [HomeController::class, 'calculator'])->name('calculator');
Route::any('/myytavat-asunnot', [BuyingController::class, 'index'])->name('buying');
Route::get('/myytavat-asunnot/{property}', [BuyingController::class, 'view'])->name('buying_prop');
Route::post('/store_contact_property', [BuyingController::class, 'store_contact'])->name('store_contact_property');
/* new pages*/
Route::any('/myy-kiinteistösi', [SellController::class, 'sellYourProperty'])->name('myy-kiinteistösi');

Route::any('/myy-meille', [HomeController::class, 'sellUs'])->name('myy-meille');
Route::any('/ostamassa', [HomeController::class, 'ostamassa'])->name('ostamassa');
Route::post('/submitcareer', [HomeController::class, 'submitcareer'])->name('submitcareer');
Route::any('/ura', [HomeController::class, 'ura'])->name('ura');
Route::any('/uraosasto/{department}', [HomeController::class, 'uraosasto'])->name('uraosasto');
Route::any('/uradetails/{id}', [HomeController::class, 'uradetails'])->name('uradetails');
Route::any('/kiinteistot-ja-taloyhtiot', [HomeController::class, 'FKProkiinteistoilleTaloyhtioille'])->name('FKPro-kiinteistoille-taloyhtioille');
Route::any('/palveluntarjoajalle', [HomeController::class, 'FKProPalveluntarjoajalle'])->name('FKPro-Palveluntarjoajalle');
// Route::post('/FKProPalveluntarjoajalleSend', [HomeController::class, 'FKProPalveluntarjoajalleSend'])->name('FKProPalveluntarjoajalleSend');
Route::any('/sijoittajalle', [HomeController::class, 'FKProSijoittajalle'])->name('FK-Pro-Sijoittajalle');
Route::any('/kayttoehdot', [HomeController::class, 'terms'])->name('terms');
#Route::any('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::any('/tietosuojaselosteen', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');

Route::any('/ostamassa', [SaleController::class, 'index'])->name('sale');
Route::any('/ostamassa-kiitos', [SaleController::class, 'ostamassa_thankyou'])->name('ostamassa_thankyou');
Route::any('/professional-enquiry', [HomeController::class, 'professionalEnquiry'])->name('professional-enquiry');
Route::any('/myy-asuntosi', [SellController::class, 'index'])->name('sell');

Route::any('/myy-kiinteistosi', [SellController::class, 'sell_ad'])->name('sell_ad');

Route::any('/myymassa-kiitos', [SellController::class, 'sell_thankyou'])->name('sell_thankyou');
Route::any('/tietosuojaseloste', [HomeController::class, 'tietosuojaseloste'])->name('tietosuojaseloste');
Route::any('/ostettavat-asunnot', [SellController::class, 'sell_property'])->name('sell_property');
Route::any('/ostettavat-asunnot/{property}', [SellController::class, 'sell_property_details'])->name('sell_property_details');
Route::post('/ostettavat-asunnot-contact', [SellController::class, 'store_contact'])->name('store_contact_ostettavat');
Route::any('/sijoittamassa', [StationingController::class, 'index'])->name('stationing');
Route::any('/investment-case', [StationingController::class, 'investment_case'])->name('investment_case');
Route::any('/flippauslaskuri', [HomeController::class, 'flipCalculator'])->name('flip-calculator');

Route::any('/Meista', [HomeController::class, 'about_us'])->name('about_us');
Route::any('loyda-asunto',[HomeController::class,'findapartment'])->name('find-apartment');
Route::any('myymassa-lomake', [HomeController::class, 'sellusForm'])->name('sellus-form');

Route::any('pikaflip-lomake', [HomeController::class, 'sellusForm'])->name('pikaflip-lomake');
Route::any('lkvflip-lomake', [HomeController::class, 'sellusForm'])->name('lkvflip-lomake');
Route::any('omaflip-lomake', [HomeController::class, 'sellusForm'])->name('omaflip-lomake');

Route::any('omaflip-palvelut/{id}/{size}', [HomeController::class, 'sellusServiceForm'])->name('sellus-service-form');
Route::post('sellus-services-submission',[HomeController::class, 'sellusServiceSubmission'])->name('sellus-services-submission');
Route::any('/myymässä-kiitos', [SellController::class, 'sellusService_thankyou'])->name('sellusService_thankyou');

Route::any('/pikaflip-kiitos', [SellController::class, 'sellusService_thankyou'])->name('pikaflip-kiitos');
Route::any('/lkvflip-kiitos', [SellController::class, 'sellusService_thankyou'])->name('lkvflip-kiitos');
Route::any('/omaflip-kiitos', [SellController::class, 'sellusService_thankyou'])->name('omaflip-kiitos');

Route::any('myy-kiinteisto-kiitos',[HomeController::class, 'sellAdForm'])->name('sell-ad-form');
Route::any('/ota-yhteytta', [HomeController::class, 'contact_us'])->name('contact_us');

Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::post('home/send', [HomeController::class, 'send'])->name('home.send');
Route::any('/remonttilaskuri-kiitos', [HomeController::class, 'renovationThankyou'])->name('remonttilaskuri-kiitos');

Route::any('/flippauslaskuri-kiitos', [HomeController::class, 'FlipThankyou'])->name('Flip-thankyou');
Route::get('blog', [BlogController::class, 'index'])->name('blog');
Route::get('blog/{id}', [BlogController::class, 'category'])->name('blog.category');
Route::get('blog/view/{id}', [BlogController::class, 'view'])->name('blog.view');
Route::post('ajax/save-page-content', [AjaxController::class, 'savePageContent'])->name('savePageContent');

Route::any('/service-form-save', [ProfessionalsController::class, 'serviceFormSave'])->name('serviceFormSave');
/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 * These routes can not be hit if the password is expired
 */
Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        
        Route::any('/investment-case/{property}', [StationingController::class, 'investment_view'])->name('investment_view');
        Route::any('/investment-kiitos', [StationingController::class, 'investment_thankyou'])->name('investment_thankyou');

        // User Dashboard Specific
        Route::any('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // User Account Specific
        Route::any('account', [AccountController::class, 'index'])->name('account');

        // User Profile Specific
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
});
