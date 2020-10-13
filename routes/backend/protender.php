<?php

use App\Http\Controllers\Backend\Pro\Marketplace\TenderController;

// All route names are prefixed with 'Tender'.
Route::group([
    'prefix' => 'tender',
    'as' => 'tender.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // Tender Management
    Route::group(['namespace' => 'Tender'], function () {

        Route::get('/', [TenderController::class, 'index'])->name('index');
        Route::get('/create', [TenderController::class, 'create'])->name('create');
        Route::get('/fetch_data', [TenderController::class, 'fetch_data'])->name('fetch_data');
        Route::get('/work_offer', [TenderController::class, 'work_offer'])->name('work_offer');
        Route::get('/work_request', [TenderController::class, 'work_request'])->name('work_request');
        Route::get('/material_offer', [TenderController::class, 'material_offer'])->name('material_offer');
        Route::get('/material_request', [TenderController::class, 'material_request'])->name('material_request');
        Route::post('/', [TenderController::class, 'store'])->name('store');
        Route::get('edit/{tender_id}', [TenderController::class, 'edit'])->name('edit');
        Route::get('view/{tender_id}', [TenderController::class, 'view'])->name('view');
        Route::any('update/{tender_id}', [TenderController::class, 'update'])->name('update');
        Route::any('destroy/{tender_id}', [TenderController::class, 'destroy'])->name('destroy');
        
    });

});
