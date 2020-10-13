<?php

use App\Http\Controllers\Backend\Request\RequestController;

// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'request',
    'as' => 'request.',
    'middleware' => 'right:'.config('access.users.request'),
], function () {
    // Setting Management
    Route::group(['namespace' => 'Request'], function () {
        
        Route::get('/', [RequestController::class, 'index'])->name('index');
        
        Route::get('/contact', [RequestController::class, 'index'])->name('contact');
        Route::get('/contact/{request_id}', [RequestController::class, 'contact_view'])->name('contact_view');
        Route::get('/classified', [RequestController::class, 'classified'])->name('classified');
        Route::get('/classified/{request_id}', [RequestController::class, 'classified_view'])->name('classified_view');
        Route::post('/upload_image', [RequestController::class, 'uploadImage'])->name('uploadImage');
        // Route::get('/create', [SettingController::class, 'create'])->name('create');
        // Route::post('/', [SettingController::class, 'store'])->name('store');
        // Route::get('show/{blog_id}', [SettingController::class, 'show'])->name('show');
        
        // Route::get('destroy/{blog_id}', [SettingController::class, 'destroy'])->name('destroy');
        
        // Route::get('delete/{blog_id}', [SettingController::class, 'delete'])->name('delete-permanently');
        // Route::get('restore/{blog_id}', [SettingController::class, 'restore'])->name('restore');
        // Route::get('deleted', [SettingController::class, 'getDeletedBlog'])->name('deleted');

        
        // Route::get('edit/{blog_id}', [SettingController::class, 'edit'])->name('edit');
        // Route::patch('update/{blog_id}', [SettingController::class, 'update'])->name('update');
        
        // //pdf Routes
        // Route::get('/pdf', [SettingController::class, 'index_pdf'])->name('pdf.index');
        // Route::get('/pdf/create', [SettingController::class, 'create_pdf'])->name('pdf.create');
        // Route::post('/pdf', [SettingController::class, 'store_pdf'])->name('pdf.store');
        
        // Route::get('pdf/destroy/{cat_id}', [SettingController::class, 'destroy_pdf'])->name('pdf.destroy');
        
        // Route::get('pdf/delete/{cat_id}', [SettingController::class, 'delete_pdf'])->name('pdf.delete-permanently');
        // Route::get('pdf/restore/{cat_id}', [SettingController::class, 'restore_pdf'])->name('pdf.restore');
        // Route::get('pdf/deleted', [SettingController::class, 'getDeletedpdf'])->name('pdf.deleted');

        
        // Route::get('pdf/edit/{cat_id}', [SettingController::class, 'edit_pdf'])->name('pdf.edit');
        // Route::patch('pdf/update/{cat_id}', [SettingController::class, 'update_pdf'])->name('pdf.update');
        
    });

});
