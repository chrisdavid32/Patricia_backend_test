<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SignupController;
use App\Http\Controllers\Api\userController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['namespace' => 'Api'], function () {

    /**
     * USER ROUTES
     */
    Route::group(['prefix' => 'user'], function () {

        //Register a User
        Route::post('sign-up', [SignupController::class, 'create']);

        //User Login
        Route::post('login', [AuthController::class, 'login']);

        Route::group(['middleware' => 'auth:api'], function () {

            //Fetch User details by ID
            Route::get('show/{id}', [userController::class, 'show']);

            //Delete User
            Route::delete('delete/{id}', [userController::class, 'delete']);

            //Update User
            Route::put('update/{id}', [userController::class, 'update']);
        });
    });



    //---------
});
