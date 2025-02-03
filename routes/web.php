<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\GameController;
use App\Events\AcceptingAnswersToggledByAdmin;
use App\Events\QuestionChangedByAdmin;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Login, Homepage, Logout
Route::get('/', [UserController::class,'viewIndex']) ->name('index');
Route::get('/login', [UserController::class,'viewIndex']) ->name('login');
Route::get('/logout', [UserController::class,'logout'])->name('logout');
Route::get('/homepage', [UserController::class,'viewHomepage'])
    ->middleware('check.user.session')
    ->name('homepage');
Route::post('/login', [UserController::class,'login'])->name('user.login');

//These are the routes of homepage
Route::post('/quiz/create', [QuizController::class,'createQuiz']) 
    ->middleware('check.user.session')
    ->name('quiz.create');
Route::post('/quiz/join', [QuizController::class,'joinQuiz']) 
    ->middleware('check.user.session')
    ->name('quiz.join');
Route::post('/members', [UserController::class,'updateTeam']) 
    ->middleware('check.user.session')
    ->name('team.update');
Route::get('/quiz/{quizId}', [QuizController::class,'viewQuiz']) //change this later 
    ->middleware('check.user.session')
    ->name('quiz.view');

//
Route::get('/quiz/{quizId}/return', [QuizController::class,'returnFromAnswers']) //change this later 
    ->middleware('check.user.session')
    ->name('quiz.returnFromAnswers');

//User is redirected here if they are a player
Route::get('/quiz/{quizId}/play', [GameController::class,'playQuiz']) //change this later 
    ->middleware('check.user.session')
    ->name('quiz.play');
Route::get('/quiz/{quizId}/player',[GameController::class, 'playerPlay'])
    ->middleware('check.user.session')->name('player.play');
Route::post('/quiz/answer/submit',[GameController::class, 'submitAnswer'])
    ->middleware('check.user.session')
    ->name('player.answer.submit');

//Routes of quiz Dashboard
Route::get('/quiz/{quizId}/play/admin', [GameController::class,'playQuizAsAdmin']) 
    ->middleware('check.user.session')
    ->middleware('checkprivilege')
    ->name('quiz.playQuizAsAdmin');         
Route::delete('/quiz/{quizId}/delete', [QuizController::class,'deleteQuiz']) 
    ->middleware('checkprivilege')
    ->middleware('check.user.session')
    ->name('quiz.delete');                   
Route::get('/quiz/{quizId}/category/', [QuestionsController::class, 'viewCategoriesList']) 
    ->middleware('check.user.session')
    ->middleware('checkprivilege')
    ->name('categories.view');  
Route::get('/quiz/{quizId}/leaderboard/', [QuizController::class, 'viewLeaderboard']) 
    ->middleware('check.user.session')
    ->name('leaderboards.view');       
Route::get('/quiz/{quizId}/review/', [QuizController::class, 'viewRecentQuestions']) 
    ->middleware('check.user.session')
    ->name('questions.review');     
Route::get('/quiz/{quizId}/teams', [QuizController::class,'viewTeams'])  
    ->middleware('check.user.session')
    ->name('teams.view');                           

//CRUD for Questions and categories
Route::post('/quiz/{quizId}/category/', [QuestionsController::class, 'createCategory']) 
    ->middleware('check.user.session')
    ->middleware('checkprivilege')
    ->name('category.create');
Route::delete('/quiz/{quizId}/category/{categoryId}', [QuestionsController::class, 'deleteCategory']) 
    ->middleware('check.user.session')
    ->middleware('checkprivilege')
    ->name('category.delete');
Route::get('/quiz/{quizId}/category/{categoryId}/questions', [QuestionsController::class, 'viewQuestions']) 
    ->middleware('check.user.session')
    ->middleware('checkprivilege')
    ->name('questions.view');  
Route::post('/quiz/{quizId}/category/{categoryId}/questions', [QuestionsController::class, 'createQuestions']) 
    ->middleware('check.user.session')
    ->middleware('checkprivilege')
    ->name('questions.create');  
Route::delete('/quiz/{quizId}/category/{categoryId}/question/{questionId}',[QuestionsController::class, 'deleteQuestion']) 
    ->middleware('check.user.session')
    ->middleware('checkprivilege')
    ->name('question.delete');

//Review last finished question
Route::get('/quiz/{quizId}/review/{questionId}', [QuizController::class, 'viewPlayerAnswers']) 
    ->middleware('check.user.session')
    ->name('answers.review');    
Route::POST('/quiz/review/',[QuizController::class, 'toggleEvaluaton']) 
    ->middleware('check.user.session')
    ->name('answers.review.toggle'); 

//Teams
Route::get('/quiz/{quizId}/team/remove/{id}', [QuizController::class, 'removeTeam']) 
    ->middleware('check.user.session')
    ->name('team.remove');
Route::get('/quiz/{quizId}/team/approve/{id}', [QuizController::class, 'approveTeam']) 
    ->middleware('check.user.session')
    ->name('team.approve');

Route::post('/quiz/{quizId}/admin',[GameController::class, 'getQuestion'])->name('quiz.play.question.get');
Route::get('/quiz/{quizId}/admin/deselect',[GameController::class, 'deselectQuestion'])->name('quiz.play.question.clear');

// Route::get('/test', function(){
//     event(new AcceptingAnswersToggledByAdmin([],1));
//     return "Event fired";
// });