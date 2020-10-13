<?php

use App\Http\Controllers\Backend\Pages\PagesController;

// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'pages',
    'as' => 'pages.',
    'middleware' => 'right:'.config('access.users.pages'),
], function () {
    // Property Management
    Route::group(['namespace' => 'Pages'], function () {
        
        Route::get('/', [PagesController::class, 'index'])->name('index');
        Route::get('/create', [PagesController::class, 'create'])->name('create');
        Route::post('/', [PagesController::class, 'store'])->name('store');
        Route::get('edit/{pagesId}', [PagesController::class, 'edit'])->name('edit');
        Route::any('/editPage',[PagesController::class, 'editPage'])->name('editPage');
        Route::any('update/{pagesId}', [PagesController::class, 'update'])->name('update');
    });

});
