<?php

use App\Http\Controllers\Backend\Setting\SettingController;

// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'setting',
    'as' => 'setting.',
    'middleware' => 'right:'.config('access.users.setting'),
], function () {
    // Setting Management
    Route::group(['namespace' => 'Setting'], function () {
        
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::get('/create', [SettingController::class, 'create'])->name('create');
        Route::post('/', [SettingController::class, 'store'])->name('store');
        Route::get('show/{blog_id}', [SettingController::class, 'show'])->name('show');
        
        Route::get('destroy/{blog_id}', [SettingController::class, 'destroy'])->name('destroy');
        
        Route::get('delete/{blog_id}', [SettingController::class, 'delete'])->name('delete-permanently');
        Route::get('restore/{blog_id}', [SettingController::class, 'restore'])->name('restore');
        Route::get('deleted', [SettingController::class, 'getDeletedBlog'])->name('deleted');

        
        Route::get('edit/{blog_id}', [SettingController::class, 'edit'])->name('edit');
        Route::patch('update/{blog_id}', [SettingController::class, 'update'])->name('update');
        
        //pdf Routes
        Route::get('/pdf', [SettingController::class, 'index_pdf'])->name('pdf.index');
        Route::get('/pdf/create', [SettingController::class, 'create_pdf'])->name('pdf.create');
        Route::post('/pdf', [SettingController::class, 'store_pdf'])->name('pdf.store');
        
        Route::get('pdf/destroy/{cat_id}', [SettingController::class, 'destroy_pdf'])->name('pdf.destroy');
        
        Route::get('pdf/delete/{cat_id}', [SettingController::class, 'delete_pdf'])->name('pdf.delete-permanently');
        Route::get('pdf/restore/{cat_id}', [SettingController::class, 'restore_pdf'])->name('pdf.restore');
        Route::get('pdf/deleted', [SettingController::class, 'getDeletedpdf'])->name('pdf.deleted');

        
        Route::get('pdf/edit/{cat_id}', [SettingController::class, 'edit_pdf'])->name('pdf.edit');
        Route::patch('pdf/update/{cat_id}', [SettingController::class, 'update_pdf'])->name('pdf.update');
        
    });

});
