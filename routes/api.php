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

/* Group to hold all protected routes */
Route::group(['middleware' => ['auth:sanctum']], function () {
    /* Get current user */
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Basic CRUD API
    Route::apiResource('/genre', GenreController::class);
    Route::apiResource('/book', BookController::class);
    Route::apiResource('/talent', TalentController::class);
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

// Search
Route::get('search/{search}', [SearchController::class, 'search'])->name('search');

// Authentication
Route::get('auth/login', [AuthController::class, 'login'])->name('login');
Route::get('auth/register', [AuthController::class, 'register'])->name('register');

// Basic CRUD API
Route::apiResource('/genre', GenreController::class);

// Custom Functions
Route::get('/genre/name/{name}', [GenreController::class, 'showName'])->name('showName');
