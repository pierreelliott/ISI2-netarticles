<?php

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
    return view('home');
});

Route::get('/getLogin', 'ClientController@getLogin');
Route::post('/signIn', 'UtilisateurController@signIn');
Route::get('/signOut', 'UtilisateurController@signOut');
/*
Route::group(['middleware' => ['autorise']], function () {
    Route::get('/listerMangas', 'MangaController@getMangas');
    Route::get('/listerGenres', 'GenreController@getGenres');
    Route::post('/listerMangasGenre', 'MangaController@getMangasGenre');
    Route::get('/modifierManga/{id}', 'MangaController@updateManga');
    Route::post('/validerManga', 'MangaController@validateManga');
    Route::get('/ajouterManga', 'MangaController@addManga');
    Route::get('/supprimerManga/{id}', 'MangaController@deleteManga');
});*/
