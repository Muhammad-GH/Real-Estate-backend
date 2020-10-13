<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


// login route
Route::post('login', 'Api\Prouser\Login_ApiController@index');
// register route
Route::post('register', 'Api\Prouser\Login_ApiController@register');

Route::post('/password/email', 'Api\Prouser\ForgotPasswordController@sendResetLinkEmail');
Route::post('/password/reset', 'Api\Prouser\ResetPasswordController@reset');


Route::post('pdf', 'Api\Proposal\ProposalApiController@testpdf');



Route::group(['middleware' => 'auth:api'], function () {

    // ProUsers action routes
    Route::get('account', 'Api\Prouser\ProUserApiController@account');
    Route::post('storeDetails', 'Api\Prouser\ProUserApiController@storeDetails');
    Route::post('storePropDetails', 'Api\Prouser\ProUserApiController@storePropDetails');
    Route::post('storeAgreeDetails', 'Api\Prouser\ProUserApiController@storeAgreeDetails');
    Route::get('prousers', 'Api\Prouser\ProUserApiController@list');
    Route::post('prousers/create', 'Api\Prouser\ProUserApiController@store');
    Route::get('prousers/{id}', 'Api\Prouser\ProUserApiController@show');
    Route::get('users/{id}', 'Api\Prouser\ProUserApiController@getEmail');
    Route::put('prousers/{id}', 'Api\Prouser\ProUserApiController@update');
    Route::delete('prousers/{id}', 'Api\Prouser\ProUserApiController@destroy');
    Route::get('prousers/token/user', 'Api\Prouser\ProUserApiController@token');

    // Material action routes
    Route::post('material-request/create', 'Api\Material\MaterialRequestApiController@store');
    Route::post('material-offers/create', 'Api\Material\MaterialRequestApiController@storeOffer');
    Route::get('material-list', 'Api\Material\MaterialRequestApiController@list');
    Route::get('material-offer-detail/{id}', 'Api\Material\MaterialRequestApiController@offerDetails');
    Route::delete('list-detail/remove/{id}', 'Api\Material\MaterialRequestApiController@offerRemove');

    // Work action routes
    Route::post('work-request/create', 'Api\Work\WorkRequestApiController@forRequest');
    Route::post('work-offers/create', 'Api\Work\WorkRequestApiController@forRequest');
    Route::get('work-list', 'Api\Material\MaterialRequestApiController@list');

    // Feeds action routes
    Route::get('feeds', 'Api\Feeds\FeedsApiController@index');

    // Saved jobs routes
    Route::get('saved', 'Api\Feeds\FeedsApiController@saved');
    Route::get('saved-icon', 'Api\Feeds\FeedsApiController@icons');
    Route::post('saved/add', 'Api\Feeds\FeedsApiController@saved_add');
    Route::delete('saved/remove/{id}', 'Api\Feeds\FeedsApiController@saved_remove');

    // Category routes
    Route::get('category', 'Api\Feeds\FeedsApiController@category');

    // City/States routes
    Route::get('state/{lng}', 'Api\Feeds\FeedsApiController@state');
    Route::get('cityId/{id}/{lng}', 'Api\Feeds\FeedsApiController@cityById');

    // Config routes
    Route::get('config', 'Api\Config\ConfigApiController@index');
    Route::get('config/lang', 'Api\Config\ConfigApiController@lang');
    Route::get('config/fee', 'Api\Config\ConfigApiController@fee');
    Route::get('config/currency', 'Api\Config\ConfigApiController@currency');

    // Bids routes
    Route::post('bid/create', 'Api\Bids\BidsApiController@index');
    Route::get('bid/{id}', 'Api\Bids\BidsApiController@list');
    Route::post('bid/accept/{id}/{user_id}', 'Api\Bids\BidsApiController@accept');
    Route::post('bid/decline/{id}/{user_id}', 'Api\Bids\BidsApiController@decline');
    Route::get('getBidsNotif', 'Api\Bids\BidsApiController@get_notif');

    // My-contracts routes
    Route::get('contracts', 'Api\Contracts\ContractsApiController@index');
    Route::post('contracts/status/{id}/{updStatus}', 'Api\Contracts\ContractsApiController@status');

    // Notifications routes
    Route::put('notification/read/{id}', 'Api\Bids\BidsApiController@read_notif');

    // Dashboard Market stats routes
    Route::get('dashboard/request', 'Api\Dashboard\DashboardApiController@myRequest');
    Route::get('dashboard/offer', 'Api\Dashboard\DashboardApiController@myOffer');
    Route::get('dashboard/request-acc', 'Api\Dashboard\DashboardApiController@myReqAcc');
    Route::get('dashboard/request-dec', 'Api\Dashboard\DashboardApiController@myReqDec');
    Route::get('dashboard/offer-acc', 'Api\Dashboard\DashboardApiController@myOffAcc');
    Route::get('dashboard/offer-dec', 'Api\Dashboard\DashboardApiController@myOffDec');

    // Dashboard Bussiness stats routes
    Route::get('dashboard_bussiness/proposal', 'Api\Dashboard\DashboardApiController@myProposal');
    Route::get('dashboard_bussiness/agreement', 'Api\Dashboard\DashboardApiController@myAgreement');
    Route::get('dashboard_bussiness/invoice', 'Api\Dashboard\DashboardApiController@myInvoice');
    Route::get('dashboard_bussiness/resources', 'Api\Dashboard\DashboardApiController@myResources');
    Route::get('dashboard_bussiness/requests', 'Api\Dashboard\DashboardApiController@myRequests');

    // Resources routes
    Route::get('resourcePermission', 'Api\Resources\ResourcesApiController@resourcePermission');
    Route::get('resourcespass', 'Api\Resources\ResourcesApiController@makePassword');
    Route::get('resources-list/{type?}', 'Api\Resources\ResourcesApiController@list');
    Route::get('resource/{id}', 'Api\Resources\ResourcesApiController@resourceById');
    Route::get('resource/token/{id}', 'Api\Resources\ResourcesApiController@resourceToken');
    Route::post('resources', 'Api\Resources\ResourcesApiController@resourceInsert');
    Route::delete('resource/delete/{id}', 'Api\Resources\ResourcesApiController@resourceDelete');
    Route::put('resource/update/{id}', 'Api\Resources\ResourcesApiController@resourceUpdate');

    // Project planning routes
    Route::post('pro-plan/create', 'Api\ProjectPlanning\ProjectPlanningApiController@planInsert');
    Route::put('pro-plan/update/{name}', 'Api\ProjectPlanning\ProjectPlanningApiController@planUpdate');
    Route::delete('pro-plan/delete/{id}', 'Api\ProjectPlanning\ProjectPlanningApiController@planDelete');
    Route::get('pro-plan/get/{type}', 'Api\ProjectPlanning\ProjectPlanningApiController@planGet');
    Route::get('pro-plan/template/{name}', 'Api\ProjectPlanning\ProjectPlanningApiController@planGetByName');
    Route::get('pro-plan/names/{type}', 'Api\ProjectPlanning\ProjectPlanningApiController@GetNames');
    Route::get('pro-plan/area/{lng}', 'Api\ProjectPlanning\ProjectPlanningApiController@getArea');
    Route::get('pro-plan/phase/{id}/{lng}', 'Api\ProjectPlanning\ProjectPlanningApiController@getPhaseById');

    // Proposal routes
    Route::post('proposal/create', 'Api\Proposal\ProposalApiController@proposalInsert');
    Route::post('proposal/put', 'Api\Proposal\ProposalApiController@updateProposal');
    Route::get('proposal/get/drafts', 'Api\Proposal\ProposalApiController@getDrafts');
    Route::get('proposal/get/byID/{id}', 'Api\Proposal\ProposalApiController@getById');
    Route::get('proposal/get/byPID/{id}', 'Api\Proposal\ProposalApiController@getByPId');
    Route::get('proposal/get/latest', 'Api\Proposal\ProposalApiController@proposalGetLatestID');
    Route::get('proposal/get', 'Api\Proposal\ProposalApiController@getProposals');
    Route::get('proposal/upd/{id}/{table}/{status}', 'Api\Proposal\ProposalApiController@updateProposalStatus');

    // Agreement routes
    Route::get('agreement/get/latest', 'Api\Agreement\AgreementApiController@agreementGetLatestID');
    Route::post('agreement/create', 'Api\Agreement\AgreementApiController@agreementInsert');
    Route::get('agreement/get/drafts', 'Api\Agreement\AgreementApiController@getDrafts');
    Route::get('agreement/get/proposals', 'Api\Agreement\AgreementApiController@getProposals');
    Route::get('agreement/get/byID/{id}', 'Api\Agreement\AgreementApiController@getById');
    Route::get('agreement/get/byRID/{id}', 'Api\Agreement\AgreementApiController@getByRId');
    Route::get('agreement/get', 'Api\Agreement\AgreementApiController@getAgreements');
    Route::post('agreement/put', 'Api\Agreement\AgreementApiController@updateAgreement');
    Route::post('rating/create', 'Api\Agreement\AgreementApiController@ratingCreate');
    Route::get('agreement/upd/{id}/{table}/{status}', 'Api\Agreement\AgreementApiController@updateAgreementStatus');

    // Invoice routes
    Route::post('invoice/create', 'Api\Invoice\InvoiceApiController@invoiceCreate');
    Route::get('invoice/get', 'Api\Invoice\InvoiceApiController@invoiceGet');
    Route::get('invoice/download/{id}', 'Api\Invoice\InvoiceApiController@downloadPdf');
    Route::post('invoice/send', 'Api\Invoice\InvoiceApiController@sendPDF');
    Route::get('invoice/getPaymentTerms/{id}/{agreement}', 'Api\Invoice\InvoiceApiController@getPaymentTerms');
    Route::get('invoice/getTasks/{id}', 'Api\Invoice\InvoiceApiController@getTasks');
    Route::get('invoice/getTasksById/{id}', 'Api\Invoice\InvoiceApiController@getTasksById');
    Route::get('invoice/getProjects', 'Api\Invoice\InvoiceApiController@getProjects');
    Route::get('invoice/agreementUsers', 'Api\Invoice\InvoiceApiController@agreementUsersID');
    Route::get('invoiceAgreements/{id}', 'Api\Invoice\InvoiceApiController@agreementTermsById');

    // Agreement proposal revision routes
    Route::post('revisions/insert', 'Api\Revisions\RevisionsApiController@revisionCreate');
    Route::get('revisions/get/{id}/{table}', 'Api\Revisions\RevisionsApiController@revisionGetMsgs');

    // Phase routes
    Route::post('phase/area', 'Api\Phase\PhaseApiController@areaCreate');
    Route::get('phase/list/{lng}', 'Api\Phase\PhaseApiController@areaList');
    Route::post('phase/work', 'Api\Phase\PhaseApiController@workCreate');
    Route::get('phase/work/{lng}', 'Api\Phase\PhaseApiController@workList');
    Route::delete('phase/work_delete/{id}', 'Api\Phase\PhaseApiController@workDelete');
    Route::get('phase/work_edit/{id}', 'Api\Phase\PhaseApiController@workEdit');
    Route::put('phase/area_update/{id}', 'Api\Phase\PhaseApiController@areaUpdate');
    Route::put('phase/work_update/{id}', 'Api\Phase\PhaseApiController@workUpdate');


    // Route::post('att', 'Api\Proposal\ProposalApiController@sendEmailAttachment');
    // Route::post('logout','Api\ProUserApiController@logoutApi');
});
