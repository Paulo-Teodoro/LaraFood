<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\PlanProfileController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\DetailPlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PlanController;

/**
 * Admin Routes
 */
Route::prefix('admin')
->middleware('auth')
->group(function () {
    /**
     * Plans x Profile
     */
    Route::any('plans/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
    Route::get('plans/{id}/profiles/{idPlan}', [PlanProfileController::class, 'detachProfilesPlan'])->name('plans.profiles.detach');
    Route::post('plans/{id}/profiles', [PlanProfileController::class, 'attachProfilesProfile'])->name('plans.profiles.attach');
    Route::get('plans/{id}/profiles', [PlanProfileController::class, 'profiles'])->name('plans.profiles'); 
    Route::get('profiles/{id}/plans', [PlanProfileController::class, 'plans'])->name('profiles.plans');

    /**
     * Permissions x Profile
     */
    Route::any('profiles/{id}/permissions/create', [PermissionProfileController::class, 'permissionsAvailable'])->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions/{idPermission}', [PermissionProfileController::class, 'detachPermissionsProfile'])->name('profiles.permissions.detach');
    Route::post('profiles/{id}/permissions', [PermissionProfileController::class, 'attachPermissionsProfile'])->name('profiles.permissions.attach');
    Route::get('profiles/{id}/permissions', [PermissionProfileController::class, 'permissions'])->name('profiles.permissions');
    Route::get('permissions/{id}/profiles', [PermissionProfileController::class, 'profiles'])->name('permissions.profiles');
    
    /**
     * Routes Permissions
     */
    Route::resource('/permissions', PermissionController::class);
    Route::any('/permissions/search', [PermissionController::class, 'search'])->name('permissions.search');

    /**
     * Routes Profile
     */
    Route::resource('/profiles', ProfileController::class);
    Route::any('/profiles/search', [ProfileController::class, 'search'])->name('profiles.search');

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

Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
