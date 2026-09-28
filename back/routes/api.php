<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PartieController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Deux niveaux d'accès :
|
|  - les routes publiques, strictement celles dont le jeu a besoin pour
|    tourner sans compte (catégories, questions d'un quiz, vérification
|    d'une réponse, enregistrement d'une partie) ;
|  - les routes protégées par un jeton Sanctum, pour le compte du joueur
|    et pour l'administration du contenu.
|
| La bonne réponse n'apparaît dans aucune route publique de lecture : elle
| n'est révélée que par /questions/{id}/verifier, après le choix du joueur.
|
*/

/*
 * Comptes : créer un compte et se connecter restent publics, mais sont
 * limités en fréquence pour décourager les tentatives en masse.
 */
Route::middleware('throttle:10,1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


/*
 * Le jeu lui-même, accessible sans compte.
 */
Route::get('/categories', [CategorieController::class, 'indexApi']);
Route::get('/categories/{id}/questions', [CategorieController::class, 'questions']);
Route::get('/categories/{id}/meilleur-score', [PartieController::class, 'meilleur']);
Route::post('/questions/{id}/verifier', [ApiController::class, 'verify']);
Route::post('/parties', [PartieController::class, 'store'])->middleware('throttle:30,1');


/*
 * Espace connecté.
 */
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/mes-parties', [PartieController::class, 'mesParties']);

    // Administration du contenu : ces routes exposent la bonne réponse,
    // elles ne peuvent pas rester ouvertes.
    Route::get('/questions', [ApiController::class, 'index']);
    Route::post('/questions', [ApiController::class, 'store']);
    Route::get('/questions/{id}', [ApiController::class, 'show']);
    Route::put('/questions/{id}', [ApiController::class, 'update']);
    Route::delete('/questions/{id}', [ApiController::class, 'destroy']);

    Route::get('/users', [ApiUserController::class, 'index']);
    Route::post('/users', [ApiUserController::class, 'store']);
    Route::get('/users/{id}', [ApiUserController::class, 'show']);
    Route::put('/users/{id}', [ApiUserController::class, 'update']);
    Route::delete('/users/{id}', [ApiUserController::class, 'destroy']);
});
