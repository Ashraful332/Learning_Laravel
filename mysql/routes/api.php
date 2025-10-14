<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\peopleController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/people', [peopleController::class, 'getUsers']);

// নতুন ইউজার যোগ করা
Route::post('/add-people', [peopleController::class, 'addUser']);
