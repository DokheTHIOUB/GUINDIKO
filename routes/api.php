<?php

use App\Http\Controllers\Api\articles\ArticleController;
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
Route::get('mentore',[MentoreController::class,'index']);

//archivage

Route::patch('/mentore/archive/{mentore}', [MentoreController::class, 'archive']);
Route::patch('/posts/desarchive/{mentore}', [MentoreController::class, 'desarchive']);

//détails mentor

Route::get('mentore/{mentore}', [MentoreController::class, 'show']);


//liste non archivés
Route::get('compter-utilisateurs-non-archives', [MentoreController::class, 'compterUtilisateursNonArchives']);

//liste archivé
Route::get('compter-utilisateurs-archives', [MentoreController::class, 'compterUtilisateursArchives']);



//SESSIONNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN

Route::get('session',[SessionController::class,'index']);

//ajouter session
Route::post('session/store',[SessionController::class,'store']);

//modifier une session

Route::put('session/update/{session}',[SessionController::class,'update']);

//Supprimer une session
Route::delete('session/delete/{session}',[SessionController::class,'destroy']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Pour les articles(ARCHIVER ET CRUD)
Route::get('articles', [ArticleController::class, 'index']);
Route::post('articles/create', [ArticleController::class, 'store']);
Route::get('articles/show/{article}', [ArticleController::class, 'show']);
Route::delete('articles/{article}', [ArticleController::class, 'destroy']);
Route::put('articles/edit/{article}', [ArticleController::class, 'update']);
Route::get('articles/filtre', [ArticleController::class, 'filtrerArticles']);
Route::put('articles/archives/{article}', [ArticleController::class, 'archive']);
Route::get('articles/articlesArchives', [ArticleController::class, 'articlesArchives']);
Route::get('articles/articlesNonArchives', [ArticleController::class, 'articlesNonArchives']);