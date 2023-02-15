<?php

use App\Http\Controllers\Api\HomePageController;
use App\Http\Controllers\Api\MovieController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('apiPassword')->group(function () {
    Route::get('home', [HomePageController::class, 'index']);

    Route::prefix('movies')->group(function () {
        Route::get('', [MovieController::class, 'index']); //params['pages','s','orderBy']
        Route::post('info/{id}', [MovieController::class, 'show']); //id
        Route::get('random/{type}/{count}',[MovieController::class,'random']); //count,type
        Route::post('get_link',[MovieController::class,'get_link']); //id,name,trailer

        //Category Route
        Route::get('category',[MovieController::class,'category']);
        Route::post('category/search',[MovieController::class,'get_movies_by_type']);
    });
});
