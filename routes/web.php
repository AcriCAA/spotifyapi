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

Route::get('/', function () {
    return view('welcome');
});

Route::get('search/artist', [App\Http\Controllers\MusicProducedController::class, 'show_form']); 
Route::post('get/artist', [App\Http\Controllers\MusicProducedController::class, 'searchArtist']); 
Route::get('search/albums', [App\Http\Controllers\MusicProducedController::class, 'searchAlbums']); 
Route::post('artist/albums', [App\Http\Controllers\MusicProducedController::class, 'calculateTotalAlbumTime']); 
Route::get('albums/tracks', [App\Http\Controllers\MusicProducedController::class, 'albumTracks']); 
// Route::get('albums/all/time', [App\Http\Controllers\MusicProducedController::class, 'calculateTotalAlbumTime']); 

// calculateTotalAlbumTime
// Spotify::albumTracks('album_id')->get();

