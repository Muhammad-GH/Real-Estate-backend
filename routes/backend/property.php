<?php

use App\Http\Controllers\Backend\Property\PropertyController;

// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'property',
    'as' => 'property.',
    'middleware' => 'right:'.config('access.users.property'),
], function () {
    // Property Management
    Route::group(['namespace' => 'Property'], function () {
        
        // Property Status'
        Route::get('deleted', [PropertyController::class, 'getDeleted'])->name('deleted');

        // Property CRUD
        Route::get('/', [PropertyController::class, 'index'])->name('index');
        Route::get('create', [PropertyController::class, 'create'])->name('create');
        Route::post('/', [PropertyController::class, 'store'])->name('store');
        Route::get('/contact', [PropertyController::class, 'contact'])->name('contact');
        
        Route::get('/contact/{id}/show', [PropertyController::class, 'contactshow'])->name('contactshow');
        Route::get('/contact/{id}/reply', [PropertyController::class, 'contactreply'])->name('contactreply');
        
        Route::get('destroy/{property}', [PropertyController::class, 'destroy'])->name('destroy');
        
        // // Deleted
        Route::get('delete/{property}', [PropertyController::class, 'delete'])->name('delete-permanently');
        Route::get('restore/{property}', [PropertyController::class, 'restore'])->name('restore');
        Route::get('deleteimage/{property}', [PropertyController::class, 'deleteimage'])->name('deleteimage');

        // Property
        Route::get('show/{property}', [PropertyController::class, 'show'])->name('show');
        Route::get('edit/{property}', [PropertyController::class, 'edit'])->name('edit');
        Route::patch('update/{property}', [PropertyController::class, 'update'])->name('update');


        Route::get('/myymassa-queries', [PropertyController::class, 'myymassa_query'])->name('myymassa');
        Route::get('/myymassa_query/{id}/show', [PropertyController::class, 'myymassa_view'])->name('myymassa_view');

        Route::get('/ostamassa-apartment', [PropertyController::class, 'ostamassa_apartments'])->name('ostamassa');
        Route::get('/ostamassa-request', [PropertyController::class, 'ostamassa_requests'])->name('ostamassa_request');
        Route::get('/ostamassa-request-view/{id}', [PropertyController::class, 'ostamassa_request_view'])->name('ostamassa_request_view');

        Route::get('/ostamassa-apartment/{id}/show', [PropertyController::class, 'ostamassa_apartment_details'])->name('ostamassa_view');
        
        Route::get('/ostamassa-apartment/{id}/edit', [PropertyController::class, 'ostamassa_apartment_edit'])->name('ostamassa_edit');
        
        Route::get('/ostamassa-apartment/{id}/delete', [PropertyController::class, 'ostamassa_apartment_delete'])->name('ostamassa_delete');

        Route::patch('ostamassa-update/{property}', [PropertyController::class, 'ostamassa_update'])->name('ostamassa_update');

        Route::get('/ostamassa-approve/{id}', [PropertyController::class, 'ostamassa_approve'])->name('ostamassa_approve');
        Route::get('/ostamassa-disapprove/{id}', [PropertyController::class, 'ostamassa_disapprove'])->name('ostamassa_disapprove');
        
        
    });

});
