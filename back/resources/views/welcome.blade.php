@extends('base')

@section('titre', 'Accueil')

@section('content')
<h1>Administration du quiz</h1>

<div class="card">
    <p>
        {{ $nombreCategories }} catégorie{{ $nombreCategories > 1 ? 's' : '' }}
        et {{ $nombreQuestions }} question{{ $nombreQuestions > 1 ? 's' : '' }} en base.
    </p>
    <p class="vide">
        Le jeu lui-même est l'application React, qui consomme l'API de ce serveur.
        Cette interface sert à alimenter les catégories et les questions.
    </p>
</div>
@endsection
