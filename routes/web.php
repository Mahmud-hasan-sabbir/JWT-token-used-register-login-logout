<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

// Page Route
Route::view('/Registration','pages.auth.registration-page');
Route::view('/Login','pages.auth.login-page');
Route::view('/Profile','pages.dashboard.profile-page')->middleware([TokenVerificationMiddleware::class]);



// Back-End Route
Route::post("/userRegistration",[UserController::class,'userRegistration']);

Route::post("/userLogin",[UserController::class,'userLogin']);
Route::get("/userProfile",[UserController::class,'userProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::get("/userLogout",[UserController::class,'userLogout'])->middleware([TokenVerificationMiddleware::class]);





