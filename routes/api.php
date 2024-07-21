<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AushadhiGroupController;


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

    

Route::post('/register-user', [UsersController::class, 'registerUser']);
Route::post('/verifyLogin-user', [UsersController::class, 'verifyLoginUser']);
Route::post('/forgot-password', [UsersController::class, 'forgotPassword']);
Route::post('/verify-otp', [UsersController::class, 'verifyOtp']);
Route::post('/create-new-password/{id}', [UsersController::class, 'createNewPassword']);


// Route::middleware('auth:api')->group(function () {

    Route::prefix('profile')->group(function () {
    Route::get('/get-profile-details/{id}', [UsersController::class, 'profileDetails']);
    Route::post('/update-user-profile/{id}', [UsersController::class, 'updateProfile']);
    });

    Route::prefix('AushadhiGroup')->group(function () {
        Route::post('/addAdushadhi', [AushadhiGroupController::class, 'addUpdateAdushadhi']);
        Route::post('/updateAdushadhi/{id}', [AushadhiGroupController::class, 'addUpdateAdushadhi']);
        Route::get('/get-all/{id}', [AushadhiGroupController::class, 'getAll']);
        Route::get('/deleteAushadhi/{id}', [AushadhiGroupController::class, 'deleteAushadhi']);
        Route::get('/get-by-Aushadhi/{id}', [AushadhiGroupController::class, 'getByAushadhi']);
        Route::get('/isActiveChange/{id}/{is_active}', [AushadhiGroupController::class, 'isActiveChange']);

    });
// });