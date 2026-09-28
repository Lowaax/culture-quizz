<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Gestion des comptes. Toutes ces routes exigent un jeton valide
 * (middleware auth:sanctum, voir routes/api.php).
 *
 * Règle d'accès : un joueur ne voit et ne modifie que son propre compte,
 * un administrateur accède à tous.
 */
class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->user()->is_admin) {
            return response()->json(['message' => 'Accès réservé aux administrateurs.'], 403);
        }

        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * La création libre d'un compte joueur passe par POST /api/register ;
     * cette route sert à l'administration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->user()->is_admin) {
            return response()->json(['message' => 'Accès réservé aux administrateurs.'], 403);
        }

        $valide = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        return response()->json(User::create($valide), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (!$this->peutAgirSur($request, $id)) {
            return response()->json(['message' => 'Accès refusé.'], 403);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'id non trouvé'], 404);
        }

        return response()->json($user);
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
        if (!$this->peutAgirSur($request, $id)) {
            return response()->json(['message' => 'Accès refusé.'], 403);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'id non trouvé'], 404);
        }

        $valide = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => 'sometimes|required|string|min:8',
        ]);

        $user->update($valide);

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (!$this->peutAgirSur($request, $id)) {
            return response()->json(['message' => 'Accès refusé.'], 403);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => 'error'], 404);
        }

        $user->delete();

        return response()->json(['status' => 'success']);
    }

    /**
     * Un joueur n'agit que sur lui-même, un administrateur sur tout le monde.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return bool
     */
    private function peutAgirSur(Request $request, $id)
    {
        return $request->user()->is_admin || (int) $request->user()->id === (int) $id;
    }
}
