<?php

use App\Http\Controllers\Frontend\MarketplaceController;
use App\Http\Controllers\Frontend\AjaxController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::group([
    'prefix' => 'markkinapaikka',
    'as' => 'marketplace.'
], function () {
    Route::group(['namespace' => 'marketplace'], function () {

        Route::get('/', [MarketplaceController::class, 'index'])->name('index');
        Route:: get('/material/{id}', [MarketplaceController::class, 'materialDetail'])->name('materialdetail');
        Route:: get('/work/{id}', [MarketplaceController::class, 'workDetail'])->name('workdetail');
        Route::post('/work-bid/{id}', [MarketplaceController::class, 'storeWorkBid'])->name('storeWorkBid');
        Route::post('/material-bid/{id}', [MarketplaceController::class, 'storeMaterialBid'])->name('storeMaterialBid');
    });
});