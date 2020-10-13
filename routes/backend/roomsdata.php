<?php

use App\Http\Controllers\Backend\RoomsData\RoomsDataController;

// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'roomsdata',
    'as' => 'roomsdata.',
    'middleware' => 'role:'.config('access.users.admin_role'),
], function () {
    // Property Management
    Route::group(['namespace' => 'RoomsData'], function () {
        Route::get('/', [RoomsDataController::class, 'index'])->name('index');
        Route::get('/create', [RoomsDataController::class, 'create'])->name('create');
        Route::post('/', [RoomsDataController::class, 'store'])->name('store');
        Route::get('edit/{id}', [RoomsDataController::class, 'edit'])->name('edit');
        Route::any('update/{id}', [RoomsDataController::class, 'update'])->name('update');
        Route::any('destroy/{id}', [RoomsDataController::class, 'destroy'])->name('destroy');
    });

});
