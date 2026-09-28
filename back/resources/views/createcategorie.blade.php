@extends('base')

@section('titre', 'Nouvelle catégorie')

@section('content')
<h1>Ajouter une catégorie</h1>

<form method="POST" action="{{ route('storecategorie') }}" class="card">
    @csrf

    <div class="champ">
        <label for="categorie">Nom de la catégorie</label>
        <input type="text" name="categorie" id="categorie" value="{{ old('categorie') }}" required>
        @error('categorie')
            <span class="erreur">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn">Ajouter</button>
</form>
@endsection
