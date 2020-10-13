<?php
use App\Http\Controllers\Backend\Globals\GlobalController;
// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'global',
    'as' => 'global.',
    'middleware' => 'right:'.config('access.users.global'),
], function () {
    // Global Management
    Route::group(['namespace' => 'Global'], function () {
        Route::any('/', [GlobalController::class, 'translation_index'])->name('translation_index');
        Route::any('/general', [GlobalController::class, 'general'])->name('general');
        Route::any('/store', [GlobalController::class, 'store'])->name('store');
        Route::any('switch/{lang_code}', [GlobalController::class, 'switch'])->name('switch');
    });

});
