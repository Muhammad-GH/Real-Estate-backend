<?php

use App\Http\Controllers\PMS\AuthController;
use App\Http\Controllers\PMS\HomeController;
use App\Http\Controllers\PMS\ProjectController;
use App\Http\Controllers\PMS\ProjectTemplateController;
use App\Http\Controllers\PMS\AgreementController;
use App\Http\Controllers\PMS\ProposalController;
use App\Http\Controllers\PMS\PermissionController;
use App\Http\Middleware\AuthenticatedProResource;
use App\Http\Controllers\PMS\GanttController;
use App\Http\Controllers\PMS\ProjectSummaryController;
use App\Http\Controllers\PMS\ChatController;
/*
 * PMS Routes
 * All route names are prefixed with 'pms.'.
 */
Route::group([
    'prefix' => 'pms',
    'as' => 'pms.'
], function () {
    Route::group(['namespace' => 'pms'], function () {

        Route::get('/', [AuthController::class, 'index'])->name('login2');
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::get('/sso_login', [AuthController::class, 'sso_login'])->name('sso_login');
        Route::get('/sso', [AuthController::class, 'sso_user_login'])->name('sso_user_login');
        
        Route::post('/login', [AuthController::class, 'login_submit'])->name('login_submit');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/password/reset', [AuthController::class, 'reset_password'])->name('password.reset');
        Route::post('/password/reset', [AuthController::class, 'reset_password_submit'])->name('password.reset_submit');
        Route::post('/password/reset_save', [AuthController::class, 'password_submit'])->name('password.password_submit');
        Route::get('/password/set/{token}', [AuthController::class, 'set_password'])->name('password.set');

        Route::group(['middleware' => AuthenticatedProResource::class], function () {
            Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
            Route::get('/my-account', [HomeController::class, 'my_account'])->name('my-account');
            Route::post('/my-account', [HomeController::class, 'my_account_submit'])->name('my-account');
            Route::get('/change-password', [HomeController::class, 'change_password'])->name('change-password');
            Route::post('/change-password', [HomeController::class, 'change_password_submit'])->name('change-password');

            // Permission
            Route::get('/permission', [PermissionController::class, 'index'])->name('permission');
            Route::post('/permission', [PermissionController::class, 'permission_submit'])->name('permission.submit');
            Route::post('/permission_name', [PermissionController::class, 'permission_name'])->name('permission.name');

            // Project
            Route::get('/project', [ProjectController::class, 'index'])->name('project');
            Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
            Route::post('/project/update', [ProjectController::class, 'update'])->name('project.update');
            Route::get('/project/create/aggrement', [ProjectController::class, 'create_aggrement'])->name('project.create.aggrement');
            Route::post('/project/create/aggrement', [ProjectController::class, 'create_aggrement_submit'])->name('project.create.aggrement_submit');
            Route::get('/project/create/scratch', [ProjectController::class, 'create_scratch'])->name('project.create.scratch');
            Route::post('/project/create/scratch', [ProjectController::class, 'create_scratch_submit'])->name('project.create.scratch_submit');

            Route::get('/project/get_task/{project_id}/{project_type}/{type}', [ProjectController::class, 'get_task'])->name('project.get_task');
            Route::get('/project/edit_task', [ProjectController::class, 'edit_task'])->name('project.edit_task');
            Route::get('/project/view_task', [ProjectController::class, 'view_task'])->name('project.view_task');
            Route::get('/project/add_task_time', [ProjectController::class, 'add_task_time'])->name('project.add_task_time');
            Route::post('/project/add_task_time', [ProjectController::class, 'add_task_time_submit'])->name('project.add_task_time');
            
            Route::delete('/project/delete', [ProjectController::class, 'delete'])->name('project.delete');

            

            Route::get('/project/view/{project_id}', [ProjectController::class, 'view'])->name('project.view');
            Route::get('/project/edit/{project_id}', [ProjectController::class, 'edit'])->name('project.edit');
            Route::get('/project/planning/{project_id}', [ProjectController::class, 'planning'])->name('project.planning');
            Route::get('/project/get_planning/{project_id}', [ProjectController::class, 'get_planning'])->name('project.get_planning');
            Route::post('/project/add_edit_task', [ProjectController::class, 'add_edit_task'])->name('project.add_edit_task');
            Route::post('/project/clouser', [ProjectController::class, 'clouser'])->name('project.clouser');
            Route::post('/project/add_planning_task', [ProjectController::class, 'add_planning_task'])->name('project.add_planning_task');
            Route::post('/project/new_planning_task', [ProjectController::class, 'new_planning_task'])->name('project.new_planning_task');
            Route::post('/project/update_task', [ProjectController::class, 'update_task'])->name('project.update_task');
            Route::post('/project/delete_task', [ProjectController::class, 'delete_task'])->name('project.delete_task');
            Route::post('/project/update_project_release/{project_id}', [ProjectController::class, 'update_project_release'])->name('project.update_project_release');
            
            
            Route::post('/project/save_template', [ProjectTemplateController::class, 'save_template'])->name('project.save_template');
            Route::get('/project/template_list', [ProjectTemplateController::class, 'template_list'])->name('project.template_list');
            Route::get('/project/template_load', [ProjectTemplateController::class, 'template_load'])->name('project.template_load');
            Route::post('/project/template_delete', [ProjectTemplateController::class, 'template_delete'])->name('project.template_delete');
            Route::post('/project/template_delete_task', [ProjectTemplateController::class, 'template_delete_task'])->name('project.template_delete_task');
            
            Route::get('/project/create_task/{project_id}', [ProjectController::class, 'create_task'])->name('project.create_task');
            Route::get('/project/create_task_planning/{project_id}', [ProjectController::class, 'create_task_planning'])->name('project.create_task_planning');
            
            Route::get('/project/delete/{project_id}', [ProjectController::class, 'delete'])->name('project.delete');
            Route::get('/project/gantt/{project_id}', [GanttController::class, 'index'])->name('project.gantt');
            Route::get('/get_gantt', [GanttController::class, 'get_gantt'])->name('gantt.get_gantt');
            Route::get('/update_task', [GanttController::class, 'update_task'])->name('gantt.update_task');
            Route::get('/delete_task', [GanttController::class, 'delete_task'])->name('gantt.delete_task');
            Route::get('/create_link', [GanttController::class, 'create_link'])->name('gantt.create_link');
            Route::get('/delete_link', [GanttController::class, 'delete_link'])->name('gantt.delete_link');
            Route::get('/project/summary/{project_id}', [ProjectSummaryController::class, 'index'])->name('project.summary');
            Route::get('/messages/{project_id}', [ChatController::class, 'index'])->name('chat.index');
            Route::get('/messages', [ChatController::class, 'index'])->name('chat.index');
            Route::post('/chat/save_message', [ChatController::class, 'save_message'])->name('chat.save_message');
            Route::get('/chat/get_message', [ChatController::class, 'get_message'])->name('chat.get_message');

            Route::post('/chat/get_search_message', [ChatController::class, 'get_search_message'])->name('chat.get_search_message');
            Route::get('/chat/get_active_group_message', [ChatController::class, 'get_active_group_message'])->name('chat.get_active_group_message');
        });


        
    });
});
