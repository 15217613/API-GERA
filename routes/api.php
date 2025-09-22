<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::apiResource('permissions', PermissionController::class)->middleware('auth:api');
Route::apiResource('roles', RoleController::class)->middleware('auth:api');
