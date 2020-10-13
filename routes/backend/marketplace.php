<?php
use App\Http\Controllers\Backend\Marketplace\MaterialOfferController;
use App\Http\Controllers\Backend\Marketplace\MaterialRequestController;
use App\Http\Controllers\Backend\Marketplace\WorkOfferController;
use App\Http\Controllers\Backend\Marketplace\WorkRequestController;
// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'marketplace',
    'as' => 'marketplace.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // Property Management
    Route::group(['namespace' => 'Marketplace'], function () {
        
        //Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::any('/work-offers', [WorkOfferController::class, 'index'])->name('index');
		Route::any('work-offers/create', [WorkOfferController::class, 'addworkoffer'])->name('addworkoffer');
		Route::any('/work-offers/edit/{id}', [WorkOfferController::class, 'editworkoffer'])->name('editworkoffer');
		Route::any('/work-offers/view/{id}', [WorkOfferController::class, 'viewworkoffer'])->name('viewworkoffer');
		Route::any('/work-offers/delete/{id}', [WorkOfferController::class, 'deleteworkoffer'])->name('deleteworkoffer');
		
		// Work Request
		Route::any('/work-request', [WorkRequestController::class, 'index'])->name('WorkRequests');
		
		Route::any('/work-request/create', [WorkRequestController::class, 'addWorkRequest'])->name('WorkRequests.create');
		
		Route::any('/work-request/view/{id}', [WorkRequestController::class, 'viewWorkRequest'])->name('WorkRequests.view');
		
		Route::any('/work-request/edit/{id}', [WorkRequestController::class, 'editWorkRequest'])->name('WorkRequests.edit');
		
		Route::any('/work-request/delete/{id}', [WorkRequestController::class, 'deleteWorkRequest'])->name('WorkRequests.delete');
		
		// Material CRUD
        Route::get('/material-requests', [MaterialRequestController::class, 'index'])->name('MaterialRequests');
        Route::get('/material-requests/create', [MaterialRequestController::class, 'create'])->name('MaterialRequests.create');
        Route::post('/material-requests', [MaterialRequestController::class, 'store'])->name('MaterialRequests.store');
		Route::get('/material-requests/show/{material}', [MaterialRequestController::class, 'show'])->name('MaterialRequests.show');
        Route::get('/material-requests/edit/{material}', [MaterialRequestController::class, 'edit'])->name('MaterialRequests.edit');
        Route::patch('/material-requests/update/{material}', [MaterialRequestController::class, 'update'])->name('MaterialRequests.update');
        Route::get('/material-requests/destroy/{material}', [MaterialRequestController::class, 'destroy'])->name('MaterialRequests.destroy');
        Route::get('/material-requests/deleteimage/{material}/{imagekey}', [MaterialRequestController::class, 'deleteimage'])->name('MaterialRequests.deleteimage');
        // Material Offer CRUD
        Route::group(['prefix' => 'material-offers'], function () {
	        Route::get('/', [MaterialOfferController::class, 'index'])->name('MaterialOffers');
	        Route::get('/create', [MaterialOfferController::class, 'create'])->name('MaterialOffer.create');
	        Route::post('/', [MaterialOfferController::class, 'store'])->name('MaterialOffer.store');

	        Route::get('/show/{material}', [MaterialOfferController::class, 'show'])->name('MaterialOffer.show');

	        Route::get('/edit/{material}', [MaterialOfferController::class, 'edit'])->name('MaterialOffer.edit');
	        Route::patch('/update/{material}', [MaterialOfferController::class, 'update'])->name('MaterialOffer.update');

	        Route::get('/destroy/{material}', [MaterialOfferController::class, 'destroy'])->name('MaterialOffer.destroy');

	        Route::get('/deleteimage/{material}/{imagekey}', [MaterialOfferController::class, 'deleteimage'])->name('MaterialOffer.deleteimage');
			
			
        
    	});
		
		// Work Bid
		
		Route::any('/work-offers/{id}/bids', [WorkOfferController::class, 'bidListing'])->name('workOfferBidListing');
		
		Route::any('/work-offers/{id}/bids/view/{bidId}', [WorkOfferController::class, 'bidDetail'])->name('workOfferBidDetail');
		
		
		Route::any('/work-request/{id}/bids', [WorkRequestController::class, 'bidListing'])->name('workRequestBidListing');
		
		Route::any('/work-request/{id}/bids/view/{bidId}', [WorkRequestController::class, 'bidDetail'])->name('workRequestBidDetail');
		
		// Material Bid
		
		Route::any('/material-offers/{id}/bids', [MaterialOfferController::class, 'bidListing'])->name('materialOfferBidListing');
		
		Route::any('/material-offers/{id}/bids/view/{bidId}', [MaterialOfferController::class, 'bidDetail'])->name('materialOfferBidDetail');
		
		Route::get('/material-requests/{id}/bids', [MaterialRequestController::class, 'bidListing'])->name('materialRequestBidListing');
		
		Route::get('/material-requests/{id}/bids/view/{bidId}', [MaterialRequestController::class, 'bidDetail'])->name('materialRequestBidDetail');
		
		
        
    });

});
