<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\RequiredTalentController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\SearchController;
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

/* CRUD group */
Route::group(['middleware' => ['auth:sanctum', 'abilities:create,read,update,destroy']], function () {
    Route::apiResource('/genre', GenreController::class);
    Route::apiResource('/book', BookController::class);
    Route::apiResource('/talent_requirement', TalentRequirementController::class);
    Route::apiResource('/requirement', RequirementController::class);
    Route::apiResource('/category', CategoryController::class);
    Route::apiResource('/talent_category', TalentCategoryController::class);
    Route::apiResource('/trait', TraitController::class);
    Route::apiResource('/talent_trait', TalentTraitController::class);
    Route::apiResource('/required_talent', RequiredTalentController::class);
    Route::apiResource('/rule', RuleController::class);
    Route::apiResource('/user', UserController::class);
});

/* Unprotected Routes */

/* Read - Get */
Route::get('/genre', [GenreController::class, 'index']);
Route::get('/genre/{id}', [GenreController::class, 'show']);
Route::get('/book', [BookController::class, 'index']);
Route::get('/book/{id}', [BookController::class, 'show']);
Route::get('/talent_requirement', [TalentCategoryController::class, 'index']);
Route::get('/talent_requirement/{id}', [TalentRequirementController::class, 'show']);
Route::get('/requirement', [RequirementController::class, 'index']);
Route::get('/requirement/{id}', [RequirementController::class, 'show']);
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::get('/talent_category', [TalentCategoryController::class, 'index']);
Route::get('/talent_category/{id}', [TalentCategoryController::class, 'show']);
Route::get('/trait', [TraitController::class, 'index']);
Route::get('/trait/{id}', [TraitController::class, 'show']);
Route::get('/talent_trait', [TalentTraitController::class, 'index']);
Route::get('/talent_trait/{id}', [TalentTraitController::class, 'show']);
Route::get('/required_talent', [RequiredTalentController::class, 'index']);
Route::get('/required_talent/{id}', [RequiredTalentController::class, 'show']);
Route::get('/rule', [RuleController::class, 'index']);
Route::get('/rule/{id}', [RuleController::class, 'show']);

// Search
Route::get('search/{search}', [SearchController::class, 'search'])->name('search');

// Authentication
Route::get('auth/login', [AuthController::class, 'login'])->name('login');
Route::get('auth/register', [AuthController::class, 'register'])->name('register');

// Custom Functions
Route::get('/genre/name/{name}', [GenreController::class, 'showName'])->name('showName');
Route::get('/talent/genre/{genre}', [TalentController::class, 'showGenre'])->name('showGenre');
