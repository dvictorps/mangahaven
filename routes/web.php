<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\MangaController;



 
Route::get('/', [MangaController::class, 'index']);
Route::get('/manga/add', [MangaController::class, 'add']) ->middleware('auth');
Route::get('/manga/{id}', [MangaController::class, 'show']);
Route::post('/manga', [MangaController::class, 'store']);
Route::delete('/manga/{id}', [MangaController::class, 'destroy'])->middleware('auth');
Route::get('/manga/edit/{id}', [MangaController::class, 'edit'])->middleware('auth');
Route::put('/manga/update/{id}', [MangaController::class, 'update'])->middleware('auth');


Route::get('/dashboard', [MangaController::class, 'dashboard'])->middleware('auth');

Route::match(['get' , 'post'],'/manga/read/{id}', [MangaController::class, 'readManga'])->middleware('auth');

Route::delete('/manga/leave/{id}', [MangaController::class, 'leaveManga'])->middleware('auth');


