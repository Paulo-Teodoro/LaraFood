<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\PermissionProfileController;
use App\Http\Controllers\Admin\ACL\PlanProfileController;
use App\Http\Controllers\Admin\ACL\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\DetailPlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Site\SiteController;
use App\Models\User;

/**
 * Admin Routes
 */
Route::prefix('admin')
->middleware('auth')
->group(function () {

    Route::get('test-acl', function() {
        dd(auth()->user()->isAdmin());
    });

    /**
     * Routes Tables
     */
    Route::resource('/tables', TableController::class);
    Route::any('/tables/search', [TableController::class, 'search'])->name('tables.search');

    /**
     * Routes Products
     */
    Route::resource('/products', ProductController::class);
    Route::any('/products/search', [ProductController::class, 'search'])->name('products.search');

    /**
     * Routes Categories
     */
    Route::resource('/categories', CategoryController::class);
    Route::any('/categories/search', [CategoryController::class, 'search'])->name('categories.search');

    /**
     * Categories x Products
     */
    Route::any('products/{id}/categories/create', [CategoryProductController::class, 'categoriesAvailable'])->name('products.categories.available');
    Route::get('products/{id}/categories/{idCategory}', [CategoryProductController::class, 'detachCategoriesProduct'])->name('products.categories.detach');
    Route::post('products/{id}/categories', [CategoryProductController::class, 'attachCategoriesProduct'])->name('products.categories.attach');
    Route::get('products/{id}/categories', [CategoryProductController::class, 'categories'])->name('products.categories');
    Route::get('categories/{id}/products', [CategoryProductController::class, 'products'])->name('categories.products');

    /**
     * Routes Users
     */
    Route::resource('/users', UserController::class);
    Route::any('/users/search', [UserController::class, 'search'])->name('users.search');

    /**
     * Plans x Profile
     */
    Route::any('plans/{id}/profiles/create', [PlanProfileController::class, 'profilesAvailable'])->name('plans.profiles.available');
    Route::get('plans/{id}/profiles/{idPlan}', [PlanProfileController::class, 'detachProfilesPlan'])->name('plans.profiles.detach');
    Route::post('plans/{id}/profiles', [PlanProfileController::class, 'attachProfilesPlan'])->name('plans.profiles.attach');
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


/**
 * Routes Site
 */
Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/plan/{url}', [SiteController::class, 'plan'])->name('plan.subscription');

Auth::routes();


