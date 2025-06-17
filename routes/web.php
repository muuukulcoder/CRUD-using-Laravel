<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/list',[StudentController::class,'view']);

Route::get('add', [StudentController::class, 'create']);

Route::post('add',[StudentController::class,'store']);



//Route for delete using delete function in controller
Route::get('delete/{id}',[StudentController::class, 'destory']);


//Route for edit using update function in Controller
Route::get('edit/{id}',[StudentController::class, 'update']);