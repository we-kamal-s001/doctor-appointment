<?php
use VaahCms\Modules\appoinments\Http\Controllers\Backend\DoctorPatientAppoinmentsController;
/*
 * API url will be: <base-url>/public/api/appoinments/appoinments
 */
Route::group(
    [
        'prefix' => 'appoinments/appoinments',
        'namespace' => 'Backend',
    ],
function () {

    /**
     * Get Assets
     */
    Route::get('/assets', [DoctorPatientAppoinmentsController::class, 'getAssets'])
        ->name('vh.backend.appoinments.api.appoinments.assets');
    /**
     * Get List
     */
    Route::get('/', [DoctorPatientAppoinmentsController::class, 'getList'])
        ->name('vh.backend.appoinments.api.appoinments.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [DoctorPatientAppoinmentsController::class, 'updateList'])
        ->name('vh.backend.appoinments.api.appoinments.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [DoctorPatientAppoinmentsController::class, 'deleteList'])
        ->name('vh.backend.appoinments.api.appoinments.list.delete');


    /**
     * Create Item
     */
    Route::post('/', [DoctorPatientAppoinmentsController::class, 'createItem'])
        ->name('vh.backend.appoinments.api.appoinments.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [DoctorPatientAppoinmentsController::class, 'getItem'])
        ->name('vh.backend.appoinments.api.appoinments.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [DoctorPatientAppoinmentsController::class, 'updateItem'])
        ->name('vh.backend.appoinments.api.appoinments.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [DoctorPatientAppoinmentsController::class, 'deleteItem'])
        ->name('vh.backend.appoinments.api.appoinments.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [DoctorPatientAppoinmentsController::class, 'listAction'])
        ->name('vh.backend.appoinments.api.appoinments.list.action');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [DoctorPatientAppoinmentsController::class, 'itemAction'])
        ->name('vh.backend.appoinments.api.appoinments.item.action');



});
