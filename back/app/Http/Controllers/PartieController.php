<?php

namespace App\Http\Controllers;

use App\Models\Partie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartieController extends Controller
{
    /**
     * Enregistre le score d'une partie terminée.
     *
     * La route est publique : on peut jouer sans compte, la partie est alors
     * anonyme. Si le joueur présente un jeton valide, elle est rattachée à son
     * compte et il récupère aussi son record personnel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categorie_id' => 'required|integer|exists:categories,id',
            'score' => 'required|integer|min:0',
            'total' => 'required|integer|min:1|max:50',
        ]);

        if ($validated['score'] > $validated['total']) {
            return response()->json(['message' => 'score supérieur au nombre de questions'], 422);
        }

        $utilisateur = Auth::guard('sanctum')->user();

        $partie = Partie::create($validated + [
            'user_id' => $utilisateur ? $utilisateur->id : null,
        ]);

        return response()->json([
            'partie' => $partie,
            'meilleurScore' => $this->meilleurScore($partie->categorie_id),
            'meilleurScorePersonnel' => $utilisateur
                ? $this->meilleurScore($partie->categorie_id, $utilisateur->id)
                : null,
        ], 201);
    }

    /**
     * Meilleur score enregistré pour une catégorie, tous joueurs confondus.
     *
     * @param  int  $categorieId
     * @return \Illuminate\Http\Response
     */
    public function meilleur($categorieId)
    {
        return response()->json([
            'categorie_id' => (int) $categorieId,
            'meilleurScore' => $this->meilleurScore($categorieId),
        ]);
    }

    /**
     * Historique du joueur connecté : ses dernières parties et son record
     * par catégorie.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function mesParties(Request $request)
    {
        $utilisateur = $request->user();

        $parties = Partie::with('categorie')
            ->where('user_id', $utilisateur->id)
            ->orderByDesc('id')
            ->take(20)
            ->get()
            ->map(function (Partie $partie) {
                return [
                    'id' => $partie->id,
                    'categorie' => $partie->categorie->categorie ?? null,
                    'score' => $partie->score,
                    'total' => $partie->total,
                    'jouee_le' => $partie->created_at,
                ];
            });

        $records = Partie::where('user_id', $utilisateur->id)
            ->selectRaw('categorie_id, MAX(score) as meilleur_score, COUNT(*) as parties_jouees')
            ->groupBy('categorie_id')
            ->get();

        return response()->json([
            'parties' => $parties,
            'records' => $records,
        ]);
    }

    /**
     * @param  int  $categorieId
     * @param  int|null  $userId
     * @return int|null
     */
    private function meilleurScore($categorieId, $userId = null)
    {
        return Partie::where('categorie_id', $categorieId)
            ->when($userId, function ($requete) use ($userId) {
                $requete->where('user_id', $userId);
            })
            ->max('score');
    }
}
