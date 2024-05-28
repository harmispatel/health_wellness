<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\UserController;

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

// UserController
//login
Route::post('login',[UserController::class,'login'])->name('login');
Route::get('getUsers',[UserController::class,'getUsers']);
Route::get('getAdvertisementPicture',[UserController::class,'getAdvertisementPicture']);
Route::post('register',[UserController::class,'register']);
Route::get('userList',[UserController::class,'userList'])->middleware('auth:sanctum');
Route::get('checkIsAnswered',[UserController::class,'checkIsAnswered'])->middleware('auth:sanctum');

// questionController
Route::get('questionList',[QuestionController::class,'getQuestionList']);
Route::post('QuestionAndOptionStore',[QuestionController::class,'QuestionAndOptionStore'])->middleware('auth:sanctum');
Route::get('UserWorkoutPlan',[QuestionController::class,'UserWorkoutPlan'])->middleware('auth:sanctum');
