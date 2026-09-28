<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Question::with('categorie')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Sans validation, $request->all() laissait créer des questions vides
        // ou rattachées à une catégorie inexistante.
        $item = Question::create($request->validate($this->regles()));

        return response()->json($item, 201);
    }

    /**
     * Une question a besoin de ses dix réponses : l'API en tire trois
     * mauvaises au hasard, plus la bonne, qui est toujours reponse1.
     *
     * @return array<string, string>
     */
    private function regles()
    {
        $regles = [
            'categorie_id' => 'required|integer|exists:categories,id',
            'question' => 'required|string|max:500',
        ];

        foreach (range(1, 10) as $numero) {
            $regles['reponse' . $numero] = 'required|string|max:255';
        }

        return $regles;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::with('categorie')->find($id);
        if ($question) {
            return response()->json($question);
        }
        return response()->json(['message' => 'id non trouvé'], 404);
    }

    /**
     * Vérifie la réponse choisie par le joueur. La bonne réponse est toujours
     * stockée dans reponse1, elle ne quitte le serveur qu'ici, une fois le
     * choix fait (ou le temps écoulé, auquel cas reponse vaut null).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request, $id)
    {
        $question = Question::find($id);
        if (!$question) {
            return response()->json(['message' => 'id non trouvé'], 404);
        }

        $validated = $request->validate([
            'reponse' => 'nullable|string',
        ]);

        return response()->json([
            'correct' => isset($validated['reponse']) && $validated['reponse'] === $question->reponse1,
            'bonneReponse' => $question->reponse1,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = Question::find($id);
        if (!$question) {
            return response()->json(['message' => 'id non trouvé'], 404);
        }

        // Mêmes règles qu'à la création, mais chaque champ devient facultatif
        // pour permettre une modification partielle.
        $regles = [];
        foreach ($this->regles() as $champ => $regle) {
            $regles[$champ] = 'sometimes|' . $regle;
        }

        $question->update($request->validate($regles));

        return response()->json($question);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        if ($question) {
            $question->delete();
            return response()->json(["status" => "success"]);
        }
        return response()->json(["status" => "error"], 404);
    }
}
