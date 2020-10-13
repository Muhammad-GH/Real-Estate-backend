<?php

use App\Http\Controllers\Backend\Blog\BlogController;

// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'blog',
    'as' => 'blog.',
    'middleware' => 'right:'.config('access.users.blog'),
], function () {
    // Property Management
    Route::group(['namespace' => 'Blog'], function () {
        
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::get('/create', [BlogController::class, 'create'])->name('create');
        Route::post('/', [BlogController::class, 'store'])->name('store');
        Route::get('show/{blog_id}', [BlogController::class, 'show'])->name('show');
        
        Route::get('destroy/{blog_id}', [BlogController::class, 'destroy'])->name('destroy');
        Route::get('changestatus/{blog_id}/{status}', [BlogController::class, 'changestatus'])->name('changestatus');
        
        Route::get('delete/{blog_id}', [BlogController::class, 'delete'])->name('delete-permanently');
        Route::get('restore/{blog_id}', [BlogController::class, 'restore'])->name('restore');
        Route::get('deleted', [BlogController::class, 'getDeletedBlog'])->name('deleted');

        
        Route::get('edit/{blog_id}', [BlogController::class, 'edit'])->name('edit');
        Route::patch('update/{blog_id}', [BlogController::class, 'update'])->name('update');
        
        //Category Routes
        Route::get('/category', [BlogController::class, 'index_category'])->name('category.index');
        Route::get('/category/create', [BlogController::class, 'create_category'])->name('category.create');
        Route::post('/category', [BlogController::class, 'store_category'])->name('category.store');
        
        Route::get('category/destroy/{cat_id}', [BlogController::class, 'destroy_category'])->name('category.destroy');
        
        Route::get('category/delete/{cat_id}', [BlogController::class, 'delete_category'])->name('category.delete-permanently');
        Route::get('category/restore/{cat_id}', [BlogController::class, 'restore_category'])->name('category.restore');
        Route::get('category/deleted', [BlogController::class, 'getDeletedCategory'])->name('category.deleted');

        
        Route::get('category/edit/{cat_id}', [BlogController::class, 'edit_category'])->name('category.edit');
        Route::patch('category/update/{cat_id}', [BlogController::class, 'update_category'])->name('category.update');
        
    });

});
