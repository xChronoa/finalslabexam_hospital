<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

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

Route::prefix("/appointments")->group(function () {
    Route::get("/view", [AppointmentController::class, 'view']);
    Route::get("/view/patient/{id}", [AppointmentController::class, 'patientView']);
    Route::post("/book", [AppointmentController::class, 'book']);
    Route::put("/reschedule/{id}", [AppointmentController::class, 'reschedule']);
    Route::delete("/cancel/{id}", [AppointmentController::class, 'cancel']);
});