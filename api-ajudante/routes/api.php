<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ListProdController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductForListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function () {
    Route::middleware('auth:sanctum')->get('user', function (Request $request) {
        return response()->json([
            'user' => $request->user()
        ]);
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::post('register', 'store');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::post('login', 'index');
    });

    Route::controller(LogoutController::class)->group(function () {
        Route::post('logout', 'index');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(ProductForListController::class)->prefix("notify")->group(function () {
        Route::get("get-all/{user_id}", "index");
        Route::post("register-product", "store");
        Route::delete("delete/{id}", "destroy");
        Route::get("show/{id}", "show");
        Route::put("update/{id}", "update");
    });

    Route::controller(ListProdController::class)->prefix('list-prod')->group(function() {
        Route::delete("delete/{id}", "destroy");
        Route::get("enviar/{id}", "enviar");
        Route::get("get-all", "index");
        Route::get("get-by-id/{id}", "show");
        Route::put('update/{id}', 'update');
    });

    Route::controller(ProductController::class)->prefix('product')->group(function() {
        Route::get("get-by-name/{name}", "showByName");
    });
});
