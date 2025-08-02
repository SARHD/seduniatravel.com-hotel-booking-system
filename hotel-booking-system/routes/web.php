<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\SearchController;

Route::get('/', [HomeController::class, 'index']);
Route::post('/search', [HomeController::class, 'search']);
Route::get('/search/results', [SearchController::class, 'results'])->name('search.results');
Route::get('/hotels/{destination}', [HotelController::class, 'showByDestination']);
