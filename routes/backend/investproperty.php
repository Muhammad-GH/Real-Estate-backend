<?php

use App\Http\Controllers\Backend\InvestProperty\InvestPropertyController;

// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'investproperty',
    'as' => 'investproperty.',
    'middleware' => 'right:'.config('access.users.invest'),
], function () {    
    // Property Management
    Route::group(['namespace' => 'InvestProperty'], function () {
        
        // Property Status'
        Route::get('deleted', [InvestPropertyController::class, 'getDeleted'])->name('deleted');

        // Property CRUD
        Route::get('/', [InvestPropertyController::class, 'index'])->name('index');
        Route::get('create', [InvestPropertyController::class, 'create'])->name('create');
        Route::post('/', [InvestPropertyController::class, 'store'])->name('store');
        Route::get('/contact', [InvestPropertyController::class, 'contact'])->name('contact');
        
        Route::get('/contact/{id}/show', [InvestPropertyController::class, 'contactshow'])->name('contactshow');
        Route::get('/contact/{id}/reply', [InvestPropertyController::class, 'contactreply'])->name('contactreply');
        
        Route::get('destroy/{property}', [InvestPropertyController::class, 'destroy'])->name('destroy');
        
        // // Deleted
        Route::get('delete/{property}', [InvestPropertyController::class, 'delete'])->name('delete-permanently');
        Route::get('restore/{property}', [InvestPropertyController::class, 'restore'])->name('restore');
        Route::get('deleteimage/{property}', [InvestPropertyController::class, 'deleteimage'])->name('deleteimage');

        // Property
        Route::get('show/{property}', [InvestPropertyController::class, 'show'])->name('show');
        Route::get('edit/{property}', [InvestPropertyController::class, 'edit'])->name('edit');
        Route::patch('update/{property}', [InvestPropertyController::class, 'update'])->name('update');

        Route::get('/invest_requests', [InvestPropertyController::class, 'invest_request'])->name('invest_request');
        Route::get('/invest_request/{id}/show', [InvestPropertyController::class, 'invest_request_view'])->name('invest_request_view');
        
    });

});
