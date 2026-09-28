<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\CategorieController;
use App\Models\Categorie;
use App\Models\Question;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Interface d'administration du contenu du quiz. Le jeu, lui, est
| l'application React qui consomme routes/api.php.
|
| Tout ce qui suit la page de connexion exige une session authentifiée dont
| le compte porte le drapeau is_admin.
|
*/

Route::middleware('guest')->group(function () {
    Route::get('connexion', [AdminLoginController::class, 'show'])->name('login');
    Route::post('connexion', [AdminLoginController::class, 'login'])
        ->middleware('throttle:10,1')
        ->name('login.store');
});

Route::post('deconnexion', [AdminLoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/', function () {
        return view('welcome', [
            'nombreCategories' => Categorie::count(),
            'nombreQuestions' => Question::count(),
        ]);
    })->name('home');

    Route::get('listequestions', [QuizzController::class, 'index'])->name('listequestions');
    Route::post('store', [QuizzController::class, 'store'])->name('storequestion');
    Route::get('createquestion', [QuizzController::class, 'create'])->name('createquestion');

    Route::get('listecategories', [CategorieController::class, 'index'])->name('listecategories');
    Route::post('storecategorie', [CategorieController::class, 'store'])->name('storecategorie');
    Route::get('createcategorie', [CategorieController::class, 'create'])->name('createcategorie');
});
