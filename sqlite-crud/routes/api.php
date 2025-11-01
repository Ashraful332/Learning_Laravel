<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Http;


Route::get('/users', [UserController::class, 'index']); // সব ইউজার দেখাবে
Route::post('/users', [UserController::class, 'store']); // নতুন ইউজার যোগ করবে
Route::get('/users/{id}', [UserController::class, 'show']); // নির্দিষ্ট ইউজার দেখাবে
Route::put('/users/{id}', [UserController::class, 'update']); // ইউজার আপডেট করবে
Route::delete('/users/{id}', [UserController::class, 'destroy']); // ইউজার ডিলিট করবে


// test
Route::get('/hi',function(){
    return "Hi frind ";
});
