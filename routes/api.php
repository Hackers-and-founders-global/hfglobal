<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ChapterController;
use App\Http\Controllers\API\CityController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\OccupationController;
use App\Http\Controllers\API\SocialMediaController;
use App\Http\Controllers\API\SocialMediaUserController;
use App\Http\Controllers\API\StateController;
use App\Http\Controllers\API\UserController;
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
    Route::apiResources([
        'occupations' => OccupationController::class,
        'social_media' => SocialMediaController::class,
        'countries' => CountryController::class,
        'chapters' => ChapterController::class,
        'users' => UserController::class,
    ]);

    Route::apiResource('countries.states', StateController::class)->shallow();
    Route::apiResource('countries.cities', CityController::class)->shallow();
    Route::apiResource('users.social_medias', SocialMediaUserController::class)->shallow();

    /**
     * API route for logout user
     */
    Route::post('/logout', [AuthController::class, 'logout']);
});
