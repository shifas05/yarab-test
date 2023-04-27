<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
   Route::post('register', [\App\Http\Controllers\User\Registration\UserRegistrationController::class, 'register']);
   Route::group(['prefix' => 'profile', 'middleware' => 'auth:api'], function () {
      Route::post('update', [\App\Http\Controllers\User\Profile\UserProfileController::class, 'update']);
   });
});
