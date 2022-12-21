<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::name('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'role:superadmin'])
    ->group(function () {
        Route::resource('user', App\Http\Controllers\Admin\UserController::class);
        Route::resource('permission', App\Http\Controllers\Admin\PermissionController::class);
        Route::resource('role', App\Http\Controllers\Admin\RoleController::class);
    });

Route::resource('article', App\Http\Controllers\ArticleController::class);
