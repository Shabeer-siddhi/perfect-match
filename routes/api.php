<?php

use App\Http\Controllers\Api\V1\ActionsController;
use App\Http\Controllers\Api\V1\AttributesController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CommonController;
use App\Http\Controllers\Api\V1\ListingController;
use App\Http\Controllers\Api\V1\MessagesController;
use App\Http\Controllers\Api\V1\MyProfileController;
use App\Http\Controllers\Api\V1\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v2'], function () {

    // Auth routes
    Route::get('/check_user_exists', [AuthController::class, 'checkUserExists']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/verify_otp', [AuthController::class, 'verifyOTP']);
    Route::post('/resend_otp', [AuthController::class, 'resendOTP']);

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/register_details', [AuthController::class, 'registerDetails']);

    Route::get('/attributes', [AttributesController::class, 'getAllAttributes']);
    Route::get('/attributes/{string}', [AttributesController::class, 'getAttributes']);

    // State, CIty, District
    Route::get('/location/state', [CommonController::class, 'state']);
    Route::get('/location/district', [CommonController::class, 'district']);
    Route::get('/location/city', [CommonController::class, 'city']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/logout', [AuthController::class, 'logout']);

        // My profile 
        Route::get('/my_profile', [MyProfileController::class, 'my_profile']);
        Route::post('/my_profile/update/', [MyProfileController::class, 'update']);
        Route::post('/my_profile/verify_profile/', [MyProfileController::class, 'verify_profile']);
        Route::post('/my_profile/delete_image/', [MyProfileController::class, 'delete_image']);

        // Profile Actions
        Route::post('/like', [ActionsController::class, 'like']);
        Route::post('/favourite', [ActionsController::class, 'favorite']);
        Route::post('/remove_favourite', [ActionsController::class, 'remove_favorite']);
        Route::post('/dislike', [ActionsController::class, 'dislike']);
        Route::post('/ban', [ActionsController::class, 'ban']);

        // Messages
        Route::post('/send_message', [MessagesController::class, 'send_message']);
        Route::get('/all_message', [MessagesController::class, 'all_message']);
        Route::get('/get_message', [MessagesController::class, 'get_message']);

        // Listing
        Route::get('/listing', [ListingController::class, 'listing']);
        Route::get('/profile', [ListingController::class, 'profile']);

        // Packages
        Route::get('/packages', [SubscriptionController::class, 'packages']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
