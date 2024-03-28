<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function (){
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::group(["prefix" => "user", "as" => "user."], function () {
        Route::get("", [AdminUserController::class, "index"])->name("index");
        Route::post("all", [AdminUserController::class, "allUsers"])->name("allUsers");
        Route::get("create", [AdminUserController::class, "create"])->name("create");
        Route::post("store", [AdminUserController::class, "store"])->name("store");
        Route::get("edit/{id}", [AdminUserController::class, "edit"])->name("edit");
        Route::match(["put", "patch"], "update/{id}", [AdminUserController::class, "update"])->name("update");
        Route::delete("delete/{id}", [AdminUserController::class, "delete"])->name("delete");
    });
});
