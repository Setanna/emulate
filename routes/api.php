<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\RaceSenseController;
use App\Http\Controllers\RaceTypeController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SenseController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\TraitController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* Get current user */
Route::get('/user', function (Request $request) {
    return $request->user('sanctum');
});

/* Create */
Route::group(['middleware' => ['auth:sanctum', 'ability:create']], function () {
    Route::post('/genre', [GenreController::class, 'store']);
    Route::post('/book', [BookController::class, 'store']);
    Route::post('/rule', [RuleController::class, 'store']);
    Route::post('/talent', [TalentController::class, 'store']);
    Route::post('/requirement', [RequirementController::class, 'store']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::post('/trait', [TraitController::class, 'store']);
    Route::post('/sense', [SenseController::class, 'store']);
    Route::post('/race', [RaceController::class, 'store']);
    Route::post('/race_sense', [RaceSenseController::class, 'store']);
    Route::post('/race_type', [RaceTypeController::class, 'store']);
    Route::post('/type', [TypeController::class, 'store']);
});

/* Update */
Route::group(['middleware' => ['auth:sanctum', 'ability:update']], function () {
    Route::put('/genre/{genre}', [GenreController::class, 'update']);
    Route::put('/book/{book}', [BookController::class, 'update']);
    Route::put('/rule/{rule}', [RuleController::class, 'update']);
    Route::put('/talent/{talent}', [TalentController::class, 'update']);
    Route::put('/requirement/{requirement}', [RequirementController::class, 'update']);
    Route::put('/category/{category}', [CategoryController::class, 'update']);
    Route::put('/trait/{trait}', [TraitController::class, 'update']);
    Route::put('/sense/{sense}', [SenseController::class, 'update']);
    Route::put('/race/{race}', [RaceController::class, 'update']);
    Route::put('/race_sense/{race_sense}', [RaceSenseController::class, 'update']);
    Route::put('/race_type/{race_type}', [RaceTypeController::class, 'update']);
    Route::put('/type/{type}', [TypeController::class, 'update']);

    /* Custom Update Functions */
    // Route::put('/talent/{talent}', [TalentController::class, 'updateTalent']);
});

/* Destroy */
Route::group(['middleware' => ['auth:sanctum', 'ability:destroy']], function () {
    Route::delete('/genre/{genre}', [GenreController::class, 'destroy']);
    Route::delete('/book/{book}', [BookController::class, 'destroy']);
    Route::delete('/rule/{rule}', [RuleController::class, 'destroy']);
    Route::delete('/talent/{talent}', [TalentController::class, 'destroy']);
    Route::delete('/requirement/{requirement}', [RequirementController::class, 'destroy']);
    Route::delete('/category/{category}', [CategoryController::class, 'destroy']);
    Route::delete('/trait/{trait}', [TraitController::class, 'destroy']);
    Route::delete('/sense/{sense}', [SenseController::class, 'destroy']);
    Route::delete('/race/{race}', [RaceController::class, 'destroy']);
    Route::delete('/race_sense/{race_sense}', [RaceSenseController::class, 'destroy']);
    Route::delete('/race_type/{race_type}', [RaceTypeController::class, 'destroy']);
    Route::delete('/type/{type}', [TypeController::class, 'destroy']);
});

/* Unprotected Routes */

/* Read - Get */
Route::get('/genre', [GenreController::class, 'index']);
Route::get('/genre/{genre}', [GenreController::class, 'show']);
Route::get('/book', [BookController::class, 'index']);
Route::get('/book/{book}', [BookController::class, 'show']);
Route::get('/requirement', [RequirementController::class, 'index']);
Route::get('/requirement/{requirement}', [RequirementController::class, 'show']);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{category}', [CategoryController::class, 'show']);
Route::get('/talent', [TalentController::class, 'index']);
Route::get('/talent/{talent}', [TalentController::class, 'show']);
Route::get('/trait', [TraitController::class, 'index']);
Route::get('/trait/{id}', [TraitController::class, 'show']);
Route::get('/rule', [RuleController::class, 'index']);
Route::get('/rule/{rule}', [RuleController::class, 'show']);
Route::get('/sense', [SenseController::class, 'index']);
Route::get('/sense/{sense}', [SenseController::class, 'show']);
Route::get('/race', [RaceController::class, 'index']);
Route::get('/race/{race}', [RaceController::class, 'show']);
Route::get('/race_sense', [RaceSenseController::class, 'index']);
Route::get('/race_sense/{race_sense}', [RaceSenseController::class, 'show']);
Route::get('/race_type', [RaceTypeController::class, 'index']);
Route::get('/race_type/{race_type}', [RaceTypeController::class, 'show']);
Route::get('/type', [TypeController::class, 'index']);
Route::get('/type/{type}', [TypeController::class, 'show']);


// Search
Route::get('/search/{search}', [SearchController::class, 'quickSearch'])->name('quickSearch');
Route::post('/search/{genre}/{search}', [SearchController::class, 'genreSearch'])->name('genreSearch');

// Custom Functions
Route::get('/{genre}/talents/{talent}', [TalentController::class, 'getTalentByGenre'])->name('getTalentByGenre');
Route::get('/talent/genre/{genre}', [TalentController::class, 'getTalentsByGenre'])->name('getTalentsByGenre');
Route::get('/race/genre/{genre}', [RaceController::class, 'getRacesByGenre'])->name('getRacesByGenre');
Route::get('/genre/name/{name}', [GenreController::class, 'showName'])->name('showName');
Route::get('/showOptions/{genre}', [GenreController::class, 'showOptions'])->name('showOptions');
Route::get('/{genre}/books', [GenreController::class, 'showBooks'])->name('showBooks');

// Authorization & Authentication
Route::get('/auth/ability/{ability}', [AuthController::class, 'checkAbility'])->name('checkAbility');

Route::group(['middleware' => ['web']], function () {
    // Authentication
    Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/auth/register', [AuthController::class, 'register'])->name('register');
});
