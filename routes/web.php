<?php

use Illuminate\Support\Facades\Route;

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

// TODO: make not found page return 404 page instead of throwing too much recursion error.
Route::get('/{any}', function () {
    return view('./vue');
})->where('any', '.*');

/*
Route::get('/{vue_capture?}', function() {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/
