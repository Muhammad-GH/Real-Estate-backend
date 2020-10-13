<?php
use App\Http\Controllers\Backend\SellUsServiceRequest\SellUsServiceRequestController;
// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'SellUs-Service-request',
    'as' => 'SellUs-Service-request.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // Property Management
    Route::group(['namespace' => 'SellUs-Service-request'], function () {
        
        Route::any('/', [SellUsServiceRequestController::class, 'index'])->name('all');
        Route::any('/view/{id}', [SellUsServiceRequestController::class, 'view'])->name('view');
		
    });

});
