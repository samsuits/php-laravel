<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyViewController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\HelloSatishController;
use App\Http\Controllers\AssignmentStatusController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', [HelloWorldController::class, 'index']);
Route::get('/greet/{name}', [HelloWorldController::class, 'greet']);
Route::get('/sum/{num1}/{num2}', [HelloWorldController::class, 'sum']);

// exercise - 1
// Create calculator controller
// 4 methods
// add, subtract, multiply, divide
// create routes for each method
// return results

Route::get('/satish', [HelloSatishController::class, 'index']);

Route::get('/myview', function () {
    return view('myview');
});

// do it using controller
Route::get('/myview2', [MyViewController::class, 'myview2']);



//----------------------------------------------
// exercise - 2
// create a new controller usercontroller
// two routes
// login and register
// login should show login page
// register should show register page

Route::resource('students', StudentController::class);
Route::resource('assignments', AssignmentController::class);
Route::resource('assignment-statuses', AssignmentStatusController::class);

Route::get('assignments/{assignment}/student-statuses', [AssignmentController::class, 'studentStatuses'])->name('assignments.student-statuses');

Route::get('students/{student}/assignments', [StudentController::class, 'showAssignments'])->name('students.assignments.show');
