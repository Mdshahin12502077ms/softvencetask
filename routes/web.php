<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\coursecontroller;
// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(coursecontroller::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/coursecontroller/create', 'create');
    Route::post('/course/store', 'store')->name('course.store');
   
});