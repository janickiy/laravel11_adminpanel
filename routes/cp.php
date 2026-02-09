<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AuthController,
    CategoryController,
    DashboardController,
    DataTableController,
    UsersController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard.index');

Route::middleware(['permission:admin|moderator'])->group(function () {
    Route::group(['prefix' => 'category'], function () {
        Route::get('', [CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('create', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit')->where('id', '[0-9]+');
        Route::put('update', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::post('destroy', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
    });
});
Route::group(['prefix' => 'users'], function () {
    Route::get('', [UsersController::class, 'index'])->name('admin.users.index');
    Route::get('create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('store', [UsersController::class, 'store'])->name('admin.users.store');
    Route::get('edit/{id}', [UsersController::class, 'edit'])->name('admin.users.edit')->where('id', '[0-9]+');
    Route::put('update', [UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('destroy', [UsersController::class, 'destroy'])->name('admin.users.destroy')->where('id', '[0-9]+');
});

Route::group(['prefix' => 'datatable'], function () {
    Route::any('category', [DataTableController::class, 'category'])->name('admin.datatable.category')->middleware(['permission:admin|moderator']);
    Route::any('users', [DataTableController::class, 'users'])->name('admin.datatable.users');
});
