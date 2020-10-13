<?php
use App\Http\Controllers\Backend\Emails\EmailController;
// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'emails',
    'as' => 'emails.',
    'middleware' => 'right:'.config('access.users.email'),
], function () {
    // Property Management
    Route::group(['namespace' => 'Emails'], function () {
        
        //Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::any('/', [EmailController::class, 'index'])->name('index');
        Route::get('/create', [EmailController::class, 'create'])->name('create');
        // Route::get('/create_/{id}', [EmailController::class, 'create_'])->name('create_');
        Route::post('/', [EmailController::class, 'store'])->name('store');
        Route::get('edit/{id}', [EmailController::class, 'edit'])->name('edit');
        Route::any('update/{id}', [EmailController::class, 'update'])->name('update');
        Route::any('destroy/{id}', [EmailController::class, 'destroy'])->name('destroy');
        Route::any('/send', [EmailController::class, 'send_mail'])->name('send_mail');
        Route::any('/case', [EmailController::class, 'case'])->name('case');
        Route::any('/store_case', [EmailController::class, 'store_case'])->name('store_case');
        Route::any('/destroy_case/{id}', [EmailController::class, 'destroy_case'])->name('destroy_case');
		// Route::any('/addworkoffer', [WorkOfferController::class, 'addworkoffer'])->name('addworkoffer');
    });

});
