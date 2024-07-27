<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionsController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// For API routes
Route::get('/currentQuestion/{quizId}', [QuestionsController::class, 'apiGetCurrentQuestion']);                             //Returns the id of selected question on a quiz
Route::get('/currentQuestion/toggleRequest/{questionId}', [QuestionsController::class, 'apiQuestionToggleRequest']);        //Toggles accepting answers true/false
Route::get('/currentQuestion/view/{questionId}', [QuestionsController::class, 'apiQuestionView']);                          //Returns the id of selected question on a quiz