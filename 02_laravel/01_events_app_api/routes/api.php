<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\AttendeeController;
use App\Http\Controllers\Api\V1\EventController;
use Illuminate\Support\Facades\Route;



// -------------- API Routes -------------- //
Route::apiResource('events', EventController::class); 
Route::apiResource('events.attendees', AttendeeController::class)->scoped(); 


// --------------  Authentication Routes -------------- //
Route::prefix('auth')->group(function () {
    Route::post('/register',  [AuthController::class, 'register']); 
    Route::post('/login', [AuthController::class, 'login']);  
});

Route::middleware('auth:sanctum')->prefix('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});


