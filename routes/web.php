<?php

use App\Http\Controllers\Admin\DetailPlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PlanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::prefix('admin')->group(function () {
    /**
     * Routes Details Plan
     */
    Route::resource('/plans/{id}/details', DetailPlanController::class)->names([
        'index' => 'details.plan.index',
        'create' => 'details.plan.create',
        'store' => 'details.plan.store',
        'edit'  => 'details.plan.edit',
        'update' => 'details.plan.update',
        'show' => 'details.plan.show',
        'destroy' => 'details.plan.destroy'
    ]);
    /**
     * Routes Plans
     */
    Route::resource('/plans', PlanController::class)->names([
        'index' => 'plans.index',
        'create' => 'plans.create',
        'store' => 'plans.store',
        'show' => 'plans.show',
        'destroy' => 'plans.destroy',
        'edit'  => 'plans.edit',
        'update' => 'plans.update'
        ]);
    Route::any('/plans/search', [PlanController::class, 'search'])->name('plans.search');

    /**
     * Routes Home
     */
    Route::get('/', [PlanController::class, 'index'])->name('admin.index');
});



Route::get('/', function () {
    return view('welcome');
});
