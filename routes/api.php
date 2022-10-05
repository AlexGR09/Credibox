<?php

use App\Http\Controllers\API\V1\CompanyController;
use App\Http\Controllers\API\V1\EmployeeController;
use App\Http\Controllers\AuthController;
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

//Route::post('register', [AuthController::class, 'register']);
//Route::post('login', [AuthController::class, 'login']);

Route::group([], function(){

    //Route::get('logout', [AuthController::class, 'logout']);

    Route::resource('companies', CompanyController::class)->only(
        'index',
        'store',
        'show',
        'update',
        'destroy'
    );

    Route::resource('employees', EmployeeController::class)->only('index',
        'store',
        'show',
        'update',
        'destroy'
    );

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
