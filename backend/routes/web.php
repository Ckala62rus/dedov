<?php

use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\LessonCategoryController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Route::get('/', function () {
////    return Inertia::render('Auth/Login');
//    return Redirect::route('login');
//})->name('/');

//Route::get('/www', function () {
//    return Inertia::render('Dashboard');
//})->name('www');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function () {
        return Inertia::render('admin/dashboard');
    })->name('www');

    Route::get('admin/profile', [ProfileController::class, 'profilePage'])->name('metronic.profile');

    Route::group(['prefix' => 'admin'], function () {

        // User
        Route::get('user', [UserController::class, 'index'])->name('metronic.user.index')->middleware(['permission:read user']);
        Route::get('user/paginate', [UserController::class, 'getAllUsersWithPaginate']);
        Route::post('user', [UserController::class, 'store'])->middleware(['permission:create user']);
        Route::get('user/create', [UserController::class, 'create'])->name('metronic.user.create')->middleware(['permission:create user']);
        Route::get('user/{id}', [UserController::class, 'show'])->middleware(['permission:read user']);
        Route::put('user/{id}', [UserController::class, 'update'])->name('metronic.user.update')->middleware(['permission:update user']);
        Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('metronic.user.edit')->middleware(['permission:update user']);
        Route::delete('user/{id}', [UserController::class, 'destroy'])->middleware(['permission:delete user']);

        // Role
        Route::get('role', [RolePermissionController::class, 'index'])->name('metronic.role.index');
        Route::get('role/paginate', [RolePermissionController::class, 'getAllUsersWithPaginate']);
        Route::get('role/create', [RolePermissionController::class, 'create'])->name('metronic.role.create');
        Route::post('role', [RolePermissionController::class, 'store']);
        Route::get('role/all', [RolePermissionController::class, 'getRolesCollection']);
        Route::get('role/{id}', [RolePermissionController::class, 'show']);
        Route::put('role/{id}', [RolePermissionController::class, 'update']);
        Route::get('role/{id}/edit', [RolePermissionController::class, 'edit'])->name('metronic.role.edit');
        Route::delete('role/{id}', [RolePermissionController::class, 'destroy']);

        // Organization
        Route::resource('organizations', OrganizationController::class);
        Route::get('organization-all-paginate', [OrganizationController::class, 'getAllOrganizationsWithPagination']);

        // Equipment
        Route::resource('equipments', EquipmentController::class);
        Route::get('equipments-all-paginate', [EquipmentController::class, 'getAllEquipmentsWithPagination']);

    });

    // Permission
    Route::get('admin/permission', [RolePermissionController::class, 'getPermissions']);

    //Avatar
    Route::post('avatar/set', [UserController::class, 'setAvatar']);
    Route::get('avatar/get', [UserController::class, 'getAvatar']);
});

require __DIR__.'/auth.php';

/**
 * Devices
 * ACP
 */
