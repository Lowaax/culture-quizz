<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::withCount('questions')->orderBy('id')->get();
        return view('listecategories', [
            'categories' => $categories
        ]);
    }

    /**
     * Catégories destinées au front, accompagnées du nombre de questions
     * disponibles et du meilleur score déjà obtenu.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexApi()
    {
        $categories = Categorie::withCount('questions')
            ->withMax('parties', 'score')
            ->orderBy('id')
            ->get();

        return response()->json($categories->map(function (Categorie $categorie) {
            return [
                'id' => $categorie->id,
                'categorie' => $categorie->categorie,
                'nombreQuestions' => $categorie->questions_count,
                'meilleurScore' => $categorie->parties_max_score,
            ];
        }));
    }

    /**
     * Return 10 random questions for the given category, each with 4
     * shuffled answers (including the correct one) ready for display.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function questions($id)
    {
        $categorie = Categorie::find($id);
        if (!$categorie) {
            return response()->json(['message' => 'catégorie non trouvée'], 404);
        }

        $questions = $categorie->questions()->inRandomOrder()->take(10)->get();

        $payload = $questions->map(function (\App\Models\Question $question) {
            $bonneReponse = $question->reponse1;
            $mauvaisesReponses = collect([
                $question->reponse2,
                $question->reponse3,
                $question->reponse4,
                $question->reponse5,
                $question->reponse6,
                $question->reponse7,
                $question->reponse8,
                $question->reponse9,
                $question->reponse10,
            ])->shuffle()->take(3);

            // La bonne réponse n'est jamais envoyée au client : elle est
            // vérifiée par POST /api/questions/{id}/verifier une fois que le
            // joueur a choisi, sinon le quiz se triche depuis l'onglet réseau.
            return [
                'id' => $question->id,
                'question' => $question->question,
                'reponses' => $mauvaisesReponses->push($bonneReponse)->shuffle()->values(),
            ];
        });

        return response()->json([
            'categorie' => $categorie->categorie,
            'questions' => $payload,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createcategorie');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'categorie'=>'required'
        ]);
        Categorie::create($validatedData);
        return redirect('/listecategories')->with('status', 'Catégorie créée avec succès!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
