<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\PlansController;
use App\Http\Controllers\Api\V1\VisitsController;

Route::post('auth/login', [AuthController::class, 'login']);


Route::prefix('auth')->middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('auth/forgot-password', [AuthController::class, 'forgot_password'])->middleware('guest');
Route::get('/reset-password/{token}', [AuthController::class, 'reset_password_token'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset_password'])->middleware('guest')->name('password.update');


Route::middleware(['auth:sanctum'])->group(function () {
   
    Route::post('user/data/update', [UserController::class, 'data_update']);
    Route::post('user/password/update', [UserController::class, 'password_update']);


    Route::get('statistics', [HomeController::class, 'statistics']);

    Route::get('plans/years', [PlansController::class, 'years']);
    Route::post('plans/year/plans', [PlansController::class, 'year_plans']);
    Route::post('plans/plan/visits', [PlansController::class, 'plan_visits']);
    Route::post('plans/plan/details', [PlansController::class, 'plan_details']);
    Route::post('plans/plan/visit/details', [PlansController::class, 'plan_visit_details']);
    Route::post('plans/plan/user-visits', [PlansController::class, 'user_visits']);
    Route::post('plans/plan/user-visit/details', [PlansController::class, 'user_visit']);
    Route::post('plans/plan/visit/user-visits', [PlansController::class, 'plan_visit_user_visits']);


    Route::get('visits/cancel-reasons', [VisitsController::class, 'cancel_reasons']);
    Route::post('visits/store', [VisitsController::class, 'store']);

    Route::post('current-month/plan/visits', [PlansController::class, 'current_month_plan_visits']);
    Route::post('current-month/plan/user-visit', [PlansController::class, 'current_month_plan_user_visits']);

});