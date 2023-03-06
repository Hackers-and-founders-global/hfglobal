<?php

use App\Http\Controllers\API\OccupationController;
use App\Http\Controllers\API\SocialMediaController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
use GuzzleHttp\Middleware;
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

/**
 * API route for register new user
 */
Route::post('/register', [AuthController::class, 'register']);

/**
 * API route for login user
 */
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::apiResource('occupations', OccupationController::class);
    Route::apiResource('social_media', SocialMediaController::class);
    Route::apiResource('countries', CountryController::class);
    Route::apiResource('users', UserController::class);


    /**
     * API route for logout user
     */
    Route::post('/logout', [AuthController::class, 'logout']);
});
