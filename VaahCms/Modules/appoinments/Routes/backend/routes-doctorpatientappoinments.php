<?php

use VaahCms\Modules\appoinments\Http\Controllers\Backend\DoctorPatientAppoinmentsController;

Route::group(
    [
        'prefix' => 'backend/appoinments/appoinments',

        'middleware' => ['web', 'has.backend.access'],

],
function () {
    /**
     * Get Assets
     */
    Route::get('/assets', [DoctorPatientAppoinmentsController::class, 'getAssets'])
        ->name('vh.backend.appoinments.appoinments.assets');
    /**
     * Get List
     */
    Route::get('/', [DoctorPatientAppoinmentsController::class, 'getList'])
        ->name('vh.backend.appoinments.appoinments.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', [DoctorPatientAppoinmentsController::class, 'updateList'])
        ->name('vh.backend.appoinments.appoinments.list.update');
    /**
     * Delete List
     */
    Route::delete('/', [DoctorPatientAppoinmentsController::class, 'deleteList'])
        ->name('vh.backend.appoinments.appoinments.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', [DoctorPatientAppoinmentsController::class, 'fillItem'])
        ->name('vh.backend.appoinments.appoinments.fill');

    /**
     * Create Item
     */
    Route::post('/', [DoctorPatientAppoinmentsController::class, 'createItem'])
        ->name('vh.backend.appoinments.appoinments.create');
    /**
     * Get Item
     */
    Route::get('/{id}', [DoctorPatientAppoinmentsController::class, 'getItem'])
        ->name('vh.backend.appoinments.appoinments.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', [DoctorPatientAppoinmentsController::class, 'updateItem'])
        ->name('vh.backend.appoinments.appoinments.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', [DoctorPatientAppoinmentsController::class, 'deleteItem'])
        ->name('vh.backend.appoinments.appoinments.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', [DoctorPatientAppoinmentsController::class, 'listAction'])
        ->name('vh.backend.appoinments.appoinments.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', [DoctorPatientAppoinmentsController::class, 'itemAction'])
        ->name('vh.backend.appoinments.appoinments.item.action');

    //---------------------------------------------------------

});
