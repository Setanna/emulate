<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\RequiredTalentController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SenseController;
use App\Http\Controllers\TalentCategoryController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\TalentRequirementController;
use App\Http\Controllers\TalentTraitController;
use App\Http\Controllers\TraitController;
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
    return $request->user();
});

/* Create */
Route::group(['middleware' => ['auth:sanctum', 'ability:create']], function () {
    Route::post('/genre', [GenreController::class, 'store']);
    Route::post('/book', [BookController::class, 'store']);
    Route::post('/rule', [RuleController::class, 'store']);
    Route::post('/talent', [TalentController::class, 'store']);
    Route::post('/talent_requirement', [TalentRequirementController::class, 'store']);
    Route::post('/talent_category', [TalentCategoryController::class, 'store']);
    Route::post('/talent_trait', [TalentTraitController::class, 'store']);
    Route::post('/required_talent', [RequiredTalentController::class, 'store']);
    Route::post('/requirement', [RequirementController::class, 'store']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::post('/trait', [TraitController::class, 'store']);
    Route::post('/sense', [SenseController::class, 'store']);
});

/* Update */
Route::group(['middleware' => ['auth:sanctum', 'ability:update']], function () {
    Route::put('/genre/{genre}', [GenreController::class, 'update']);
    Route::put('/book/{book}', [BookController::class, 'update']);
    Route::put('/rule/{rule}', [RuleController::class, 'update']);
    Route::put('/talent/{talent}', [TalentController::class, 'update']);
    Route::put('/talent_requirement/{talent_requirement}', [TalentRequirementController::class, 'update']);
    Route::put('/talent_category/{talent_category}', [TalentCategoryController::class, 'update']);
    Route::put('/talent_trait/{talent_trait}', [TalentTraitController::class, 'update']);
    Route::put('/required_talent/{required_talent}', [RequiredTalentController::class, 'update']);
    Route::put('/requirement/{requirement}', [RequirementController::class, 'update']);
    Route::put('/category/{category}', [CategoryController::class, 'update']);
    Route::put('/trait/{trait}', [TraitController::class, 'update']);
    Route::put('/sense/{sense}', [SenseController::class, 'update']);
});

/* Destroy */
Route::group(['middleware' => ['auth:sanctum', 'ability:destroy']], function () {
    Route::delete('/genre/{genre}', [GenreController::class, 'destroy']);
    Route::delete('/book/{book}', [BookController::class, 'destroy']);
    Route::delete('/rule/{rule}', [RuleController::class, 'destroy']);
    Route::delete('/talent/{talent}', [TalentController::class, 'destroy']);
    Route::delete('/talent_requirement/{talent_requirement}', [TalentRequirementController::class, 'destroy']);
    Route::delete('/talent_category/{talent_category}', [TalentCategoryController::class, 'destroy']);
    Route::delete('/talent_trait/{talent_trait}', [TalentTraitController::class, 'destroy']);
    Route::delete('/required_talent/{required_talent}', [RequiredTalentController::class, 'destroy']);
    Route::delete('/requirement/{requirement}', [RequirementController::class, 'destroy']);
    Route::delete('/category/{category}', [CategoryController::class, 'destroy']);
    Route::delete('/trait/{trait}', [TraitController::class, 'destroy']);
    Route::delete('/sense/{sense}', [SenseController::class, 'destroy']);
});

/* Unprotected Routes */

/* Read - Get */
Route::get('/genre', [GenreController::class, 'index']);
Route::get('/genre/{genre}', [GenreController::class, 'show']);
Route::get('/book', [BookController::class, 'index']);
Route::get('/book/{book}', [BookController::class, 'show']);
Route::get('/talent_requirement', [TalentCategoryController::class, 'index']);
Route::get('/talent_requirement/{talent_requirement}', [TalentRequirementController::class, 'show']);
Route::get('/requirement', [RequirementController::class, 'index']);
Route::get('/requirement/{requirement}', [RequirementController::class, 'show']);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{category}', [CategoryController::class, 'show']);
Route::get('/talent', [TalentController::class, 'index']);
Route::get('/talent/{talent}', [TalentController::class, 'show']);
Route::get('/talent_category', [TalentCategoryController::class, 'index']);
Route::get('/talent_category/{talent_category}', [TalentCategoryController::class, 'show']);
Route::get('/trait', [TraitController::class, 'index']);
Route::get('/trait/{id}', [TraitController::class, 'show']);
Route::get('/talent_trait', [TalentTraitController::class, 'index']);
Route::get('/talent_trait/{talent_trait}', [TalentTraitController::class, 'show']);
Route::get('/required_talent', [RequiredTalentController::class, 'index']);
Route::get('/required_talent/{required_talent}', [RequiredTalentController::class, 'show']);
Route::get('/rule', [RuleController::class, 'index']);
Route::get('/rule/{rule}', [RuleController::class, 'show']);
Route::get('/sense', [SenseController::class, 'index']);
Route::get('/sense/{sense}', [SenseController::class, 'show']);


// Search
Route::get('search/{search}', [SearchController::class, 'search'])->name('search');

// Authentication
Route::get('auth/login', [AuthController::class, 'login'])->name('login');
Route::get('auth/register', [AuthController::class, 'register'])->name('register');

// Custom Functions
Route::get('/genre/name/{name}', [GenreController::class, 'showName'])->name('showName');
Route::get('/talent/genre/{genre}', [TalentController::class, 'showGenre'])->name('showGenre');

