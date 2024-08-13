<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;






Route::get('home',[MoviesController::class,'index'])->name('movies.data');;

Route::get('search',[MoviesController::class,'smovie'])->name('movies.search');
Route::get('tv-show',[MoviesController::class,'searchTvShow'])->name('tv_show.search');

Route::get('details/{id}',[MoviesController::class,'selectMovie'])->name('movies.details');
Route::get('tvdetails/{id}',[MoviesController::class,'selectTvShow'])->name('tv_show.details');

Route::get('movieData',[MoviesController::class,'getMovies'])->name('get.movies');
Route::get('tvData',[MoviesController::class,'getTvshows'])->name('get.tvShows');
Route::get('actors',[MoviesController::class,'actors'])->name('get.actors');



