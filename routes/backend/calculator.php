<?php

use App\Http\Controllers\Backend\Calculator\CalculatorController;
use App\Http\Controllers\Backend\frontendManagement\FrontendManagementController;

// All route names are prefixed with 'property'.
Route::group([
    'prefix' => 'calculator',
    'as' => 'calculator.',
    'middleware' => 'right:'.config('access.users.calculator'),
], function () {
    // Calculator Management
    Route::group(['namespace' => 'Calculator'], function () {
        Route::get('/', [CalculatorController::class, 'index'])->name('index');
        Route::get('/flip-calc', [CalculatorController::class, 'flipcalc'])->name('flip-calc');
        Route::any('/result-percentage', [CalculatorController::class, 'resultpercentage'])->name('result-percentage');
        Route::any('/renovation-submissions', [CalculatorController::class, 'renovationsubmissions'])->name('renovation-submissions');
        Route::any('/flip-submissions', [CalculatorController::class, 'flipsubmissions'])->name('flip-submissions');
        Route::get('/renovation-view/{id}', [CalculatorController::class, 'renovationview'])->name('renovation-view');
        Route::get('/flip-view/{id}', [CalculatorController::class, 'flipview'])->name('flip-view');
        Route::get('/destroysubmission/{id}', [CalculatorController::class, 'destroysubmission'])->name('destroysubmission');
        Route::any('/create-result-percentage',[CalculatorController::class, 'createResultPercentage'])->name('create-result-percentage');
        Route::get('/remontoimassa', [CalculatorController::class, 'Calculator'])->name('renovation-calculator');
        Route::post('/importareaselling', [CalculatorController::class, 'importareaselling'])->name('importareaselling');
        Route::get('/work-rates', [CalculatorController::class, 'workRates'])->name('work-rates');
        Route::get('/import-data', [CalculatorController::class, 'importdata'])->name('import-data');
        Route::post('/import-workrates', [CalculatorController::class, 'importworkrates'])->name('import-workrates');
        Route::post('/import-workrates-new', [CalculatorController::class, 'importworkratesnew'])->name('import-workrates-new');
        Route::post('/import-materialsrates', [CalculatorController::class, 'importmaterialsrates'])->name('import-materialsrates');
        Route::post('/export-materialsrates', [CalculatorController::class, 'exportmaterialsrates'])->name('export-materialsrates');
        Route::post('/export-workrates', [CalculatorController::class, 'exportworksrates'])->name('export-workrates');
        Route::post('/', [CalculatorController::class, 'store'])->name('store');
        Route::post('/updateapprtment', [CalculatorController::class, 'updateapprtment'])->name('updateapprtment');
        Route::post('/updatematerials', [CalculatorController::class, 'updatematerials'])->name('updatematerials');
        Route::post('/updatworkrates', [CalculatorController::class, 'updatworkrates'])->name('updatworkrates');
        Route::post('/updateproperty', [CalculatorController::class, 'updateproperty'])->name('updateproperty');
        Route::post('/updateothermaterials', [CalculatorController::class, 'updateothermaterials'])->name('updateothermaterials');
        Route::post('/updateareaselling', [CalculatorController::class, 'updateareaselling'])->name('updateareaselling');
        Route::post('/createareaselling', [CalculatorController::class, 'createareaselling'])->name('createareaselling');
        Route::post('/createappartment', [CalculatorController::class, 'createappartment'])->name('createappartment');
        Route::post('/createproperty', [CalculatorController::class, 'createproperty'])->name('createproperty');
        Route::post('/destroy', [CalculatorController::class, 'destroy'])->name('destroy');
    });

});
Route::group([
    'prefix' => 'frontendmanagement',
    'as' => 'frontendmanagement.',
    'middleware' => 'right:'.config('access.users.frontend'),
], function () {
    // FrontendManagement
    Route::group(['namespace' => 'FrontendManagement'], function () {
        Route::any('/', [FrontendManagementController::class, 'index'])->name('index');
        Route::any('/addlanguage', [FrontendManagementController::class, 'addlanguage'])->name('addlanguage');
        Route::any('/alltext', [FrontendManagementController::class, 'alltext'])->name('alltext');
        Route::any('/addtext', [FrontendManagementController::class, 'addtext'])->name('addtext');
         Route::any('/edittext/{id}', [FrontendManagementController::class, 'edittext'])->name('edittext');
    });

});
