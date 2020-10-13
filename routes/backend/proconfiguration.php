<?php

use App\Http\Controllers\Backend\Pro\Configuration\ConfigurationController;

// All route names are prefixed with 'Configuration'.
Route::group([
    'prefix' => 'configuration',
    'as' => 'configuration.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // Category Management
    Route::group(['namespace' => 'configuration'], function () {

        Route::get('/', [ConfigurationController::class, 'index'])->name('index');
         
        Route::post('/', [ConfigurationController::class, 'store'])->name('store');
        Route::get('edit/{category_id}', [ConfigurationController::class, 'edit'])->name('edit');
        Route::any('update/{category_id}', [ConfigurationController::class, 'update'])->name('update');
        
    });

});
