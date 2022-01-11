<?php

use App\Http\Controllers\ArtistController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\checkAccessMiddleware;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::get('/artist',[ArtistController::class,'index']);

Route::get('/concert',[ConcertController::class,'index']);

Route::get('/categories',[CategoryController::class,'index']);

Route::post('/register',[RegisterController::class,'store']);
Route::post('/login',[LoginController::class,'store']);

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('/artist')->group(function(){
        Route::post('/',[ArtistController::class,'store']);
        Route::patch('/{artist}',[ArtistController::class,'update']);
        Route::get('/{artist}',[ArtistController::class,'show']);
        Route::delete('/{artist}',[ArtistController::class,'destroy']);
    });
    Route::prefix('/user')->group(function(){
        Route::get('/',[UserController::class,'index']);
        Route::get('/{user}',[UserController::class,'show']);

    });
    Route::prefix('category')->group(function(){
        Route::post('/',[CategoryController::class,'store'])->middleware(checkAccessMiddleware::class.':create-category');
        Route::patch('/{category}',[CategoryController::class,'update']);
        Route::get('/{category}',[CategoryController::class,'show']);
        Route::delete('/{category}',[CategoryController::class,'destroy']);
    });
    Route::delete('/logout',[LoginController::class,'destroy']);

    Route::prefix('role')->group(function(){
        Route::get('/',[RoleController::class,'index'])->middleware(checkAccessMiddleware::class.':read-role');
        Route::post('/',[RoleController::class,'store'])->middleware(checkAccessMiddleware::class.':create-role');
        Route::patch('/{role}',[RoleController::class,'update'])->middleware(checkAccessMiddleware::class.':update-role');
        Route::get('/{role}',[RoleController::class,'show'])->middleware(checkAccessMiddleware::class.':read-role');
        Route::delete('/{role}',[RoleController::class,'destroy'])->middleware(checkAccessMiddleware::class.':delete-role');
    });
    Route::prefix('concert')->group(function(){
        Route::post('/',[ConcertController::class,'store']);
    });
});

