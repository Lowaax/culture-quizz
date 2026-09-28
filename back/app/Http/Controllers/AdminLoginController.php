<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * Connexion à l'interface d'administration (sessions web).
 * Les joueurs, eux, s'authentifient par jeton via AuthController.
 */
class AdminLoginController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('connexion');
    }

    /**
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

        // Message identique que l'email existe ou non : le contraire
        // permettrait d'énumérer les comptes.
        if (!$utilisateur || !Hash::check($valide['password'], $utilisateur->password)) {
            throw ValidationException::withMessages([
                'email' => 'Identifiants incorrects.',
            ]);
        }

        // Le contrôle a lieu avant la connexion : un compte joueur n'obtient
        // jamais de session sur l'administration, même une fraction de seconde.
        if (!$utilisateur->is_admin) {
            throw ValidationException::withMessages([
                'email' => "Ce compte n'a pas accès à l'administration.",
            ]);
        }

        Auth::login($utilisateur, $request->boolean('se_souvenir'));

        // Nouvel identifiant de session après connexion : sans cela, un
        // identifiant capté avant la connexion resterait valable.
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->fermerLaSession($request);

        return redirect()->route('login')->with('status', 'Vous êtes déconnecté.');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    private function fermerLaSession(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
