<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * Comptes joueurs. Le jeu reste accessible sans compte : ces routes servent
 * uniquement à ceux qui veulent conserver leurs scores.
 */
class AuthController extends Controller
{
    /**
     * Création d'un compte joueur, qui repart avec son jeton.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $valide = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $utilisateur = User::create($valide);

        return response()->json([
            'utilisateur' => $utilisateur,
            'token' => $utilisateur->createToken('culture-quiz')->plainTextToken,
        ], 201);
    }

    /**
     * Connexion : renvoie un jeton personnel à placer dans l'en-tête
     * Authorization des requêtes suivantes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $valide = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $utilisateur = User::where('email', $valide['email'])->first();

        // Message volontairement identique dans les deux cas : préciser que
        // l'email existe aiderait à énumérer les comptes.
        if (!$utilisateur || !Hash::check($valide['password'], $utilisateur->password)) {
            throw ValidationException::withMessages([
                'email' => ['Identifiants incorrects.'],
            ]);
        }

        return response()->json([
            'utilisateur' => $utilisateur,
            'token' => $utilisateur->createToken('culture-quiz')->plainTextToken,
        ]);
    }

    /**
     * Déconnexion : seul le jeton utilisé pour cette requête est révoqué,
     * les autres appareils du joueur restent connectés.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Déconnecté.']);
    }
}
