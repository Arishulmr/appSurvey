<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrangController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/people', [OrangController::class, 'index'])->name('people.index');
Route::get('/survey', [SurveyController::class, 'index'])->name('survey.index');
Route::get('/category', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/request', [RequestController::class, 'index'])->name('request.index');
Route::get('/', function () {
    return view('welcome');
});
Route::post('/questions/{id}/options', [QuestionController::class, 'storeOptions'])->name('options.store');
Route::get('/questions/{id}/options/create', [QuestionController::class, 'createOptions'])->name('options.create');
Route::get('/people/create', [OrangController::class, 'create'])->name('people.create');
Route::post('/people', [OrangController::class, 'store'])->name('people.store');
Route::get('/people/{id}/edit', [OrangController::class, 'edit'])->name('people.edit');
Route::put('/people/{id}', [OrangController::class, 'update'])->name('people.update');
Route::delete('/people/{id}', [OrangController::class, 'destroy'])->name('people.destroy');
Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
Route::post('/questionnaires/{id}/generate-link', [QuestionnaireController::class, 'generateLink'])->name('questionnaires.generateLink');
Route::put('/options/{id}', [OptionController::class, 'update'])->name('options.update');
Route::delete('/options/{id}', [OptionController::class, 'destroy'])->name('options.destroy');
Route::post('/options/{question_id}', [OptionController::class, 'store'])->name('options.store');
Route::get('/options/{id}/edit', [OptionController::class, 'edit'])->name('options.edit');
Route::get('/questionnaires', [QuestionnaireController::class, 'index'])->name('questionnaires.index');
Route::get('/questionnaires/{id}', [QuestionnaireController::class, 'show'])->name('questionnaires.show');
Route::get('/questionnaires/{id}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
Route::get('/questionnaires/{id}/preview', [QuestionnaireController::class, 'preview'])->name('questionnaires.preview');
Route::post('/questionnaires/{questionnaire}/questions', [QuestionController::class, 'store'])->name('questions.store');
Route::get('/questionnaire/{id}/edit', [QuestionnaireController::class, 'edit'])->name('questionnaire.edit');
Route::put('/questionnaire/{id}', [QuestionnaireController::class, 'update'])->name('questionnaire.update');
Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
Route::get('/questionnaire/create', [QuestionnaireController::class, 'create'])->name('questionnaires.create');
Route::post('/questionnaires', [QuestionnaireController::class, 'store'])->name('questionnaires.store');
Route::get('/questionnaires/{id}/add-question', [QuestionController::class, 'create'])->name('questionnaires.add-question');
Route::post('/questionnaires/{id}/add-question', [QuestionController::class, 'store'])->name('questionnaires.store-question');
Route::resource('categories', CategoryController::class);
Route::post('/login', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::post('/logout', [UserController::class, 'logout']);