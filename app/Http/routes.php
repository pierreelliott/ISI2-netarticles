<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

// Afficher le formulaire d'authentification 
Route::get('/getLogin', 'ClientController@getLogin');

// Authentifie le client à partir du login et mdp saisis
Route::post('/signIn', 'ClientController@signIn');

// Déloguer le client
Route::get('/signOut', 'ClientController@signOut');
// Afficher le compte du client
Route::get('/getCompte', 'ClientController@getCompte')->middleware('autorise');
// Enregistrer le compte du client
Route::post('/setCompte', 'ClientController@setCompte')->middleware('autorise');

// Afficher la recherche d'Articles
Route::get('/getRecherche', 'ArticleController@getRecherche');//->middleware('autorise');
// Afficher la liste des articles du domaine sélectionné
Route::post('/getArticles', 'ArticleController@getArticles');//->middleware('autorise');
// Afficher la liste des articles d'un domaine
Route::get('/getArticles/{id_domaine}', 'ArticleController@getArticles');//->middleware('autorise');
// Afficher le détail d'un Article
Route::get('/getArticle/{id}', 'ArticleController@getArticle');//->middleware('autorise');

// Ajouter un article au panier
Route::get('/addBasket/{id}', 'PanierController@addBasket')->middleware('autorise');
// Afficher le Panier
Route::get('/getBasket', 'PanierController@getBasket')->middleware('autorise');
// Supprime un Article du panier
Route::get('/deleteBasket/{id_article}', 'PanierController@deleteBasket')->middleware('autorise');
// Valide le panier
Route::get('/validBasket', 'PanierController@validBasket')->middleware('autorise');


// Afficher la liste des articles achetés
Route::get('/getAchats', 'AcheteController@getAchats')->middleware('autorise');

